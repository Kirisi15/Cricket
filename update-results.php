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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #e3eaf2;
            color: #2a3a83;
        }

        h1 {
            color: #2a3a83;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #f1f5fc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"],
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            color: #fff;
            background-color: #2a3a83;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #43429e;
        }
    </style>
</head>
<body>
    <h1>Edit Match Details</h1>

    <form action="update-results.php?matchId=<?= $match['matchId'] ?>" method="POST">
        <label for="scoreTeamA">Score Team A:</label>
        <input type="number" id="scoreTeamA" name="scoreTeamA" value="<?= $match['scoreTeamA'] ?>" required>

        <label for="scoreTeamB">Score Team B:</label>
        <input type="number" id="scoreTeamB" name="scoreTeamB" value="<?= $match['scoreTeamB'] ?>" required>

        <label for="winningTeam">Winning Team:</label>
        <input type="text" id="winningTeam" name="winningTeam" value="<?= $match['winningTeam'] ?>" required>

        <button type="submit" name="updateMatch">Update Match</button>
    </form>

    <form action="admin-dashboard.php" method="POST">
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>
</html>
