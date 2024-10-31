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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #e3eaf2;
            color: #2a3a83;
        }

        h1, h2 {
            color: #2a3a83;
            margin-top: 20px;
        }

        .team-info {
            background-color: #f1f5fc;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px;
            text-align: left;
        }

        .player-card {
            border: 1px solid #000;
            padding: 10px;
            margin: 10px;
            width: 200px;
            text-align: center;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .player-card img {
            width: 100px;
            height: 100px;
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
            margin-top: 10px; /* Add margin to the top of the button */
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

<?php
if ($team) {
    echo "<h1>Team Dashboard - " . htmlspecialchars($team['teamName']) . "</h1>";
    echo "<p>Payment Status: " . ($team['paymentStatus'] ? 'Paid' : 'Pending') . "</p>";
    echo "<img src='" . htmlspecialchars($team['teamLogo']) . "' alt='Team Logo' style='width:100px;height:100px;'>";

    $sql_players = "SELECT playerName, contactNumber, playerImage, role FROM player WHERE teamName = ?";
    $stmt_players = $conn->prepare($sql_players);
    $stmt_players->bind_param("s", $team['teamName']);
    $stmt_players->execute();
    $result_players = $stmt_players->get_result();

    echo "<h2>Players in " . htmlspecialchars($team['teamName']) . "</h2>";
    echo "<div style='display: flex; flex-wrap: wrap; justify-content: center;'>";

    while ($player = $result_players->fetch_assoc()) {
        echo "
        <div class='player-card'>
            <img src='" . htmlspecialchars($player['playerImage']) . "' alt='Player Image'><br>
            <strong>" . htmlspecialchars($player['playerName']) . "</strong><br>
            <p>Contact: " . htmlspecialchars($player['contactNumber']) . "</p>
            <p>Role: " . htmlspecialchars($player['role']) . "</p>
        </div>";
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
