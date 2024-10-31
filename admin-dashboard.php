<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #e3eaf2;
            color: #2a3a83;
        }

        h2 {
            color: #2a3a83;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #f1f5fc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
            font-size: 16px;
        }

        th {
            background-color: #2a3a83;
            color: #ffffff;
        }

        tr:hover {
            background-color: #e3eaf2;
        }

        button {
            padding: 5px 10px;
            font-size: 14px;
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
