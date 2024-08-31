<!-- This page is the homescreen for the trivia game - the questions run on triviaQuestionPage.html.php -->

<?php
  session_start();
  $uname = $_SESSION["uname"];
?>

<html>
  <head>
    <link rel="stylesheet" href="../css/trivia.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>

  <body>
    <form action="homepage.html.php">
      <button class="homeButton">Home</button>
    </form>
    <h1>Trivia Game</h1>
    <form action="triviaQuestionPage.html.php">
      <button class="playButton" type="submit">Play</button>
    </form>
    <p class="centeredText">Test your knowledge of classical pieces.</p>
    <h2 class="centeredText">Leaderboard</h2>

    <?php
      include "../php/trivia.php";
      $topScorers = findTopScorers();
      echo findTableString($topScorers);
    ?>

    <script src="../js/avatarDrawing_functions.js"></script>
    <script>
      var avatar0canvases = document.getElementsByClassName("avatar0");
      for(var i=0; i<avatar0canvases.length; i++){
        drawAvatar0(avatar0canvases[i].id);
      }
      var avatar1canvases = document.getElementsByClassName("avatar1");
      for(var i=0; i<avatar1canvases.length; i++){
        drawAvatar1(avatar1canvases[i].id);
      }
      var avatar2canvases = document.getElementsByClassName("avatar2");
      for(var i=0; i<avatar2canvases.length; i++){
        drawAvatar2(avatar2canvases[i].id);
      }
      var avatar3canvases = document.getElementsByClassName("avatar3");
      for(var i=0; i<avatar3canvases.length; i++){
        drawAvatar3(avatar3canvases[i].id);
      }
      var avatar4canvases = document.getElementsByClassName("avatar4");
      for(var i=0; i<avatar4canvases.length; i++){
        drawAvatar4(avatar4canvases[i].id);
      }

    </script>
  </body>
</html>