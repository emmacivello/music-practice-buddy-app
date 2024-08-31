<!-- Sources for tuner.html.php
  Examples of using javascript's oscillator: https://developer.mozilla.org/en-US/docs/Web/API/OscillatorNode
  Radio button example: https://www.w3schools.com/tags/tryit.asp?filename=tryhtml5_input_type_radio
-->

<?php
  session_start();
  $uname = $_SESSION["uname"];
?>

<html>
  <head>
    <link rel="stylesheet" href="../css/tuner.css">
  </head>
  <body>
    <form action="homepage.html.php">
      <button class="homeButton">Home</button>
    </form>
    <h1>Tuner</h1>
    <div class="blackKeysGrid">
      <div></div>
      <div id="e" class="bKey e">E</div>
      <div></div>
      <div id="r" class="bKey r">R</div>
      <div></div>
      <div id="y" class="bKey y">Y</div>
      <div></div>
      <div id="u" class="bKey u">U</div>
      <div></div>
      <div id="i" class="bKey i">I</div>
    </div>
    <div class="whiteKeysGrid">
      <div id="s" class="wKey s">S</div>
      <div id="d" class="wKey d">D</div>
      <div id="f" class="wKey f">F</div>
      <div id="g" class="wKey g">G</div>
      <div id="h" class="wKey h">H</div>
      <div id="j" class="wKey j">J</div>
      <div id="k" class="wKey k">K</div>
      <div id="l" class="wKey l">L</div>
    </div>
    <p class="centeredText">Press computer keys to activate the piano keys.</p>
    <br>
    <h3 class="centeredText">Sound Wave Shape</h3>
    <div class="centeredText">
      <input type="radio" id="sawtooth" name="oscillatorType" checked>
      <label for="sawtooth">Sawtooth&nbsp;</label>
      <input type="radio" id="sine" name="oscillatorType">
      <label for="sine">Sine&nbsp;</label>
      <input type="radio" id="square" name="oscillatorType">
      <label for="square">Square&nbsp;</label>
      <input type="radio" id="triangle" name="oscillatorType">
      <label for="triangle">Triangle&nbsp;</label>
    </div>
  
    <script src="../js/tuner_functions.js"></script>
    <script>
      var computerKeyData = { 
        // Table of hertz values corresponding with music notes: https://pages.mtu.edu/~suits/notefreqs.html
        // This dictionary maps computer keys to music note frequencies (in hertz) and to a key state (currently false / off)
        "s":[261.63,false], //s = C4
        'e':[277.18,false], //e = C#4
        'd':[293.66,false], //d = D4
        'r':[311.13,false], //r = D#4
        'f':[329.63,false], //f = E4
        'g':[349.23,false], //g = F4
        'y':[369.99,false], //y = F#4
        'h':[392,false], //h = G4
        'u':[415.30,false], //u = G#4
        'j':[440,false], //j = A4
        'i':[466.16,false], //i = A#4
        'k':[493.88,false], //k = B4
        'l':[523.25,false]//l = C5
      };
      var audio = new window.AudioContext; //create audio context for this user's session
      assignComputerKeysToPianoKeys(computerKeyData); //assign computer keyboard input to sound output (function uses the dictionary computerKeyData)
    </script>
  </body>
</html>