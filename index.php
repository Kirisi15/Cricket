<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar with Matches and Rankings</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center; 
        }
        nav {
            display: inline-block; 
            margin: 20px auto; 
            padding: 0;
        }
        .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; 
        }
        .navbar li {
            position: relative;
            margin-right: 20px;
        }
        .navbar a {
            color: black;
            text-decoration: none;
            padding: 14px 20px;
            display: block;
        }
        .navbar a:hover {
            text-decoration: underline;
            transition: 0.3s;
        }
        .dropdown-content {
            list-style-type: none;
            display: none;
            position: absolute;
            min-width: 160px;
            top: 100%;
            z-index: 1;
            padding: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        .dropdown-content li {
            width: 100%;
        }
        .dropdown-content a {
            padding: 12px 16px;
            text-align: center;
            display: block;
        }
        .dropdown-content a:hover {
            text-decoration: underline;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .match-group, .rankings-group {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .match-group h2, .rankings-group h2 {
            margin: 10px 0;
        }
        #matches {
            position: absolute;
            top: 30%;
            left: 30%;
        }
    </style>
</head>
<body>

    <nav>
        <ul class="navbar">
            <li><a href="#matches">Matches</a></li>
            <li><a href="#news">News</a></li>
            <li><a href="rankings.php">Rankings</a></li>
            <li class="dropdown">
                <a href="#login">Login</a>
                <ul class="dropdown-content">
                    <li><a href="team-login.php">Team Login</a></li>
                    <li><a href="admin-login.php">Admin Login</a></li>
                    <li><a href="organizer-login.php">Organizer Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="matches">
        <h1>Matches</h1>

        <?php
        include 'db.php';
        $today = date('Y-m-d');

        $upcomingMatchesSql = "SELECT * FROM matches WHERE date > ? ORDER BY date, time";
        $stmt = $conn->prepare($upcomingMatchesSql);
        $stmt->bind_param("s", $today);
        $stmt->execute();
        $upcomingResult = $stmt->get_result();

        $finishedMatchesSql = "SELECT * FROM matches WHERE date <= ? ORDER BY date DESC, time DESC";
        $stmtFinished = $conn->prepare($finishedMatchesSql);
        $stmtFinished->bind_param("s", $today);
        $stmtFinished->execute();
        $finishedResult = $stmtFinished->get_result();

        echo '<div class="match-group">';
        echo '<h2>Upcoming Matches</h2>';
        if ($upcomingResult->num_rows > 0) {
            while ($match = $upcomingResult->fetch_assoc()) {
                echo '<p><strong>' . $match['teamIdA'] . '</strong> vs <strong>' . $match['teamIdB'] . '</strong> on ' . $match['date'] . ' at ' . $match['time'] . ' in ' . $match['venue'] . '</p>';
            }
        } else {
            echo '<p>No upcoming matches.</p>';
        }
        echo '</div>';

        echo '<div class="match-group">';
        echo '<h2>Finished Matches</h2>';
        if ($finishedResult->num_rows > 0) {
            while ($match = $finishedResult->fetch_assoc()) {
                echo '<p><strong>' . $match['teamIdA'] . '</strong> vs <strong>' . $match['teamIdB'] . '</strong> on ' . $match['date'] . ' - Score: ' . $match['scoreTeamA'] . ' - ' . $match['scoreTeamB'] . ' - Winner: ' . $match['winningTeam'] . '</p>';
            }
        } else {
            echo '<p>No finished matches.</p>';
        }
        echo '</div>';

        $stmt->close();
        $stmtFinished->close();

        $rankingsSql = "
        SELECT 
           team.teamName, 
        COUNT(matches.winningTeam) AS wins
        FROM 
           team
        LEFT JOIN 
           matches ON team.teamName = matches.winningTeam
        GROUP BY 
           team.teamName
        ORDER BY 
           wins DESC
        LIMIT 5
        ";
        $rankingsResult = mysqli_query($conn, $rankingsSql);

        echo '<div class="rankings-group">';
        echo '<h2>Top 5 Teams</h2>';
        if (mysqli_num_rows($rankingsResult) > 0) {
            $rank = 1;
            while ($team = mysqli_fetch_assoc($rankingsResult)) {
                echo '<p>' . $rank . '. ' . $team['teamName'] . ' - Wins: ' . $team['wins'] . '</p>';
                $rank++;
            }
        } else {
            echo '<p>No rankings available.</p>';
        }
        echo '</div>';

        mysqli_close($conn);
        ?>

    </div>
</body>
</html>
