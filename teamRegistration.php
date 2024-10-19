<?php
    include 'dbConnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1>Team Registration</h1>
</head>
<body>
    <form method = "POST" action = "teamInsert.php">

        <label for = "teamUsername" > Username : </label>
        <input type = "text" name ="teamUsername" placeholder = "Create username" required><br><br>

        <label for = "teamPassword" >Password :</label>
        <input type = "password" name ="teamPassword" placeholder = "Create password" required><br><br>

        <label for = "paymentStatus" >Payment status :</label>
        <input type="radio" name="paymentStatus" value="1"> Yes
        <input type="radio" name="paymentStatus" value="0"> No<br><br><br>

        <label for = "managerName" > Manager Name : </label>
        <input type = "text" name ="managerName" placeholder = "Enter manager name" required><br><br>

        <label for = "teamLogo" > Team Logo : </label>
        <input type = "file" name ="teamLogo" required><br>

        <label for = "teamName" > Team Name : </label>
        <input type = "text" name ="teamName" placeholder = "Enter team name" required><br><br>

        <input type="submit" name="submit" value="Register"> <br><br>
        
        <a href="playerRegistration.php"> Add players </a>
    </form>
</body>
</html>