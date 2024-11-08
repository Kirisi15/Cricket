<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Results</title>
    <link rel="stylesheet" href="admin-dashboard.css">
</head>
<body>
    <h2>Match Results</h2>
    <?php
        include 'db.php';

        $sql = "SELECT * FROM matches";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <thead>
                        <tr>
                            <th>Match ID</th>
                            <th>Organizer ID</th>
                            <th>Team A ID</th>
                            <th>Team B ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Venue</th>
                            <th>Score Team A</th>
                            <th>Score Team B</th>
                            <th>Winning Team</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['matchId']."</td>
                    <td>".$row['organizerId']."</td>
                    <td>".$row['teamIdA']."</td>
                    <td>".$row['teamIdB']."</td>
                    <td>".$row['date']."</td>
                    <td>".$row['time']."</td>
                    <td>".$row['venue']."</td>
                    <td>".$row['scoreTeamA']."</td>
                    <td>".$row['scoreTeamB']."</td>
                    <td>".$row['winningTeam']."</td>
                    <td>
                        <form method='GET' action='update-results.php'>
                            <input type='hidden' name='matchId' value='".$row['matchId']."'>
                            <button type='submit' name='edit'>Edit</button>
                        </form>
                    </td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No matches found.</p>";
        }
    ?>
</body>
</html>
