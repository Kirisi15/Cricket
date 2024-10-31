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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #e3eaf2;
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
            margin: 20px auto;
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
            text-align: left; 
        }

        .section-title {
            font-size: 24px;
            color: #2a3a83;
            margin: 20px 0 10px;
            border-bottom: 2px solid #2a3a83;
            padding-bottom: 5px;
        }

        label {
            display: block;
            font-size: 18px;
            color: #2a3a83;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #ffffff;
        }

        /* Button Styling */
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
</body>
</html>

