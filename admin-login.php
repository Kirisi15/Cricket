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
</head>
<body>
    <h2>Admin Login</h2>
    <form method="post">
        <label for="adminUsername">Username:</label>
        <input type="text" id="adminUsername" name="adminUsername" required>

        <label for="adminPassword">Password:</label>
        <input type="password" id="adminPassword" name="adminPassword" required>

        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
