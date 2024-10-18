<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?PHP
        include 'dbConnect.php';
        
        $sql="SELECT * FROM matches";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            echo "<table>
                    <th>matchId</th>
                    <th>organizerId</th>
                    <th>teamIdA</th>
                    <th>teamIdB</th>
                    <th>date</th>
                    <th>time</th>
                    <th>venue</th>
                    <th>scoreTeamA</th>
                    <th>scoreTeamB</th>
                    <th>winningTeam</th>";
                while($row=mysqli_fetch_assoc($result))
                {
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
                        <td><form type='POST'><button type='button' name='edit'>EDIT</button></form>";

                    echo "</tr>";
                }
            echo "</table>";
        }

        if(isset($_POST['edit']))
        {
            header('location:matchEdit.php');
        }
            

    ?>
</body>
</html>