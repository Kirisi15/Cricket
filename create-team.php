<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamUsername = $_POST['teamUsername'];
    $paymentStatus = $_POST['paymentStatus'];
    $teamLogo = $_POST['teamLogo'];
    $teamName = $_POST['teamName'];

    // Insert new team into team table
    $sql = "INSERT INTO team (teamUsername, paymentStatus, teamLogo, teamName) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siss', $teamUsername, $paymentStatus, $teamLogo, $teamName);

    if ($stmt->execute()) {
        echo "<script>alert('Team created successfully.'); window.location.href='team-login.php';</script>";
    } else {
        echo "<script>alert('Error: Could not create team. Please try again.');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team</title>
</head>
<body>
    <h2>Create Team</h2>
    <form action="create-team.php" method="POST">
        <label for="teamUsername">Team Username:</label>
        <input type="text" id="teamUsername" name="teamUsername" required>
        
     
        
        <label for="paymentStatus">Payment Status (1 for Paid, 0 for Unpaid):</label>
        <input type="number" id="paymentStatus" name="paymentStatus" min="0" max="1" required>
        
        <label for="teamLogo">Team Logo:</label>
        <input type="text" id="teamLogo" name="teamLogo" required>
        
        <label for="teamName">Team Name:</label>
        <input type="text" id="teamName" name="teamName" required>
        
        <button type="submit">Create Team</button>
    </form>
    <p><a href="team-options.php">Back to Options</a></p>
</body>
</html>
