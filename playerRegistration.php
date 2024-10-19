<?php
    include 'dbConnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1>Player Registration</h1>
</head>
<body>
    <form method = "POST" action = "playerInsert.php">

        <label for = "playerName" > Player Name : </label>
        <input type = "text" name ="playerName" placeholder = "Enter player name" required><br><br>

        <label for = "contactNumber" >Contact Number :</label>
        <input type = "tel" name ="contactNumber" placeholder = "Enter contact number" required><br><br>

        <label for = "playerImage" > Player Image : </label>
        <input type = "file" name ="playerImage" required><br><br>

        <label for = "teamName" > Team Name : </label>
        <input type = "text" name ="teamName" placeholder = "Enter team name" required><br><br>

        <label for = "role" >Role : </label>
        <select>
            <option value = "batter">Batter</option> 
            <option value = "bowler">Bowler</option> 
            <option value = "wicketkeeper">Wicket keeper</option> 
            <option value = "all-rounders">all-rounders</option> 
        </select>

        <input type="submit" name="submit" value="Register"> <br><br>
        
     
    </form>
</body>
</html>
