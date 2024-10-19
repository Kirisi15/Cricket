<?php
    include 'dbConnect.php';
    

    if(isset($_POST['submit'])){
        $gmail = $_POST['gmail'];
        $username = $_POST['authorizedUsername'];
        $password = $_POST['authorizedPassword'];

        $sql = "INSERT INTO authorizeduser (gmail, authorizedUsername, authorizedPassword) VALUES ('$gmail', '$username', '$password')";

        if($conn->query($sql) === true){
            echo " inserted successfully";
        }
        else{
            echo " error";
        }


    }
?>