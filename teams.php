<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teams</title>

  
<link rel="stylesheet" href="../header/header-styles.css">
<link rel="stylesheet" href="teams-styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


  <style>
    .main-image-container {
      margin-top: 100px;
      position: relative;
      margin-right: 40px;
      margin-left: 40px;

    }



    .main-image {


      max-height: 700px;
      width: 100%;
      height: 100%;
      transition: opacity 0.5s ease;
      animation: slideIn 1s forwards;
      border-radius: 10px;


    }

    .image-description {

      background: linear-gradient(to right, rgb(0, 96, 206, 0.2), rgb(31, 78, 156, 0.2));
      position: absolute;
      justify-content: center;
      width: 500px;
      animation: slideIn 1s forwards;
      border-radius: 10px;
      padding: 10px;
      top: 30%;
      font-family: Arial, Helvetica, sans-serif;
      color: whitesmoke;
      margin-top: -20px;


    }

    .image-description h1 {
      font-weight: bolder;
    }


    .team-description {


      color: whitesmoke;
      font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
      padding: 10px;
      border-radius: 15px;
      max-width: 400px;

    }



    .team-logo-and-description{
      gap:5px;
      display: flex;
      flex-direction: row;
      align-items: center;
      margin-right: 5px;
      flex: 1;
    }

    .team-slide-show-without-dots{

      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;

    }
    .team-slide{
      display: flex;
      justify-content: space-between;
    }
    .team-slide-show-container{

      display: flex;
      flex-direction: column;
      margin-top: 50px;
      margin-bottom:100px;
      align-items: center;
      background: linear-gradient(to bottom, #2a3a83, #7270e6);
      padding-top: 30px;
      padding-bottom: 15px;
      margin-left: 5px;
      margin-right: 5px;
      border-radius: 10px;
      
    }

    .dot {
  cursor: pointer;
  height: 10px;
  width: 10px;
  margin: 0 2px;
  margin-bottom:15px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.dot:act{

  background-color:rgb(0,0,0,0.3);

}

.dots{
  margin-top: 20px;
}

.next,.prev{

  cursor: pointer;
  border: none;
  padding:10px;
  background-color:white;
  color: #2a3a83;
  font-size: x-large;
  border-radius: 10px;
  transition: 0.5s;


}

.next{
  margin-left: 20px;
 
}


.prev:hover{
  color:white;
  background-color: #2a3a83;
}

.next:hover{
  color:white;
  background-color: #2a3a83;
}

.active, .dot:hover {
  background-color: #717171;
}

.team-video{
max-width: 600px;


}
@media (max-width: 950px) {
  .team-video {
   max-width: 500px;
  }
}

@media (max-width: 480px) {
  .team-video {
   max-width: 180px;
  }
}

.slide-in-left {
  transform: translateX(-100%); 
  animation: slideLeft 0.5s forwards;
}

.slide-in-right {
  transform: translateX(100%); 
  animation: slideRight 0.5s forwards;
}

@keyframes slideLeft {
  from {
    transform: translateX(100%);
  }
  to {
    transform: translateX(0);
  }
}

@keyframes slideRight {
  from {
    transform: translateX(-100%);
  }
  to {
    transform: translateX(0);
  }
}

 

    @keyframes slideOut {
      from {
        transform: translateX(0);
        opacity: 1;
      }

      to {
        transform: translateX(100%);
        opacity: 0;
      }
    }



    @keyframes slideIn {
      from {
        transform: translateX(-100%);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }

    }

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
  color: #333;
}


h1, h2, h3, h4, h5, h6 {
    color: #2a3a83;
}

a {
    color: #1d67a3;
}

a:hover {
    color: #134b7f;
}

footer {
    background-color: #2a3a83; 
    color: #ffffff;
    padding: 20px;
    text-align: center;
    position: relative;
    margin-top: -30px; 
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

.dots{
  display: flex;
  flex-direction: row;
}



  </style>

</head>



<body>

  <?php

  include "dbConnect.php";

  include "../header/header.php";
  ?>
  <div class='main-image-container'>


    <img src='http://localhost/Cricket-final/team-main-images/f9be4234-9a4b-43b4-870c-fec9e23d8c57.jpg' class='main-image'>
    <div class='image-description'>

      <div class='description-main-content'>
        <h1>Binura Fernando's Five-Wicket Haul Guides Colombo Strikers to Victory Over Galle Marvels</h1>
        <br>
        <p>Binura Fernando delivered a sensational performance, taking 5 wickets to dismantle the Galle Marvels' batting lineup. His outstanding spell led the Colombo Strikers to a commanding win, securing them an impressive victory in the latest Lanka Premier League clash.</p>
      </div>


    </div>

  </div>



  <?php
  $sql = "SELECT * FROM team";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    echo "<div class='team-slide-show-container'>";

    echo"<div class='team-slide-show-without-dots'>";

    echo"  <button class='prev' onclick='pullSlides(1)'>&#10094;</button>";

    while ($row = mysqli_fetch_assoc($result)) {



      if ($row['teamName'] === 'Colombo Strikers') {

        

        echo "<div class='team-slide'>";
        echo "<div class='team-logo-and-description'>";
        echo "<div class='logo'>";
        echo "<a href='/Cricket-final/players/players.php?teamName=" . $row['teamName'] . "'>";
        echo "<img src='/" . $row['teamLogo'] . "' width=200 height=200>";
        echo "</a>";
        echo "</div>
          
                  <div class='team-description' style='background: #2a3a83'>
                  A powerhouse team from Sri Lanka's capital, Colombo Strikers are known for their aggressive gameplay and strong batting lineup. They have a rich history in the Lanka Premier League (LPL) and are fan favorites for their high-energy performances.
                  </div>
          
          ";

        echo "</div>";



        echo "<video width='600' class='team-video' controls autoplay poster='colombo-thumbnail.avif'>
                    <source src='The roar that reaches from New York To Colombo.🔥Entering strong with colombostrikers at the lplt20 🐯.mp4' type='video/mp4'>
                  </video>
        </div>
                  
                  ";
      } else if ($row['teamName'] === 'Jaffna Kings') {


        

        echo "<div class='team-slide'>";
        echo "<div class='team-logo-and-description'>";
        echo "<div class='logo'>";
        echo "<a href='/Cricket-final/players/players.php?teamName=" . $row['teamName'] . "'>";
        echo "<img src='/" . $row['teamLogo'] . "' width=200 height=200>";
        echo "</a>";
        echo "</div>
          
                         
              <div class='team-description' style='background: #2a3a83' >

              Jaffna Kings are a dominant force in the LPL, known for their solid team structure and exceptional performances in both batting and bowling. With a fierce determination, they are a favorite for many fans, always putting on thrilling displays.

              </div>
          
          ";

        echo "</div>";

        echo "<video width='600' class='team-video' controls autoplay poster='jaffna-thumbnail.jpg'>
                    <source src='Vijayakanth Viyaskanth 3 Wickets .mp4' type='video/mp4'>
                  </video>cf
    
        </div>
                  ";
      } else if ($row['teamName'] === 'Dambulla Thunders') {

        

        echo "<div class='team-slide'>";
        echo "<div class='team-logo-and-description'>";
        echo "<div class='logo'>";
        echo "<a href='/Cricket-final/players/players.php?teamName=" . $row['teamName'] . "'>";
        echo "<img src='/" . $row['teamLogo'] . "' width=200 height=200>";
        echo "</a>";
        echo "</div>

               
   <div class='team-description' style='background: #2a3a83'>

              Representing the heart of Sri Lanka, Dambulla Thunders are known for their strong bowling attack and solid all-rounders. With a mix of youth and experience, they are a formidable team in the LPL, always fighting hard for victory.

              </div>

    </div>

";

        echo "<video width='600' class='team-video' controls autoplay poster='dambulla-thumbnail.jpeg'>
                    <source src='Chamindu Wickramasinghe .mp4' type='video/mp4'>
                  </video>
                  
                  </div>
                  ";
      } else if ($row['teamName'] === 'B-Love Kandy') {

        

        echo "<div class='team-slide'>";
        echo "<div class='team-logo-and-description'>";
        echo "<div class='logo'>";
        echo "<a href='/Cricket-final/players/players.php?teamName=" . $row['teamName'] . "'>";
        echo "<img src='/" . $row['teamLogo'] . "' width=200 height=200>";
        echo "</a>";
        echo "</div>

               
              <div class='team-description' style='background: #2a3a83'>

              B-Love Kandy is a team full of passion and flair, representing Kandy with pride. Known for their aggressive batting and strong leadership, they aim to make a mark in every LPL season, captivating fans with their exciting cricketing style.

              </div>
          </div>
";

        echo "<video width='600' class='team-video' controls autoplay poster='kandy-thumbnail.jpg'>
                    <source src='B-Love Kandy LPL 2023 .mp4' type='video/mp4'>
                  </video>
                  
  
              </div>
                  ";
      } else if ($row['teamName'] === 'Galle Marvels') {

        

        echo "<div class='team-slide'>";
        echo "<div class='team-logo-and-description'>";
        echo "<div class='logo'>";
        echo "<a href='/Cricket-final/players/players.php?teamName=" . $row['teamName'] . "'>";
        echo "<img src='/" . $row['teamLogo'] . "' width=200 height=200>";
        echo "</a>";
        echo "</div>

               
              <div class='team-description' style='background: #2a3a83'>

               Hailing from the coastal city of Galle, this team is known for their strategic approach and balanced squad. The Galle Marvels have a mix of experienced international players and emerging talent, making them an exciting team to watch.



              </div>
              </div>
";

        echo "<video width='600' class='team-video' controls autoplay poster='galle-thumbnail.jpg'>
                    <source src='Galle Kollo .mp4' type='video/mp4'>
                  </video>
                  
              </div>     
                  ";
      }


          }

          echo"<button class='next' onclick='pushSlides(1);'>&#10095;</button>"; 
          
          echo"</div>";
          
          echo"<div class='dots' style='text-align:center'>
          <span class='dot' onclick='currentSlide(0)'></span>
          <span class='dot' onclick='currentSlide(1)'></span>
          <span class='dot' onclick='currentSlide(2)'></span>
          <span class='dot' onclick='currentSlide(3)'></span>
          <span class='dot' onclick='currentSlide(4)'></span>
        </div>";

    echo "</div>";


  }

  

  include "../footer/footer.php";
  ?>













  <script>
    const images = [
      'http://localhost/Cricket-final/team-main-images/7db9d5f8-20cf-4cf7-9535-681f21a70929.jpg',
      'http://localhost/Cricket-final/team-main-images/445e584b-ff38-43be-973e-46a0e7f755ff.jpg',
      'http://localhost/Cricket-final/team-main-images/81146453-b761-489a-a089-94979392b098.png',
      'http://localhost/Cricket-final/team-main-images/ce156bb8-bb1d-49de-b242-4b72908e574b.png',
      'http://localhost/Cricket-final/team-main-images/f9be4234-9a4b-43b4-870c-fec9e23d8c57.jpg'
    ];

    let currentIndex = 0;
    const mainImage = document.querySelector('.main-image');
    const descriptionMainContent = document.querySelector('.description-main-content');
    const imageDescription = document.querySelector('.image-description');

    function changeImage() {
      mainImage.style.animation = 'slideOut 1s forwards';
      imageDescription.style.animation = 'slideOut 1s forwards';


      setTimeout(() => {
        // Update the image source to the next image
        currentIndex = (currentIndex + 1) % images.length;

        mainImage.src = images[currentIndex];

        if (currentIndex === 0) {

          descriptionMainContent.innerHTML = `
      <h1>"Rajapaksa's Unbeaten 105* Powers Galle Marvels to Victory Over Jaffna Kings in LPL Thriller" Give me a small description for this."</h1>
     <br>
      <p>Bhanuka Rajapaksa delivered a spectacular unbeaten 105*, guiding the Galle Marvels to a thrilling victory over the Jaffna Kings in the Lanka Premier League. His powerful innings proved decisive, leading his team to a memorable win in a high-stakes match.</p>
      `

        } else if (currentIndex === 1) {

          descriptionMainContent.innerHTML = `
      <h1>"
Dasun Shanaka Leads Dambulla Thunders to LPL Final with 6-Wicket Win Over B-Love Kandy."</h1>
     <br>
      <p>Dasun Shanaka led Dambulla Thunders to a 6-wicket win over B-Love Kandy in the LPL 2024 semi-final. Their confident chase secured a spot in the finals, setting the stage for an exciting championship match.</p>`

        } else if (currentIndex === 2) {

          descriptionMainContent.innerHTML = `
      <h1>"Jaffna Kings Crowned Champions: Clinch LPL Trophy with 42-Run Triumph Over Dambulla Thunders"</h1>
     <br>
      <p>Jaffna Kings claimed the LPL 2024 title, defeating Dambulla Thunders by 42 runs in a thrilling final. With a stellar all-around performance, the Kings lifted the trophy, showcasing their dominance and capping off an unforgettable season.</p>`;
        } else if (currentIndex === 3) {

          descriptionMainContent.innerHTML = `
      <h1>"Dinesh Chandimal to Lead B-Love Kandy in Next LPL Season"</h1>
     <br>
      <p>B-Love Kandy is set for a fresh start in the upcoming LPL season under the captaincy of Dinesh Chandimal. With Chandimal’s leadership and experience, the team aims to make a strong impact and chase the championship title.</p>
    `;
        } else {

          descriptionMainContent.innerHTML = `      <h1>Binura Fernando's Five-Wicket Haul Guides Colombo Strikers to Victory Over Galle Marvels</h1>
     <br>
      <p>Binura Fernando delivered a sensational performance, taking 5 wickets to dismantle the Galle Marvels' batting lineup. His outstanding spell led the Colombo Strikers to a commanding win, securing them an impressive victory in the latest Lanka Premier League clash.</p>`

        }




        // Reset animation and apply slide-in effect
        mainImage.style.animation = 'none';
        void mainImage.offsetWidth; // Trigger reflow to reset the animation
        mainImage.style.animation = 'slideIn 1s forwards';

        imageDescription.style.animation = 'none';
        void imageDescription.offsetWidth; // Trigger reflow to reset the animation
        imageDescription.style.animation = 'slideIn 1s forwards';

      }, 1000); // Match this with animation duration
    }

    // Change image every 3 seconds
    setInterval(changeImage, 5000);
  </script>

  <script>

 let slideIndex = 0;
 showSlide(slideIndex);



 function pushSlides(n){

  slideIndex+=n;

  showSlide(slideIndex);

  document.getElementsByClassName('team-slide')[slideIndex].classList.add('slide-in-right');
  
 }

 function currentSlide(n){

    showSlide(slideIndex = n);

 }

 function pullSlides(n){

showSlide(slideIndex-=n);

}

 function showSlide(n){

 let i;
 let slides = document.getElementsByClassName('team-slide');
 let dots = document.getElementsByClassName("dot");

 if(n>slides.length-1){slideIndex = 0}
 if(n<0){slideIndex = slides.length-1}

 for(i=0;i<slides.length;i++){
  slides[i].style.display = 'none';
 }

 for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

slides[slideIndex].style.display = 'flex';
dots[slideIndex].className += " active";

 }
  </script>


</body>

</html>