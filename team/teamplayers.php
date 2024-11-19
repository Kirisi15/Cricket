<?php
include "dbconnect.php";
include "../header/header.php";
?>
<head>
    <!-- ...existing head content... -->
    <link rel="stylesheet" href="../team-dashboard.css">
</head>
<?php
if (isset($_GET['teamName'])) {
    $teamName = $_GET['teamName'];
    
    $sql_team = "SELECT teamId, teamName, teamLogo FROM team WHERE teamName = ?";
    $stmt_team = $conn->prepare($sql_team);
    $stmt_team->bind_param("s", $teamName);
    $stmt_team->execute();
    $result_team = $stmt_team->get_result();
    $team = $result_team->fetch_assoc();
    $stmt_team->close();
    
    if ($team) {
        echo "<h1>Players in " . htmlspecialchars($team['teamName']) . "</h1>";
        echo "<img src='" . htmlspecialchars($team['teamLogo']) . "' alt='Team Logo' class='team-logo'>";
        
        $sql_players = "SELECT playerName, contactNumber, playerImage, role FROM player WHERE teamName = ?";
        $stmt_players = $conn->prepare($sql_players);
        $stmt_players->bind_param("s", $teamName);
        $stmt_players->execute();
        $result_players = $stmt_players->get_result();
        
        echo "<div class='player-container'>";
        
        while ($player = $result_players->fetch_assoc()) {
            echo "
            <div class='card'>
                <img src='" . htmlspecialchars($player['playerImage']) . "' alt='Player Image' class='card-img'>
                <div class='card-body'>
                    <h5 class='card-title'>" . htmlspecialchars($player['playerName']) . "</h5>
                    <p class='card-text'>Contact: " . htmlspecialchars($player['contactNumber']) . "<br>Role: " . htmlspecialchars($player['role']) . "</p>
                </div>
            </div>
            ";
        }
        
        echo "</div>";
    } else {
        echo "<p>No team found with the name " . htmlspecialchars($teamName) . ".</p>";
    }
} else {
    echo "<p>No team selected.</p>";
}

include "../footer/footer.php";
?>
