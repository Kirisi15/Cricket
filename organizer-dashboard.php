<?php
session_start();
include 'db.php';

if (!isset($_SESSION['organizerId'])) {
    header('Location: organizer-login.php');
    exit;
}

$organizerId = $_SESSION['organizerId'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['scheduleMatch'])) {
    $teamIdA = $_POST['teamIdA'];
    $teamIdB = $_POST['teamIdB'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $venue = $_POST['venue'];

    $sql = "INSERT INTO matches (teamIdA, teamIdB, date, time, venue, organizerId) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $teamIdA, $teamIdB, $date, $time, $venue, $organizerId);

    if ($stmt->execute()) {
        $success = "Match scheduled successfully!";
    } else {
        $error = "Error scheduling match: " . $stmt->error;
    }
    $stmt->close();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: organizer-login.php');
    exit;
}

$sql_teams = "SELECT teamId, teamName FROM team";
$result_teams = $conn->query($sql_teams);
$teams = [];

if ($result_teams->num_rows > 0) {
    while ($row = $result_teams->fetch_assoc()) {
        $teams[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Dashboard</title>
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
            font-size: 32px;
            color: #2a3a83;
            margin-top: 20px;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
        }

        .match-form {
            display: inline-block;
            background-color: #f1f5fc;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        label {
            display: block;
            font-size: 18px;
            color: #2a3a83;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="date"], input[type="time"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #2a3a83;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #ffffff;
        }

        button {
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

        button:hover {
            background-color: #43429e;
        }

        /* Logout Button Positioning */
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

       
    </style>
</head>
<body>
    <h1>Organizer Dashboard</h1>
    
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="organizer-dashboard.php" method="POST" class="logout-button">
        <button type="submit" name="logout">Logout</button>
    </form>

    <h2>Schedule a Match</h2>
    <form action="organizer-dashboard.php" method="POST" class="match-form">
        <label for="teamIdA">Team A:</label>
        <select id="teamIdA" name="teamIdA" required>
            <option value="">Select Team A</option>
            <?php foreach ($teams as $team) : ?>
                <option value="<?= $team['teamId'] ?>"><?= $team['teamName'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="teamIdB">Team B:</label>
        <select id="teamIdB" name="teamIdB" required>
            <option value="">Select Team B</option>
            <?php foreach ($teams as $team) : ?>
                <option value="<?= $team['teamId'] ?>"><?= $team['teamName'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>

        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" required>

        <button type="submit" name="scheduleMatch">Schedule Match</button>
    </form>
</body>
</html>
