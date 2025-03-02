<?php
// adminT.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Here, you can check the credentials and redirect or show an error.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="adminT.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <i class='bx bxs-user-circle admin-icon'></i>
            <h2>Admin Dashboard</h2>
            <ul class="nav-links">
                <li><i class='bx bx-home'></i> Dashboard</li>
                <li><i class='bx bx-user'></i> Users</li>
                <li><i class='bx bx-file'></i> Reports</li>
                <li><i class='bx bx-cog'></i> Settings</li>
            </ul>

            <!-- Logout Button -->
            <a href="index.php" class="logout-button"><i class='bx bx-log-out'></i> Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="dashboard-content">
                <!-- Stats Boxes -->
                <div class="stats">
                    <div class="stat-box"><i class='bx bx-user'></i> Users: 120</div>
                    <div class="stat-box"><i class='bx bx-file'></i> Reports: 30</div>
                </div>

                <!-- Main Action Buttons -->
                <div class="button-container">
                    <button onclick="window.location.href='viewU.php'"><i class="bx bx-user"></i> View Users</button>
                    <button><i class="bx bx-wrench"></i> View Service Record</button>
                    <button><i class="bx bx-report"></i> View Incident Report</button>
                    <button><i class="bx bx-folder"></i> View Logs</button>
                </div>

                <!-- Admin Icons for Decoration -->
                <div class="admin-icons">
                    <div class="icon-row">
                        <i class='bx bx-shield-alt-2'></i>
                        <i class='bx bx-bar-chart-alt'></i>
                        <i class='bx bx-wrench'></i>
                        <i class='bx bx-cog'></i>
                        <i class='bx bx-lock'></i>
                        <i class='bx bx-folder-open'></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
