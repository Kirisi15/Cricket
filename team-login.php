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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #ffffff;
            color: #2a3a83;
        }

        h2 {
            font-size: 28px;
            color: #2a3a83;
            margin-top: 20px;
        }

        form {
            display: inline-block;
            background-color: #f1f5fc;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        label {
            display: block;
            font-size: 18px;
            color: #2a3a83;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #2a3a83;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #ffffff;
        }

        button[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #2a3a83;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #43429e;
        }

        p {
            margin-top: 15px;
            font-size: 16px;
        }

        a {
            color: #2a3a83;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #43429e;
        }
    </style>
</head>
<body>
    <h2>Login as Manager</h2>
    <form action="team-login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="manager-register.php">Register here</a></p>
</body>
</html>

