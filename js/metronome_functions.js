function startMetronome(){  
  var tempo = findTempo();
  var timeSignature = findTimeSignature();
  if(timeSignature !== "none"){
    timeSignature = parseInt(timeSignature);
  }

  // tempo 60 = 60 beats per minute = 1 per second = 1 per 1000 milliseconds
  var intervalTime = Math.floor((60 / tempo) * 1000);
  var i=0;
  
  //don't have multiple animations + sound loops going at once
  clearInterval(interval);
  clearInterval(subInterval);

  // call these functions once outside of setInterval because setInterval waits for a full interval before starting anything; 
  // we don't want the delay
  // also note: the program is always playing both metronome animations (playMetAnimation and playMetAnimation2); 
  // one is hidden from the user with div style when it's not being used - it doesn't stop completely
  if(i%2 == 0){playMetAnimation(0, intervalTime);}//animate arm left->right
  else{playMetAnimation(1, intervalTime);} //animate arm right->left
  if(timeSignature!=="none" && i%timeSignature == 0){//green light and higher-pitched beep to mark the downbeat
    playMetronomeNoise(0);
    playMetAnimation2(0);
  }
  else{ //red light and lower-pitched beep for all other beats
    playMetronomeNoise(1);
    playMetAnimation2(1);
  }
  i++;

  //start the animation and sound cycle
  interval = setInterval(function(){
    if(i%2 == 0){playMetAnimation(0, intervalTime);}
    else{playMetAnimation(1, intervalTime);}
    if(i%timeSignature == 0){
      playMetronomeNoise(0);
      playMetAnimation2(0);
    }
    else{
      playMetronomeNoise(1);
      playMetAnimation2(1);
    }
    i++;
  }, intervalTime);
}

function playMetronomeNoise(noiseMode){
  // Examples of using javascript's oscillator: https://developer.mozilla.org/en-US/docs/Web/API/OscillatorNode
  var oscillator = audio.createOscillator();
  oscillator.type = "triangle";
  if(noiseMode == 0){
    oscillator.frequency.value = "523.25"; //higher pitch for downbeat
  }
  else{
    oscillator.frequency.value = "261.63"; //lower pitch for regular beat
  }
  oscillator.connect(audio.destination);
  oscillator.start();

  setTimeout(function(){oscillator.stop();}, 200); //noise lasts for 200 milliseconds
}

function playMetAnimation2(colorMode){
  if(colorMode == 0){
    document.getElementById("light").classList.add("lightUpAnimationGreen");
    setTimeout(function(){
      document.getElementById("light").classList.remove("lightUpAnimationGreen");
    }, 200) // in the css, the animation lasts for 0.2 seconds / 200 milliseconds - so, I remove it once it finishes playing
  }
  else{
    document.getElementById("light").classList.add("lightUpAnimationRed");
    setTimeout(function(){
      document.getElementById("light").classList.remove("lightUpAnimationRed");
    }, 200) // in the css, the animation lasts for 0.2 seconds / 200 milliseconds - so, I remove it once it finishes playing
  }
}

function playMetAnimation(leftOrRight, intLength){
  clearInterval(subInterval);
  // (Math.PI - Math.PI/6) left-most position
  // (Math.PI + Math.PI/6) right-most position
  var i=0;
  var subFrames = 20;
  var subIntervalFrameLength = (intLength-100) / subFrames; 
  //in the previous line, the -100 is for lag -> I want the subIntervals to finish around the same time the next main 
  //interval starts (and automatically clears the current subIntervals), and I need to make the subIntFrameLen slightly faster/shorter to have it do so
  var startingAngle;
  var subIntervalAngleIncr;
  if(leftOrRight == 0){ //left -> right
    startingAngle = Math.PI - Math.PI/6;
    subIntervalAngleIncr = (Math.PI/3) / 20;
  }
  else{ //right -> left
    startingAngle = Math.PI + Math.PI/6;
    subIntervalAngleIncr = -(Math.PI/3) / 20;
  }
  
  subInterval = setInterval(function(){
    if(i > subFrames){
      clearInterval(subInterval);
    }
    else{
      var canvas = document.getElementById("metronomeCanvas");
      canvas.getContext("2d").clearRect(0,0,canvas.width,canvas.height);
      drawMetronome(startingAngle + i*subIntervalAngleIncr);
      i++;
    }
    
  }, subIntervalFrameLength);
}

function drawMetronome(angleOfRot){ //500x500 canvas
  var canvas = document.getElementById("metronomeCanvas");
  var graphics = canvas.getContext("2d");

  //main trapezoid
  graphics.beginPath();
  graphics.moveTo(100,430);
  graphics.lineTo(400,430);
  graphics.lineTo(300,100);
  graphics.lineTo(200,100);
  graphics.closePath();
  graphics.fillStyle = "#4D6D9A";
  graphics.strokeStyle = "#4D6D9A";
  graphics.stroke();
  graphics.fill();

  //moving hand -> rotates around (250,400)
  graphics.beginPath();
  graphics.translate(250,400);
  graphics.rotate(angleOfRot);
  graphics.moveTo(-10,0);
  graphics.lineTo(-10,200);
  graphics.lineTo(-30,230);
  graphics.lineTo(-10,230);
  graphics.lineTo(-10,350);
  graphics.lineTo(10,350);
  graphics.lineTo(10,230);
  graphics.lineTo(30,230);
  graphics.lineTo(10,200);
  graphics.lineTo(10,0);
  graphics.closePath();
  graphics.strokeStyle = "#EDB5BF";
  graphics.fillStyle = "#EDB5BF";
  graphics.stroke();
  graphics.fill();
  graphics.rotate(-angleOfRot);
  graphics.translate(-250,-400);

  //front piece
  graphics.beginPath();
  graphics.moveTo(100,430);
  graphics.lineTo(400,430);
  graphics.lineTo(373,340);
  graphics.lineTo(127,340);
  graphics.closePath();
  graphics.fillStyle = "#86B3D1";
  graphics.strokeStyle = "#86B3D1";
  graphics.stroke();
  graphics.fill();
}

function stopMetronome(){
  clearInterval(interval);
  clearInterval(subInterval);
}

function findTempo(){
  return parseInt(document.getElementById("tempoSlider").value);
}

function updateTempoGraphics(){
  var tempo = parseInt(document.getElementById("tempoSlider").value);
  document.getElementById("tempoLabel").innerHTML = "Beats per minute: "+tempo;
}

function findTimeSignature(){
  var radioButtons = document.getElementsByName("timeSignature");
  for(var i=0; i<radioButtons.length; i++){
    if(radioButtons[i].checked){
      return radioButtons[i].id;
    }
  }
  return "none";
}

function updateMetronome(){
  var isChecked = document.getElementById("stopAndStartSwitch").checked;
  if(isChecked){
    buttonStopped=false; 
    startMetronome();
  }
  else{
    buttonStopped=true;
    stopMetronome();
  }
}

function toggleAnimStyle(){
  document.getElementById("metGraphics1").classList.toggle("hiddenDiv");
  document.getElementById("metGraphics2").classList.toggle("hiddenDiv");
}