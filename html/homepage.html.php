<?php
  session_start();
  $uname = $_SESSION["uname"];
?>

<html>
  <head>
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <form action="../main.html.php">
      <button type="submit" class="logOutButton" id="logOutButton">Log Out</button>
    </form>
    <form action="userSettingsPage.html.php" id="settingsButtonForm" style="display:none">
      <button type="submit" class="fa fa-lg fa-cog settingsButton"></button>
    </form>

    <br><br>
    <h1 id="header">User's Homepage</h1>
    <em id="demoMessage" class="centeredText smallText" style="display:none">(If you sign in with an account, you can customize settings from this page.)</em>
    <br>
    <div class="grid-container4">
      <form action="metronome.html.php" class="centeredForm">
        <button type="submit" class="homepageButton">Metronome</button>
      </form>
      <form action="tuner.html.php"  class="centeredForm">
        <button type="submit" class="homepageButton">Tuner</button>
      </form>
      <form action="trivia.html.php"  class="centeredForm">
        <button type="submit" class="homepageButton">Trivia</button>
      </form>
    </div>
    
    <script>
      var uname = "<?php echo $uname; ?>";
      if(uname.length > 0){
        document.getElementById("header").innerHTML = uname + "'s Homepage";
        document.getElementById("settingsButtonForm").style.display = "block";
      }
      else{
        document.getElementById("header").innerHTML = "Demo Homepage";
        document.getElementById("logOutButton").innerHTML = "Back";
        document.getElementById("demoMessage").style.display = "block";
      }
    </script>
  </body>
</html>