<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['userId'])) {
    header('Location: team-login.php');
    exit;
}

$loggedInUserId = $_SESSION['userId'];

$sql = "SELECT authorizedUsername FROM authorizeduser WHERE userId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUserId);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();

$sql_team = "SELECT teamName FROM team WHERE managerName = ?";
$stmt_team = $conn->prepare($sql_team);
$stmt_team->bind_param("s", $name);
$stmt_team->execute();
$stmt_team->bind_result($teamName);
$stmt_team->fetch();
$stmt_team->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $playerName = $_POST['playerName'];
    $contactNumber = $_POST['contactNumber'];
    $role = $_POST['role'];
    
    $error = null;

    if (!$error) {
        $sql_insert = "INSERT INTO player (playerName, contactNumber, teamName, role) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssss", $playerName, $contactNumber, $teamName, $role);

        if (!$stmt_insert->execute()) {
            $error = "Database Error: " . $stmt_insert->error;
        }
        $stmt_insert->close();
    }

    if ($error) {
        echo "<div class='error-message'>Error: " . htmlspecialchars($error) . "</div>";
    } else {
        echo "<div class='success-message'>Player added successfully!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player</title>
    <link rel="stylesheet" href="player-insert.css">
    <style>
        .error-message {
            color: red;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid red;
            background-color: #ffe6e6;
        }
        .success-message {
            color: green;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid green;
            background-color: #e6ffe6;
        }
    </style>
</head>
<body>
    <h1>Add Player to <?php echo htmlspecialchars($teamName); ?></h1>
    <form action="" method="POST">
        <label for="playerName">Player Name:</label>
        <input type="text" name="playerName" required>

        <label for="contactNumber">Contact Number:</label>
        <input type="text" name="contactNumber" required>

        <label for="role">Role:</label>
        <input type="text" name="role" required>

        <button type="submit">Add Player</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
