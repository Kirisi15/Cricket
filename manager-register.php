<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gmail = $_POST['gmail'];
    $teamUsername = $_POST['teamUsername'];
    $paymentStatus = $_POST['paymentStatus'];
    $teamLogo = $_POST['teamLogo'];
    $teamName = $_POST['teamName'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {
        $checkSql = "SELECT * FROM authorizeduser WHERE authorizedUsername = ? OR gmail = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param('ss', $username, $gmail);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('Username or email already exists. Please choose another.');</script>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql_user = "INSERT INTO authorizeduser (gmail, authorizedUsername, authorizedPassword) VALUES (?, ?, ?)";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->bind_param('sss', $gmail, $username, $hashedPassword);

            if ($stmt_user->execute()) {

                $sql_team = "INSERT INTO team (teamUsername, paymentStatus, teamLogo, teamName, managerName) VALUES ( ?, ?, ?, ?, ?)";
                $stmt_team = $conn->prepare($sql_team);
                $stmt_team->bind_param('sisss', $teamUsername, $paymentStatus, $teamLogo, $teamName, $username);

                if ($stmt_team->execute()) {
                    echo "<script>alert('Team and manager registered successfully. Please login.'); window.location.href='team-login.php';</script>";
                } else {
                    echo "<script>alert('Error: Could not create team. Please try again.');</script>";
                }
                $stmt_team->close();
            } else {
                echo "<script>alert('Error: Could not register manager. Please try again.');</script>";
            }
            $stmt_user->close();
        }

        $checkStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team and Manager Registration</title>
    <link rel="stylesheet" href="manager-register.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

    <div class="registration-container">
        <h2>Team and Manager Registration</h2>

        <form action="manager-register.php" method="POST">
            <div class="manager-details">
                <h3 class="section-title">Manager Details</h3>
                <label for="gmail">Manager Gmail:</label>
                <input type="email" id="gmail" name="gmail" required>
                <label for="username">Manager Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>

            <div class="team-details">
                <h3 class="section-title">Team Details</h3>
                <label for="teamUsername">Team Username:</label>
                <input type="text" id="teamUsername" name="teamUsername" required>
                
                <label for="paymentStatus">Payment Status (1 for Paid, 0 for Unpaid):</label>
                <input type="number" id="paymentStatus" name="paymentStatus" min="0" max="1" required>
                
                <label for="teamLogo">Team Logo:</label>
                <input type="text" id="teamLogo" name="teamLogo" required>
                
                <label for="teamName">Team Name:</label>
                <input type="text" id="teamName" name="teamName" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="team-login.php">Login here</a></p>
    </div>

    <script>
        function toggleNav() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>

