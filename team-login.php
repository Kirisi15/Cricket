<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM authorizeduser WHERE authorizedUsername = ? AND authorizedPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['userId'] = $user['userId']; 
        $_SESSION['authorized_user'] = $username;
        header("Location: team-dashboard.php");
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
    <title>Login as Manager</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Add this line -->
    <link rel="stylesheet" href="team-login.css"> <!-- Add this line -->

</head>
<body>

    <nav>
        <button class="nav-toggle" onclick="toggleNav()">☰</button>
        <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="#matches">Matches</a></li>
            <li><a href="#news">News</a></li>
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

    <h1>Login as Manager</h1>
    <form action="team-login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="manager-register.php">Register here</a></p>

    <script>
        function toggleNav() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>

