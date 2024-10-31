<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['userId'])) {
    header('Location: team-login.php');
    exit;
}

$loggedInUserId = $_SESSION['userId'];

$sql = "SELECT teamId FROM authorizeduser WHERE userId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUserId);
$stmt->execute();
$stmt->bind_result($teamId);
$stmt->fetch();
$stmt->close();

$sql_team = "SELECT teamName FROM team WHERE teamId = ?";
$stmt_team = $conn->prepare($sql_team);
$stmt_team->bind_param("s", $teamId);
$stmt_team->execute();
$stmt_team->bind_result($teamName);
$stmt_team->fetch();
$stmt_team->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $playerName = $_POST['playerName'];
    $contactNumber = $_POST['contactNumber'];
    $role = $_POST['role'];

    $sql_insert = "INSERT INTO player (playerName, contactNumber, teamName, role) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ssss", $playerName, $contactNumber, $teamName, $role);

    if ($stmt_insert->execute()) {
        echo "<p>Player added successfully!</p>";
    } else {
        echo "<p>Error adding player. Please try again.</p>";
    }

    $stmt_insert->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #e3eaf2;
            color: #2a3a83;
        }

        h1 {
            color: #2a3a83;
            margin-top: 20px;
        }

        form {
            background-color: #f1f5fc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 400px;
            text-align: left;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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

        a {
            color: #2a3a83;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin: 10px 0;
        }

        a:hover {
            color: #43429e;
        }
    </style>
</head>
<body>
    <h1>Add Player to <?php echo htmlspecialchars($teamName); ?></h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="playerName">Player Name:</label>
        <input type="text" name="playerName" required>

        <label for="contactNumber">Contact Number:</label>
        <input type="text" name="contactNumber" required>

        <label for="role">Role:</label>
        <input type="text" name="role" required>

        <label for="playerImage">Player Image:</label>
        <input type="file" name="playerImage">

        <button type="submit">Add Player</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
