<?php
session_start();
include 'db.php';

if (!isset($_SESSION['form_data'])) {
    header("Location: index.php");
    exit();
}


$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $lastName = trim($_POST['lastname'] ?? '');
    $firstName = trim($_POST['firstname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $status = trim($_POST['status'] ?? '');

    // Validate input
    if (empty($lastName) || empty($firstName) || empty($email) || empty($user) || empty($pass) || empty($type) || empty($status)) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        // Hash the password before storing it
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $formData = $_SESSION['form_data'];
        unset($_SESSION['form_data']); // Clear session data after use

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO tbl_user (u_fname, u_lname, u_email, u_username, u_password, u_type, u_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstName, $lastName, $email, $user, $hashedPassword, $type, $status);
        $stmt->execute();
        $uId = $stmt->insert_id; // Get the inserted ID

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            $success = true; // Registration successful
            // Optionally, you can store the user data in session if needed
            $_SESSION['form_data'] = [
                'first' => $firstName,
                'last' => $lastName,
                'email' => $email,
                'username' => $user,
                'type' => $type,
                'status' => $status,
            ];
            // Redirect to another page if needed
            header("Location: tablets.php");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error; // Capture any errors
        }

        $stmt->close();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="index.css">
</head>
<body>


    <div class="container">
        <div class="form-box login">

        <a href="settings.php" class="settings-link">
        <i class='bx bx-cog'></i>
        <span>Settings</span>
    </a>
            <form action="table.php">
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
                    <input type="firstname" placeholder="Firstname" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="lastname" placeholder="Lastname" required>
                    <i class='bx bxs-envelope' ></i>
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Email" required>
                    <i class='bx bxs-envelope' ></i>
                </div>
                
                <div class="input-box">
                    <input type="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>            
                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
            <select required>
                <option value="" disabled selected>Select Type</option>
                <option value="user">User </option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
            <i class='bx bxs-user'></i>
        </div>

      
        <div class="input-box">
            <select required>
                <option value="" disabled selected>Select Status</option>
                <option value="pending">Pending</option>
                <option value="active">Active</option>
            </select>
            <i class='bx bxs-check-circle'></i>
        </div>
               
                <button type="submit" class="button">Register</button>
                
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
