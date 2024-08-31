<!-- Sources from metronome.html.php
  Javascript canvas graphics rotation around a point: https://www.javascripttutorial.net/web-apis/javascript-rotate/
  Radio button example: https://www.w3schools.com/tags/tryit.asp?filename=tryhtml5_input_type_radio
  Slider bar: https://www.w3schools.com/howto/howto_js_rangeslider.asp
  Toggle button: https://www.w3schools.com/howto/howto_css_switch.asp
-->

<?php
  session_start();
  $uname = $_SESSION["uname"];
?>

<html>
  <head>
    <link rel="stylesheet" href="../css/metronome.css">
  </head>
  <body>
    <form action="homepage.html.php">
      <button class="homeButton">Home</button>
    </form>
    <h1>Metronome</h1>
    <div class="grid-container">
      <div>
        <div class="leftColumn">
          <h2>Controls</h2>
          <h4>Start & Stop:</h4>
          <label class="switch">
            <input type="checkbox" id="stopAndStartSwitch" oninput="updateMetronome();">
            <span class="switchSlider round"></span>
          </label>
          
          <hr>
          <h4 id="tempoLabel"></h4>
          <input id="tempoSlider" type="range" min="40" max="90" value="65" class="slider" oninput="updateTempoGraphics(); if(!buttonStopped){startMetronome();}">
          <hr>
          <h4>Time Signature:</h4>
          <div oninput="if(!buttonStopped){startMetronome();}">
            <input type="radio" id="none" name="timeSignature" checked>
            <label for="none">None&nbsp;</label><br>
            <input type="radio" id="3" name="timeSignature">
            <label for="3">3/4&nbsp;</label><br>
            <input type="radio" id="4" name="timeSignature">
            <label for="4">4/4&nbsp;</label><br>
            <input type="radio" id="6" name="timeSignature">
            <label for="6">6/8&nbsp;</label><br>
          </div>
          <hr>
          <h4>Animation:</h4>
          <button class="toggleAnimStyleButton" onclick="toggleAnimStyle();">Toggle Style</button>
        </div>
      </div>
      <div>
        <div id="metGraphics1">
          <canvas id="metronomeCanvas" width=500 height=500></canvas>
        </div>
        <div id="metGraphics2" class="hiddenDiv">
          <br><br><br>
          <span id="light" class="dot"></span>
        </div>
      </div>
    </div>
    

    <script src="../js/metronome_functions.js"></script>
    <script>
      var buttonStopped = true; //name comes from the fact that it's updated when the metronome has been started or stopped by the button
      var audio = new window.AudioContext;  // Examples of using javascript's oscillator: https://developer.mozilla.org/en-US/docs/Web/API/OscillatorNode

      var interval; //corresponds with tempo selected by user; represents the setInterval(function(){})
                    //where "function" calls the beep and animation (starting subInterval) at the start of each cycle
      var subInterval; //used for canvas graphics animation with the arm going back and forth; 
                      //represents the setInterval(function(){}) where "function" clears the canvas and redraws the 
                      //metronome with the arm slightly rotated at the start of each cycle
                      //is called subInterval because it happens many times within each interval
      
      updateTempoGraphics();
      drawMetronome(Math.PI - Math.PI/6);
    </script>
  </body>
</html>