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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Organizer Dashboard</h1>
    
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <h2>Schedule a Match</h2>
    <form action="organizer-dashboard.php" method="POST">
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

    <form action="organizer-dashboard.php" method="POST" style="margin-top: 20px;">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
