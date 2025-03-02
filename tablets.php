<?php
session_start();
include 'db.php';

if (!isset($_SESSION['form_data'])) {
    header("Location: index.php");
    exit();
}


$stmt->close();

// Fetch all records from tbl_user
$formationResult = $conn->query("SELECT * FROM tbl_user");

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>User Data</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($formationResult->num_rows > 0): ?>
                <?php while ($row = $formationResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['u_lname']); ?></td>
                        <td><?php echo htmlspecialchars($row['u_fname']); ?></td>
                        <td><?php echo htmlspecialchars($row['u_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['u_username']); ?></td>
                        <td><?php echo htmlspecialchars($row['u_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['u_status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>