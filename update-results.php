<?php
include 'db.php';

if (isset($_GET['matchId'])) {
    $matchId = $_GET['matchId'];

    $sql = "SELECT * FROM matches WHERE matchId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $matchId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $match = $result->fetch_assoc();
    } else {
        echo "No match found!";
        exit;
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateMatch'])) {
    $scoreTeamA = $_POST['scoreTeamA'];
    $scoreTeamB = $_POST['scoreTeamB'];
    $winningTeam = $_POST['winningTeam'];
    
    $sql_update = "UPDATE matches SET scoreTeamA = ?, scoreTeamB = ?, winningTeam = ? WHERE matchId = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('iisi', $scoreTeamA, $scoreTeamB, $winningTeam, $matchId);

    if ($stmt_update->execute()) {
        echo "Match updated successfully!";
        header("Location: admin-dashboard.php"); 
        exit;
    } else {
        echo "Error updating match: " . $stmt_update->error;
    }
    $stmt_update->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Match</title>
</head>
<body>
    <h1>Edit Match Details</h1>

    <form action="update-results.php?matchId=<?= $match['matchId'] ?>" method="POST">
        <label for="scoreTeamA">Score Team A:</label>
        <input type="number" id="scoreTeamA" name="scoreTeamA" value="<?= $match['scoreTeamA'] ?>" required><br><br>

        <label for="scoreTeamB">Score Team B:</label>
        <input type="number" id="scoreTeamB" name="scoreTeamB" value="<?= $match['scoreTeamB'] ?>" required><br><br>

        <label for="winningTeam">Winning Team:</label>
        <input type="text" id="winningTeam" name="winningTeam" value="<?= $match['winningTeam'] ?>" required><br><br>

        <button type="submit" name="updateMatch">Update Match</button>
    </form>

    <form action="admin-dashboard.php" method="POST">
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>
</html>
