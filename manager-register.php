<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gmail = $_POST['gmail'];

    $checkSql = "SELECT * FROM authorizeduser WHERE authorizedUsername = ? OR gmail = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('ss', $username, $gmail);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Username or email already exists. Please choose another.');</script>";
    } else {
        $sql = "INSERT INTO authorizeduser (gmail, authorizedUsername, authorizedPassword) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $gmail, $username, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful. Please login.'); window.location.href='team-options.php';</script>";
        } else {
            echo "<script>alert('Error: Could not register. Please try again.');</script>";
        }
    }

    $checkStmt->close();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Registration</title>
</head>
<body>
    <h2>Team Registration</h2>
    <form action="manager-register.php" method="POST">
        <label for="gmail">Gmail:</label>
        <input type="email" id="gmail" name="gmail" required>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="team-login.php">Login here</a></p>
</body>
</html>
