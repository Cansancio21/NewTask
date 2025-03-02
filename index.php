<?php
include 'db.php'; // Include database connection
session_start();

// Registration form handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing
    $type = $_POST['type']; // Get user type from form
    $status = $_POST['status']; // Get status from form

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO tbl_user(u_fname, u_lname, u_email, u_username, u_password, u_type, u_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $firstname, $lastname, $email, $username, $password, $type, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! You can now login.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Login form handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to find the user
    $stmt = $conn->prepare("SELECT u_password, u_type FROM tbl_user WHERE u_username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $user_type);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start session and set session variables
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $user_type;

            // Redirect based on user type
            if (strcasecmp($user_type, 'Admin') == 0) {
                header("Location: table.php"); // Redirect to table.php for admin users
            } elseif (strcasecmp($user_type, 'User ') == 0) {
                header("Location: userdashboard.php");
            } elseif (strcasecmp($user_type, 'Staff') == 0) {
                header("Location: staffdashboard.php");
            }
            exit();
        } else {
            // Set error message for invalid password
            $_SESSION['error'] = "Invalid password. Please try again.";
            header("Location: index.php"); // Redirect back to login page
            exit();
        }
    } else {
        // Set error message for no user found
        $_SESSION['error'] = "No user found with that username.";
        header("Location: index.php"); // Redirect back to login page
        exit();
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management - Login & Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<div class="container">
    <div class="form-box login">
        <a href="settings.php" class="settings-link">
<<<<<<< HEAD
            <i class='bx bx-cog'></i>
            <span>Settings</span>
        </a>
        <form action="index.php" method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="forgot-pass">
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" name="login" class="btn">Login</button>
            <p>or login with social platform</p>
            <div class="social-icons">
                <a href="#"><i class='bx bxl-google'></i></a>
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-github'></i></a>
                <a href="#"><i class='bx bxl-linkedin'></i></a>
            </div>
        </form>
=======
        <i class='bx bx-cog'></i>
        <span>Settings</span>
    </a>
            <form action="adminT.php">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <p>or login with social platform</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <form action="">
                <h1>Registration</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Email" required>
                    <i class='bx bxs-envelope' ></i>
                </div>
                <div class="input-box">
                    <input type="contact Information" placeholder="Contact" required>
                    <i class='bx bxs-contact' ></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
               
                <button type="submit" class="btn">Register</button>
                <p>or register with social platform</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div>
        <div class="toggle-box">
    <div class="toggle-panel toggle-left">
        <h1>Hello Welcome!</h1>
        <p>Don't have an account?</p>
        <button class="btn register-btn">Register</button>

>>>>>>> efa60a7a547a94b88b8847b1d9b23916d9c2e4c5
    </div>

    <div class="form-box register">
        <form action="index.php" method="POST">
            <h1>Registration</h1>
            <div class="input-box">
                <input type="text" name="firstname" placeholder="Firstname" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="lastname" placeholder="Lastname" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <select name="type" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="User ">User </option>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                </select>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <select name="status" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Active">Active</option>
                </select>
                <i class='bx bxs-check-circle'></i>
            </div>
            <button type="submit" name="register" class="btn">Register</button>
        </form>
    </div>

    <div class="toggle-box">
        <div class="toggle-panel toggle-left">
            <h1>Hello Welcome!</h1>
            <p>Don't have an account?</p>
            <button class="btn register-btn">Register</button>
        </div>

        <div class="toggle-panel toggle-right">
            <h1>Welcome Back!</h1>
            <p>Already have an account?</p>
            <button class="btn login-btn">Login</button>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>