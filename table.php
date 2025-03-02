<?php
session_start();

include 'db.php'; 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Task Management</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>

<aside class="sidebar">
    <h2>Task Management</h2>
    <nav>
        <ul>
            <li><a href="#" onclick="showSection('taskTable')">📋 Task List</a></li>
            <li><a href="#" onclick="showSection('taskForm')">➕ Create Task</a></li>
            <li><a href="#" onclick="showSection('AssignedForm')">👥 Assigned Tasks</a></li>
            <li><a href="#" onclick="showSection('StatusForm')">🔄 Task Status</a></li>
            <li><a href="#" onclick="showSection('DueForm')">⏳ Due Tasks</a></li>
            <li><a href="#" onclick="showSection('HighForm')">🚀 High Priority Tasks</a></li>
            <li><a href="#" onclick="showSection('ReportsForm')">📂 Task Reports</a></li>
        </ul>
        <a href="index.php" class="back-button">🔙 Back to Login</a>
    </nav>
</aside>

<!-- Main Content Area -->
<section id="taskTable">
    <h2>Task List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['password']); ?></td>
                        <td><?php echo htmlspecialchars($user['type']); ?></td>
                        <td><?php echo htmlspecialchars($user['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<script src="script.js"></script> <!-- Link to JavaScript file -->
</body>
</html>