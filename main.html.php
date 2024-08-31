<!--
  Sources used throughout program:
    Sesssion variables with php: https://www.w3schools.com/php/php_sessions.asp (originally, sent value through form without input field: https://stackoverflow.com/questions/6612844/is-there-a-way-of-sending-form-values-without-inputs)
    Writing and reading array to / from a JSON file: Alexandra's code from Moodle

  Sources for main.html.php:
  Accordion code adapted from: https://www.w3schools.com/howto/howto_js_accordion.asp 
    Big Modification: when user opens a new section, the previously-opened section automatically closes
  Slideshow adapted from w3schools: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow
    Big Modification: adding an autoplay feature using .click() and toggling this feature with play / pause buttons
  Play / pause icons added to slideshow from: https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-pause
  Color scheme inspiration is #15 -> #44 from: https://visme.co/blog/website-color-schemes/
    The colors: Gray: #5F6366 / Dark blue: #4D6D9A / Lavender: #86B3D1 / Light blue: #99CED3 / Pink: #EDB5BF
-->

<?php
  session_start();
  $_SESSION["uname"] = ""; //sets (or resets, upon logout) the username
?>

<html>
  <head>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <h1>Emma's Music App</h1>
    
    <div class="grid-container2">
      <!-- column 1 = left menu (sign-in options) -->
      <div>
        <br>
        <button class="accordion">Log In</button>
        <div class="panel">
          <br>
          <form action="html/logIn.html.php" method="post">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required><br>
    
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required><br>
            <br>
            <button type="submit" class="enterButton">Log In</button>
          </form>
        </div>
    
        <button class="accordion">Register</button>
        <div class="panel">
          <form action="html/register.html.php" method="post">
            <p class="smallText">Username and password must be 5+ characters.</p>
            <label for="uname"><b>Username</b></label>
            <!-- oninput for username field is assigned below -->
            <input type="text" placeholder="Enter Username" name="uname" id="registerUname" required><br>
            <label for="psw"><b>Password</b></label>
            <!-- oninput for psw field is assigned below -->
            <input type="password" placeholder="Enter Password" name="psw" id="registerPsw" required><br>
            <br>
            <button type="submit" id="regButton" class="enterButton" disabled>Register</button>
          </form>
        </div>
    
        <button class="accordion">Demo</button>
        <div class="panel">
          <form action="html/homepage.html.php" method="post">
            <p class="smallText">In demo mode, you can experience many features, but these will be unavailable:</p>
            <ul>
              <li class="smallText">trivia score recording</li>
              <li class="smallText">avatar customization</li>
            </ul>
            <button type="submit" class="enterButton">Start Demo</button>
          </form>
        </div>

        <button class="accordion">Admin</button>
        <div class="panel">
          <form action="html/admin.html.php" method="post">
            <p class="smallText">In admin mode, you can add and remove trivia questions and user data.</p>
            <button type="submit" class="enterButton">Admin Mode</button>
          </form>
        </div>
      </div>

      <!-- column 2 = slideshow -->
      <div>
        <div class="slideshow-container">
          <div class="mySlides fade">
            <div class="numbertext">1 / 4</div>
            <button class="playPauseButton fa fa-pause" onclick="togglePlayPause()"></button>
            <img src="images/img1.jpg" style="width:100%">
            <div class="text" style="font-size:2vw">Practice playing in time.</div>
          </div>
          
          <div class="mySlides fade">
            <div class="numbertext">2 / 4</div>
            <button class="playPauseButton fa fa-pause" onclick="togglePlayPause()"></button>
            <img src="images/img2.jpg" style="width:100%">
            <div class="text" style="font-size:2vw">Test your knowledge of classical pieces.</div>
          </div>
          
          <div class="mySlides fade">
            <div class="numbertext">3 / 4</div>
            <button class="playPauseButton fa fa-pause" onclick="togglePlayPause()"></button>
            <img src="images/img3.jpg" style="width:100%">
            <div class="text" style="font-size:2vw">Study hard to make the leaderboard.</div>
          </div>

          <div class="mySlides fade">
            <div class="numbertext">4 / 4</div>
            <button class="playPauseButton fa fa-pause" onclick="togglePlayPause()"></button>
            <img src="images/img4.jpg" style="width:100%">
            <div class="text" style="font-size:2vw">Tune your instrument with the piano interface.</div>
          </div>
          
          <a class="prev" onclick="plusSlides(-1)"><</a>
          <a class="next" onclick="plusSlides(1)" id="nextButton">></a>
        </div>
    
        <div style="text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span> 
          <span class="dot" onclick="currentSlide(4)"></span> 
        </div>
      </div>
    </div>

    <script src="js/main_functions.js"></script>
    <script>
      // set up oninput events
      document.getElementById("registerUname").oninput = function(){testRegInput();};
      document.getElementById("registerPsw").oninput = function(){testRegInput();};

      // set up menu
      activateAccordion();

      // start slideshow
      let slideIndex = 1;
      var autoplay = true;
      showSlides(slideIndex);
      startAutoplay();
    </script>
  </body>
</html>