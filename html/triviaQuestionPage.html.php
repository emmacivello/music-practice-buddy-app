<!-- Sources for triviaQuestionPage.html.php
  Sounds:
    Fur Elise: https://en.wikipedia.org/wiki/File:FurElise.ogg
    Flight of the Bumblebee: https://en.wikipedia.org/wiki/File:Rimsky-Korsakov_-_flight_of_the_bumblebee.oga
    Paganini caprice 24: https://en.wikipedia.org/wiki/File:Paganini_Caprice-24.ogg
    New world symphony mvt4: https://en.wikipedia.org/wiki/File:Antonin_Dvorak_-_symphony_no._9_in_e_minor_%27from_the_new_world%27,_op._95_-_iv._allegro_con_fuoco.ogg
    Beethoven 5: https://en.wikipedia.org/wiki/File:Beet5mov1bars1to5.ogg
    Swan Lake opening: https://en.wikipedia.org/wiki/File:Peter_Ilyich_Tchaikovsky-_Swan_Lake-_Extract_from_Act_1.ogg
    Vivaldi Spring: https://en.wikipedia.org/wiki/File:Vivaldi_-_Four_Seasons_1_Spring_mvt_1_Allegro_-_John_Harrison_violin.oga
    Ride of the Valkyries: https://en.wikipedia.org/wiki/File:Ride_of_the_Valkyries.ogg
    Elgar cello concerto: https://en.wikipedia.org/wiki/Cello_Concerto_(Elgar)
    Mendelssohn violin concerto: https://en.wikipedia.org/wiki/File:Felix_Mendelssohn_-_Violinkonzert_e-moll_-_1._Allegro_molto_appassionato.ogg
    Moonlight sonata: https://en.wikipedia.org/wiki/Piano_Sonata_No._14_(Beethoven) 

  How to play mp3 files:
    W3schools explanation of playing mp3 audio file: https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_audio_play
    Playing a sound clip: https://stackoverflow.com/questions/9419263/how-to-play-audio
    Why audio didn't work (autoplay blocked - but clicking button to play is allowed): https://developer.mozilla.org/en-US/docs/Web/Media/Autoplay_guide
    Play audio file starting from certain time: https://stackoverflow.com/questions/12029509/html-5-audio-play-file-at-certain-time-point  
-->
<?php
  session_start();
  $uname = $_SESSION["uname"];
?>

<html>
  <head>
    <link rel="stylesheet" href="../css/triviaQuestionPage.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  </head>
  <body>
    <form action="trivia.html.php" class="startingElements">
      <button class="finishButton" type="submit">Back</button>
    </form>
    <button id="finishButton" class="triviaGame finishButton" style="display:none" onclick="finishTriviaGame()">Save & Exit</button>
    
    <h1>Trivia Game</h1>

    <!-- start -->
    <div class="startingElements">
      <button id="playButton" class="playButton">Start Questions</button> <!-- NOTE: onclick event is assigned below -->
      <div>
        <h4 class="centeredText">Instructions</h4>
        <ul class="centeredList">
          <li>Questions ask you to recognize pieces of music</li>
          <li>Turn on computer volume</li>
          <li>15 seconds per question</li>
          <li>5 lives (game ends at 6th wrong answer)</li>
        </ul>
      </div>
    </div>

    <!-- questions -->
    <div class="triviaGame" style="display:none;">
      <div id="myProgress">
        <div id="myBar"></div>
      </div>
      <p id="healthAndScoreBar"></p>
      <div id="questionText"></div>
      <br><br>
      <div class="grid-container" id="answersSpace"></div>
    </div>

    <!-- game over -->
    <div id="gameOverDiv" class="centeredText" style="display:none;">
      <p id="finalScore"></p>
      <em id="scoreMessage" class="centeredText smallText"></em><br><br>
      <form action="triviaQuestionPage.html.php">
        <button class="triviaEndButton" type="submit">Play Again</button>
      </form>
      <form action="trivia.html.php">
        <button class="triviaEndButton" type="submit">Back</button>
      </form>
    </div>

    <?php
      $filepath = "../json_data/questions.json";
      $jsonString = file_get_contents($filepath);
      $questionsObject = json_decode($jsonString);
      $questionsArray = $questionsObject->allQuestions;
    ?>

    <script src="../js/triviaQuestionPage_functions.js"></script>
    <script>
      var username = "<?php echo $uname; ?>";
      var timerBarInterval; //refers to setInterval
      var questionInterval; //refers to setInterval
      var qLengthSec = 7; //time user has to answer
      var qLengthMillisec = qLengthSec * 1000;
      var pauseLengthSec = 2; //length of pause between questions
      var pauseLengthMillisec = pauseLengthSec * 1000;
      var maxHealth = 5;
      var health = maxHealth;
      var score = 0;
      var audio = new Audio();
      var triviaData = <?php echo json_encode($questionsArray); ?>;
      
      // The "playButton" element comes before divs referenced in startGame(), but the function needs to come after these divs are defined
      // I was having an issue with startGame() being unrecognized, and I believe this was the problem ^
      // (When I removed references to the divs in startGame(), it worked)
      document.getElementById("playButton").onclick = function(){startGame()};
    </script>
  </body>
</html>