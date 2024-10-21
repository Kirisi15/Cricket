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

    $checkSql = "SELECT * FROM authorizeduser WHERE authorizedUsername = ? OR gmail = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('ss', $username, $gmail);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Username or email already exists. Please choose another.');</script>";
    } else {
        $sql_user = "INSERT INTO authorizeduser (gmail, authorizedUsername, authorizedPassword) VALUES (?, ?, ?)";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param('sss', $gmail, $username, $password);

        if ($stmt_user->execute()) {

            $sql_team = "INSERT INTO team (teamUsername, paymentStatus, teamLogo, teamName) VALUES ( ?, ?, ?, ?)";
            $stmt_team = $conn->prepare($sql_team);
            $stmt_team->bind_param('siss', $teamUsername, $paymentStatus, $teamLogo, $teamName );

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team and Manager Registration</title>
</head>
<body>
    <h2>Team and Manager Registration</h2>
    <form action="manager-register.php" method="POST">
        <label for="gmail">Gmail:</label>
        <input type="email" id="gmail" name="gmail" required>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="teamUsername">Team Username:</label>
        <input type="text" id="teamUsername" name="teamUsername" required>
        
        <label for="paymentStatus">Payment Status (1 for Paid, 0 for Unpaid):</label>
        <input type="number" id="paymentStatus" name="paymentStatus" min="0" max="1" required>
        
        <label for="teamLogo">Team Logo:</label>
        <input type="text" id="teamLogo" name="teamLogo" required>
        
        <label for="teamName">Team Name:</label>
        <input type="text" id="teamName" name="teamName" required>
        
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="team-login.php">Login here</a></p>
</body>
</html>
