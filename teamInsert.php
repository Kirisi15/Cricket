<?php
    include 'dbConnect.php';
    
    if(isset($_POST['submit'])){
        $username = $_POST['teamUsername'];
        $password = md5($_POST['teamPassword']);
        $paymentstatus = $_POST['paymentStatus'];
        $managername = $_POST['managerName'];
        $teamlogo = $_POST['teamLogo'];
        $teamname = $_POST['teamName'];
        
        $sql = "INSERT INTO team (teamUsername, teamPassword, paymentStatus, managerName, teamLogo, teamName) VALUES ('$username', '$password', '$paymentstatus', '$managername', '$teamlogo', '$teamname')";

        if($conn->query($sql)=== true){
            echo " inserted successfully";
        }
        else{
            echo " error";
        }
    }
?>