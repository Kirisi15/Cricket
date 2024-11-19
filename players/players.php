<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Players</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>

nav {
  z-index: 100;
  display: block; 
  top: 0;
  position: fixed;
  padding: 10px;
  background-color: #2a3a83;
  width: 100%;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
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
}

.navbar li:hover {
  background-color: #1d67a3;
  border-radius: 10px;
  
}

.navbar a {
  color: #ffffff;
  text-decoration: none;
  padding: 14px 20px;
  display: block;
  font-family: 'Trebuchet MS', sans-serif;
}

.navbar a:hover {
  color: #ffffff;
}

.dropdown {
  position: relative;
}

.dropdown-content {
  list-style-type: none;
  display: none; 
  position: absolute;
  background-color: #2a3a83;
  min-width: 160px;
  top: 100%;
  z-index: 1;
  padding: 0;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  border-radius: 5px;
}

.dropdown-content li:hover {
  background-color: #1d67a3;
}

.dropdown-content a {
  color: #ffffff;
  padding: 12px 16px;
  text-align: center;
  display: block;
}

.dropdown:hover .dropdown-content {
  display: block;
}

/* Mobile Navigation */
.nav-toggle {
  display: none;
}




@media (max-width: 768px) {
  .nav{
      padding: 0;
  }
  .nav-toggle {
      width: 96%;
      margin: 0;
      display: block;
      background-color: #2a3a83;
      color: #ffffff;
      border: none;
      padding: 0px;
      font-size: 30px;
      cursor: pointer;
      text-align: left;
  }
  .nav-toggle:hover {
      background-color: #2a3a83;
  }

  .navbar {
      flex-direction: column;
      align-items: flex-start;
      display: none;
      background-color: #2a3a83;
      padding: 0;
  }

  .navbar.active {
      display: flex;
  }

  .navbar li {
      width: 96%;

      border-bottom: 1px solid #1d67a3;
  }

  .navbar li:last-child {
      border-bottom: none;
  }

  .navbar a {
      width: 100%;
      text-align: left;
      margin: 0;
  }

  .dropdown-content {
      left: 0;
      transform: none;
      width: 100%;
  }

  .dropdown-content a {
      padding: 10px 20px;
  }
  .dropdown-content li:hover {
      background-color: #1d67a3;
      width: 100%;
  }

}

body{
  background-color: #edf5fe;
  
}





a {
    color:#edf5fe;
    font-family: Arial, Helvetica, sans-serif;

}



footer {
    background-color: #2a3a83; /* Same color as nav bar */
    color: #ffffff;
    padding: 20px;
    text-align: center;
    position: relative;
    
}

footer .footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

footer .footer-content p {
    margin: 5px 0;
}

footer .social-icons {
    margin-top: 10px;
}

footer .social-icons a {
    color: #ffffff;
    margin: 0 10px;
    text-decoration: none;
    font-size: 24px;
    transition: color 0.3s ease;
}

footer .social-icons a:hover {
    color: #1d67a3;
}

.players{

  list-style: none;
  display: flex;
  flex-wrap: wrap;
  gap:10px;

  justify-content: center;
  

}

.player{

  background-color:#1d67a3;
  border-radius: 10px;


}

*{
  margin: 0;
}

.description{

  text-align: center;
  padding:10px;

}

.team{
  text-align: center;
  margin-top: 80px;
  margin-bottom: 15px;
  padding-top:10px;
  
}

.team-players{

  background-color: RGB(42, 58, 131,0.4);
  margin-bottom: 30px;
  padding-bottom: 20px;
  margin-left: 15px;
  margin-right: 15px;
  border-radius: 10px;

}


</style>  
</head>

  
<?php

include "dbConnect.php";
include "../header/header.php";


if(isset($_GET['teamName'])){

  $teamName = $_GET['teamName'];

}


$sql = "SELECT * FROM team WHERE teamName = '$teamName'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

echo"<div class='team-players'>";
echo"<div class='team'>";
echo"<img src='/".$row['teamLogo']."' width=150 height=150>";
echo"</div>";

$sql = "SELECT * FROM player WHERE teamName = '$teamName'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

echo "<ul class= players>";
  while ($row = mysqli_fetch_assoc($result)) {
  
echo"<a href='../player-cart/card.php?playerId=".$row['playerId']."' style='text-decoration: none'>";    
echo"<li class='player'>";    
echo"<div class=player-container>";
echo "<image src='/".$row['playerImage']."' width =200 height =200><br>";
echo"<div class ='description'>";
echo"<h4>".$row['playerName']."</h4>
     <h5>".$row['role']."</h5>";

echo "</div>";
echo "</div>";

echo"</li>";
echo "</a>";
}

echo "</ul>";

}

?>

</div>

<?php
include "../footer/footer.php";
?>     

</body>
</html>