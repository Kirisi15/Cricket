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
$loggedInUserId = $_SESSION['userId'];

$sql = "SELECT teamId FROM authorizeduser WHERE userId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUserId);
$stmt->execute();
$stmt->bind_result($teamId);
$stmt->fetch();
$stmt->close();

$sql_team = "SELECT teamName, teamLogo, paymentStatus FROM team WHERE teamId = ?";
$stmt_team = $conn->prepare($sql_team);
$stmt_team->bind_param("s", $teamId);
$stmt_team->execute();
$result_team = $stmt_team->get_result();
$team = $result_team->fetch_assoc();
$stmt_team->close();

if ($team) {
    echo "<h1>Team Dashboard - " . $team['teamName'] . "</h1>";
    echo "<p>Payment Status: " . ($team['paymentStatus'] ? 'Paid' : 'Pending') . "</p>";
    echo "<img src='" . $team['teamLogo'] . "' alt='Team Logo' style='width:100px;height:100px;'>";

    $sql_players = "SELECT playerName, contactNumber, playerImage, role FROM player WHERE teamName = ?";
    $stmt_players = $conn->prepare($sql_players);
    $stmt_players->bind_param("s", $team['teamName']);
    $stmt_players->execute();
    $result_players = $stmt_players->get_result();

    echo "<h2>Players in " . $team['teamName'] . "</h2>";
    echo "<div style='display: flex; flex-wrap: wrap;'>";

    while ($player = $result_players->fetch_assoc()) {
        echo "
        <div style='border: 1px solid #000; padding: 10px; margin: 10px; width: 200px; text-align: center;'>
            <img src='" . $player['playerImage'] . "' alt='Player Image' style='width:100px;height:100px;'><br>
            <strong>" . $player['playerName'] . "</strong><br>
            <p>Contact: " . $player['contactNumber'] . "</p>
            <p>Role: " . $player['role'] . "</p>
        </div>";
    }

    echo "</div>";
    echo "<a href='player-insert.php' style='margin-bottom:10px;'>Add New Player</a>";

    echo "
    <form action='team-dashboard.php' method='POST'>
    <button type='submit' name='logout'>Logout</button>
    </form>  ";

} else {
    echo "<p>No team found for this user.</p>";
    echo "<a href='create-team.php'>Create a Team</a> ";

}

$conn->close();

?>
