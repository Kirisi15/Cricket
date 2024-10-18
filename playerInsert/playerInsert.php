<?php
    include 'dbConnect.php';
    
    if(isset($_POST['submit'])){
        $playername = $_POST['playerName'];
        $contactnumber = md5($_POST['contactNumber']);
        $playerimage = $_POST['playerImage'];
        $teamname = $_POST['teamName'];
        $role = $_POST['role'];
        
        $sql = "INSERT INTO player (playerName, contactNumber, playerImage, teamName, role) VALUES ('$playername', '$contactnumber', '$playerimage', '$teamname', '$role')";

        if($conn->query($sql)=== true){
            echo " inserted successfully";
        }
        else{
            echo " error";
        }
    }
?>