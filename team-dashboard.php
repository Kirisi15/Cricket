<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['userId'])) {
    header('Location: team-login.php');
    exit;
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: team-login.php');
    exit;
}

// Handle player removal
if (isset($_POST['removePlayer'])) {
    $playerId = $_POST['playerId'];
    $sql_delete = "DELETE FROM player WHERE playerId = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("s", $playerId);
    $stmt_delete->execute();
    $stmt_delete->close();
}

$loggedInUserId = $_SESSION['userId'];

$sql = "SELECT authorizedUsername FROM authorizeduser WHERE userId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUserId);
$stmt->execute();
$stmt->bind_result($authusername);
$stmt->fetch();
$stmt->close();

$sql_team = "SELECT teamId, teamName, teamLogo, paymentStatus FROM team WHERE managerName = ?";
$stmt_team = $conn->prepare($sql_team);
$stmt_team->bind_param("s", $authusername);
$stmt_team->execute();
$result_team = $stmt_team->get_result();
$team = $result_team->fetch_assoc();
$stmt_team->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Dashboard</title>
    <link rel="stylesheet" href="team-dashboard.css">
</head>
<body>
<?php
if ($team) {
    echo "<h1>Team Dashboard - " . htmlspecialchars($team['teamName']) . "</h1>";
    echo "<p>Payment Status: " . ($team['paymentStatus'] ? 'Paid' : 'Pending') . "</p>";
    echo "<img src='" . htmlspecialchars($team['teamLogo']) . "' alt='Team Logo' class='team-logo'>";

    $sql_players = "SELECT playerId, playerName, contactNumber, playerImage, role FROM player WHERE teamName = ?";
    $stmt_players = $conn->prepare($sql_players);
    $stmt_players->bind_param("s", $team['teamName']);
    $stmt_players->execute();
    $result_players = $stmt_players->get_result();

    echo "<h2>Players in " . htmlspecialchars($team['teamName']) . "</h2>";
    echo "<div class='player-container'>";

    while ($player = $result_players->fetch_assoc()) {
        echo "
        <div class='card'>
            <img src='images/3.jpg' alt='Player Image' class='card-img'>
            <div class='card-body'>
                <h5 class='card-title'>" . htmlspecialchars($player['playerName']) . "</h5>
                <p class='card-text'>Contact: " . htmlspecialchars($player['contactNumber']) . " </br>Role: " . htmlspecialchars($player['role']) . "</p>
                <form action='team-dashboard.php' method='POST'>
                    <input type='hidden' name='playerId' value='" . htmlspecialchars($player['playerId']) . "'>
                    <button type='submit' name='removePlayer' class='btn'>Remove</button>
                </form>
            </div>
        </div>
        ";
    }

    echo "</div>";
    echo "<a href='player-insert.php'>Add New Player</a>";
    
    echo "
    <form action='team-dashboard.php' method='POST'>
        <button type='submit' name='logout'>Logout</button>
    </form>";  

} else {
    echo "<p>No team found for this user.</p>";
    echo "<a href='create-team.php'>Create a Team</a>";
}

$conn->close();
?>
</body>
</html>
