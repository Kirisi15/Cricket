<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar with Matches and Rankings</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center; 
        }
        nav {
            display: inline-block; 
            margin: 20px auto; 
            padding: 0;
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
            margin-right: 20px;
        }
        .navbar a {
            color: black;
            text-decoration: none;
            padding: 14px 20px;
            display: block;
        }
        .navbar a:hover {
            text-decoration: underline;
            transition: 0.3s;
        }
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            list-style-type: none;
            display: none; 
            position: absolute;
            min-width: 160px;
            top: 100%;
            z-index: 1;
            padding: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        .dropdown-content li {
            width: 100%;
        }
        .dropdown-content a {
            padding: 12px 16px;
            text-align: center;
            display: block;
        }
        .dropdown-content a:hover {
            text-decoration: underline;
        }
        .dropdown:hover .dropdown-content {
            display: block; 
        }
        .slider {
            width: 1200px; 
            height: 200px;
            overflow: hidden;
            position: relative;
            margin: 20px auto;
            border: 1px solid #ccc;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease;
        }
        .slide {
            min-width: 400px; 
            height: 200px; 
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: lightgray;
            border: 1px solid #ccc;
        }
        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .button {
            margin: 0 5px;
            padding: 10px 15px;
            cursor: pointer;
        }
        .match-group, .rankings-group {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            display: none; 
        }
        .match-group.active {
            display: block; 
        }
        .rankings-group {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            display: block; 
        }

        .topslider {
            display: flex;
            width: 1000px;
            height: 500px;
            overflow: hidden;
            position: relative;
            margin: auto;
            border: 1px solid #ccc;
        }
        .topslides {
            display: flex;
            transition: transform 0.5s ease;
        }
        .topslide {
            display: inline;
            min-width: 1000px; 
            height: 500px; 
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: lightgray;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <nav>
        <ul class="navbar">
            <li><a href="#matches">Matches</a></li>
            <li><a href="#news">News</a></li>
            <li><a href="rankings.php">Rankings</a></li>
            <li class="dropdown">
                <a href="#login">Login</a>
                <ul class="dropdown-content">
                    <li><a href="team-login.php">Team Login</a></li>
                    <li><a href="admin-login.php">Admin Login</a></li>
                    <li><a href="organizer-login.php">Organizer Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="topslider">
        <div class="topslides">
            <div class="topslide">Slide 1</div>
            <div class="topslide">Slide 2</div>
            <div class="topslide">Slide 3</div>
        </div>
    </div>

    <div class="buttons">
        <button class="button" onclick="prevSlideTop()">Previous</button>
        <button class="button" onclick="nextSlideTop()">Next</button>
    </div>

    <div id="matches">
        <h1>Matches</h1>
        <button onclick="showMatches('upcoming')">Upcoming Matches</button>
        <button onclick="showMatches('finished')">Finished Matches</button>

        <div class="match-group active" id="upcoming-matches">
            <h2>Upcoming Matches</h2>
            <?php
            include 'db.php';
            $today = date('Y-m-d');

            $upcomingMatchesSql = "SELECT * FROM matches WHERE date > ? ORDER BY date, time";
            $stmt = $conn->prepare($upcomingMatchesSql);
            $stmt->bind_param("s", $today);
            $stmt->execute();
            $upcomingResult = $stmt->get_result();

            if ($upcomingResult->num_rows > 0) {
                while ($match = $upcomingResult->fetch_assoc()) {
                    echo '<p><strong>' . $match['teamIdA'] . '</strong> vs <strong>' . $match['teamIdB'] . '</strong> on ' . $match['date'] . ' at ' . $match['time'] . ' in ' . $match['venue'] . '</p>';
                }
            } else {
                echo '<p>No upcoming matches.</p>';
            }
            $stmt->close();
            ?>
        </div>

        <div class="match-group" id="finished-matches">
            <h2>Finished Matches</h2>
            <?php
            $finishedMatchesSql = "SELECT * FROM matches WHERE date <= ? ORDER BY date DESC, time DESC";
            $stmtFinished = $conn->prepare($finishedMatchesSql);
            $stmtFinished->bind_param("s", $today);
            $stmtFinished->execute();
            $finishedResult = $stmtFinished->get_result();

            if ($finishedResult->num_rows > 0) {
                while ($match = $finishedResult->fetch_assoc()) {
                    echo '<p><strong>' . $match['teamIdA'] . '</strong> vs <strong>' . $match['teamIdB'] . '</strong> on ' . $match['date'] . ' - Score: ' . $match['scoreTeamA'] . ' - ' . $match['scoreTeamB'] . ' - Winner: ' . $match['winningTeam'] . '</p>';
                }
            } else {
                echo '<p>No finished matches.</p>';
            }
            $stmtFinished->close();
            ?>
        </div>

        <div class="rankings-group">
            <h2>Top 5 Teams</h2>
            <?php
            $rankingsSql = "
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
            LIMIT 5
            ";
            $rankingsResult = mysqli_query($conn, $rankingsSql);

            if (mysqli_num_rows($rankingsResult) > 0) {
                $rank = 1;
                while ($team = mysqli_fetch_assoc($rankingsResult)) {
                    echo '<p>' . $rank . '. ' . $team['teamName'] . ' - Wins: ' . $team['wins'] . '</p>';
                    $rank++;
                }
            } else {
                echo '<p>No rankings available.</p>';
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <div class="slider">
        <div class="slides">
            <div class="slide">Slide 1</div>
            <div class="slide">Slide 2</div>
            <div class="slide">Slide 3</div>
            <div class="slide">Slide 4</div>
            <div class="slide">Slide 5</div>
        </div>
    </div>

    <div class="buttons">
        <button class="button" onclick="prevSlide()">Previous</button>
        <button class="button" onclick="nextSlide()">Next</button>
    </div>

    <script>
        function showMatches(type) {
            const upcomingMatches = document.getElementById('upcoming-matches');
            const finishedMatches = document.getElementById('finished-matches');

            if (type === 'upcoming') {
                upcomingMatches.classList.add('active');
                finishedMatches.classList.remove('active');
            } else {
                finishedMatches.classList.add('active');
                upcomingMatches.classList.remove('active');
            }
        }

        let currentSlide = 0;
        const slidesToShow = 3;

        function showSlide(index) {
            const slides = document.querySelector('.slides');
            const totalSlides = document.querySelectorAll('.slide').length;

            if (index < 0) {
                currentSlide = 0;
            } else if (index > totalSlides - slidesToShow) {
                currentSlide = totalSlides - slidesToShow;
            } else {
                currentSlide = index;
            }

            const offset = -currentSlide * 400;
            slides.style.transform = `translateX(${offset}px)`;
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        showSlide(currentSlide);

        let currentSlidetop = 0;

        function showSlideTop(index) {
            const slides = document.querySelector('.topslides');
            const totalSlides = document.querySelectorAll('.topslide').length;

            if (index < 0) {
                currentSlidetop = totalSlides - 1; 
            } else if (index >= totalSlides) {
                currentSlidetop = 0; 
            } else {
                currentSlidetop = index; 
            }

            const offset = -currentSlidetop * 1000; 
            slides.style.transform = `translateX(${offset}px)`;
        }

        function nextSlideTop() {
            showSlideTop(currentSlidetop + 1);
        }

        function prevSlideTop() {
            showSlideTop(currentSlidetop - 1);
        }

        showSlideTop(currentSlidetop);

        setInterval(nextSlideTop, 3000); 
    </script>
</body>
</html>
