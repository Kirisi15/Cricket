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
    
    
    $sql_insert = "INSERT INTO player ( playerName, contactNumber, teamName, role) VALUES ('?', '?', '?', '?')";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ssss", $playerName,  $contactNumber,$teamName,  $role);

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
</head>
<body>
    <h1>Add Player to <?php echo $teamName; ?></h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="playerName">Player Name:</label>
        <input type="text" name="playerName" required><br>

        <label for="contactNumber">Contact Number:</label>
        <input type="text" name="contactNumber" required><br>

        <label for="role">Role:</label>
        <input type="text" name="role" required><br>

        <label for="playerImage">Player Image:</label>
        <input type="file" name="playerImage"><br>

        <button type="submit">Add Player</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
