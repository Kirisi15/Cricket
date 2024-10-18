<?php
include 'db.php';

$sql = "
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
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Rankings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1>Team Rankings</h1>

    <table>
        <tr>
            <th>Rank</th>
            <th>Team Name</th>
            <th>Wins</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            $rank = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$rank}</td>
                        <td>{$row['teamName']}</td>
                        <td>{$row['wins']}</td>
                    </tr>";
                $rank++;
            }
        } else {
            echo "<tr><td colspan='3'>No teams found</td></tr>";
        }
        ?>

    </table>

</body>
</html>
