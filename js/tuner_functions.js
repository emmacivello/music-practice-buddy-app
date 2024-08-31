function activatePianoKey(duration, musicNoteFrequency, pianoKeyDivID){
  //Examples of using javascript's oscillator: https://developer.mozilla.org/en-US/docs/Web/API/OscillatorNode
  
  //prepare javascript oscillator to create sound
  var oscillator = audio.createOscillator();
  oscillator.type = findOscillatorType(); 
  oscillator.frequency.value = musicNoteFrequency; //dependant on user's keyboard input
  oscillator.connect(audio.destination);

  oscillator.start(); //start sound
  setColor(pianoKeyDivID, 1); //set key color to "active"
  
  setTimeout(
    function(){
      oscillator.stop(); //stop sound
      setColor(pianoKeyDivID, 0); //set key color to "not active"
      computerKeyData[pianoKeyDivID][1] = false; //set status to "not active"
    }, 
  duration);
}

function findOscillatorType(){ //Finds the user's desired type: sine, triangle, sawtooth, or square
  var radioButtons = document.getElementsByName("oscillatorType");
  for(var i=0; i<radioButtons.length; i++){
    if(radioButtons[i].checked){
      return radioButtons[i].id;
    }
  }
}

function setColor(divID, colorMode){
  //activeKey class has background color information
  if(colorMode == 0){
    document.getElementById(divID).classList.remove("activeKey");
  }
  else if(colorMode == 1){
    document.getElementById(divID).classList.add("activeKey");
  }
}

function assignComputerKeysToPianoKeys(computerKeyData){
  // w3schools page about processing keydown events: https://www.w3schools.com/jsref/event_onkeydown.asp
  // Source about using e.key to get the value of the pressed key: https://www.freecodecamp.org/news/javascript-keycode-list-keypress-event-key-codes/
  //This function is called once at the beginning; it connects keyboard input to sound output
  document.addEventListener('keydown',
    function(e){
      var computerKey = e.key; //the computer key's value can be used as a key in the "computerKeyData" dictionary, and it can also refer to IDs of the piano key divs
      if(computerKeyData[computerKey] != undefined){ //conditional so that computer keys which are not mapped to piano keys don't produce errors
        var duration = 600; //milliseconds
        var musicNoteFrequency = computerKeyData[computerKey][0]; //find the frequency / pitch of the music note the user wants
        if(!computerKeyData[computerKey][1]){ //if the key is currently in the "off" state, activate it 
                                              //(prevents keys from firing rapidly if the user holds the key down - this way, they fire once every duration=600 milliseconds at most)
          computerKeyData[computerKey][1] = true; //set state to active
          activatePianoKey(duration, musicNoteFrequency, computerKey); //play sound and change color
        }
      }          
    });
}