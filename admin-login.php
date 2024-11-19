<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['adminUsername'];
    $password = $_POST['adminPassword'];

    $sql = "SELECT * FROM admin WHERE adminUsername = ? AND adminPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header('location:admin-dashboard.php');
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin-login.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <nav>
        <button class="nav-toggle" onclick="toggleNav()">☰</button>
        <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#matches">Matches</a></li>
            <li><a href="index.php#news">News</a></li>
            <li><a href="rankings.php">Rankings</a></li>
            <li class="dropdown">
                <a href="#login">Login</a>
                <ul class="dropdown-content">
                    <li><a href="team-login.php">Team Login</a></li>
                    <li><a href="admin-login.php">Admin Login</a></li>
                    <li><a href="organizer-login.php">Organizer Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="post">
            <label for="adminUsername">Username:</label>
            <input type="text" id="adminUsername" name="adminUsername" required>

            <label for="adminPassword">Password:</label>
            <input type="password" id="adminPassword" name="adminPassword" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>

    <script>
        function toggleNav() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>
