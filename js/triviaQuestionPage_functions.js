function startGame(){
  var startingElements = document.getElementsByClassName("startingElements"); //hide the intro screen
  for(var i=0; i<startingElements.length; i++){
    startingElements[i].style.display = "none";
  }
  var questionElements = document.getElementsByClassName("triviaGame"); //show the game screen
  for(var i=0; i<questionElements.length; i++){
    questionElements[i].style.display = "block";
  }
  drawHealthBar();
  drawScore();
  showQuestion();
}

function processUserAnswer(answerType, buttonID){
  document.getElementById("finishButton").style.display = "none"; //don't let the user leave the game - else, things aren't processed correctly
  audio.pause();
  if(answerType === "wrong"){
    health--;
  }
  else{
    score++;
  }
  disableQuestionButtons(); //prevent user answering again
  clearInterval(timerBarInterval); //stop the timer (graphics animation)
  clearInterval(questionInterval); //stop the question function from thinking time ran out and calling this function again (with answerType wrong)
  showAnswer(answerType, buttonID); //display what the correct answer was
}

function shuffleArray(array) { //shuffle answers so they're not always in same order (top left not always correct)
  // from: https://stackoverflow.com/questions/2450954/how-to-randomize-shuffle-a-javascript-array
  for (var i = array.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var temp = array[i];
      array[i] = array[j];
      array[j] = temp;
  }
  return array;
}

function showAnswer(answerType, buttonID){
  if(buttonID.length > 0){ //if user chose something (ie time didn't run out)
    document.getElementById(buttonID).style.backgroundColor = "#4D6D9A"; //current button stays the "pushed" color - couldn't get button:active css class to work
    document.getElementById(buttonID).style.border = "10px solid #EDB5BF"; //turn border red no matter what
  }
  document.getElementById("id0").style.border = "10px solid #B3CF99"; //turn correct border green (will override red if user clicked correct answer)
  drawHealthBar(answerType); //update health and score (includes playing animation)
  drawScore(answerType);
  if(health < 0){ //end game if user ran out of health
    setTimeout(finishTriviaGame, pauseLengthMillisec);
  }
  else{ //start next question if user didn't run out of health
    setTimeout(showQuestion, pauseLengthMillisec);
  }
}

function drawHealthBar(answerType){
  var healthBar = "";
  if(health < 0){
    healthBar = "<i class='fas fa-skull'></i>&nbsp;";
  }
  else{
    if(answerType === 'wrong'){ //draw bar with animation class
      var healthLost = maxHealth - health;
      for(var i=0; i<healthLost; i++){
        healthBar += "<i class='fas fa-heart-broken wiggleAnimation' style='opacity:0.5'></i>&nbsp;";
      }
      for(var i=0; i<health; i++){
        //fa fa-heart: https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-heart-o
        healthBar += "<i class='fa fa-heart wiggleAnimation'></i>&nbsp;";
      }
    }
    else{ //draw without animation class
      var healthLost = maxHealth - health;
      for(var i=0; i<healthLost; i++){ //draw broken hearts for each wrong answer
        healthBar += "<i class='fas fa-heart-broken' style='opacity:0.5'></i>&nbsp;";
      }
      for(var i=0; i<health; i++){ //draw full hearts for each chance remaining
        healthBar += "<i class='fa fa-heart'></i>&nbsp;";
      }
    }
  }
  document.getElementById("healthAndScoreBar").innerHTML = healthBar;
}

function drawScore(answerType){
  if(answerType === 'right'){ //draw points with animation
    document.getElementById("healthAndScoreBar").innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;<i class='fas fa-trophy scaleAnimation'></i> <span style='display:inline-block' class='scaleAnimation'>" + score + "</span>";
  }
  else{ //draw points without animation
    document.getElementById("healthAndScoreBar").innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;<i class='fas fa-trophy'></i> " + score;
  }
}

function showQuestion(){
  document.getElementById("finishButton").style.display = "block";
  if(health > -1){
    runTimerBar(qLengthSec); //show timer graphic
    var questionData = getRandomQuestion(triviaData);
    console.log(questionData["answers"][0]); //print correct answer to console for testing
    showQuestionText(questionData["question"]); //show the question text
    playQuestionAudio(questionData["audioFilePath"]); //P = file path
    showQuestionButtons(questionData["answers"]); //show the question buttons
    questionInterval = setTimeout(function(){processUserAnswer('wrong', '');}, (qLengthSec*1000)+1000); //prepare call if user runs out of time
  }
}

function playQuestionAudio(pathToMusicFile){ //sources I used for audio help are listed in triviaQuestionPage.html.php
  audio.src = pathToMusicFile;
  audio.play();
}

function getRandomQuestion(data){
  return data[Math.floor(Math.random()*data.length)];
}

function getRandomDictionaryElement(dictionary){
  //  Find a random value (like a trivia question) from js dictionary: https://bobbyhadz.com/blog/javascript-get-random-property-from-object
  var keys = Object.keys(dictionary);
  var index = Math.floor(Math.random()*keys.length);
  return dictionary[keys[index]];
}

function showQuestionText(questionText){
  document.getElementById("questionText").innerHTML = questionText;
}

function disableQuestionButtons(){
  var qButtons = document.getElementsByClassName("answerButton");
  for(var i=0; i<qButtons.length; i++){
    qButtons[i].disabled = true;
  }
}

function showQuestionButtons(possibleAnswersList){
  //IMPORTANT: assume that the answers are organized so that the first in the list is the correct one
  var qStrings = ['<div><button id=id0 class="answerButton" onclick="processUserAnswer(\'right\', \'id0\')">'+possibleAnswersList[0]+'</button></div>'];
  for(var i=1; i<possibleAnswersList.length; i++){
    qStrings.push('<div><button id=id'+i+' class="answerButton" onclick="processUserAnswer(\'wrong\', \'id'+i+'\')">'+possibleAnswersList[i]+'</button></div>');
  }
  var qStringsScrambled = shuffleArray(qStrings);
  var string = "";
  for(var i=0; i<qStringsScrambled.length; i++){
    string += qStringsScrambled[i];
  }
  document.getElementById("answersSpace").innerHTML = string;
}

function runTimerBar(seconds){
  //adapted from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_progressbar_label_js
  //Big modification to the w3schools code: adding a time parameter to control how quickly the bar changes, making it "count down" / get smaller not larger
  var width = 100; //percent
  var timeIntervalSec = 0.01; //seconds
  var widthIncrement = width / (seconds / timeIntervalSec); //percent

  var elem = document.getElementById("myBar");
  timerBarInterval = setInterval(frame, timeIntervalSec*1000);
  function frame() {
    if (width <= 0) {
      clearInterval(timerBarInterval);
    } else {
      width -= widthIncrement;
      elem.style.width = width + "%";
    }
  }
}

function finishTriviaGame(){
  audio.pause(); //audio.stop isn't working / doesn't exist?
  var gameElements = document.getElementsByClassName("triviaGame"); //hide the question elements
  for(var i=0; i<gameElements.length; i++){
    gameElements[i].style.display = "none";
  }
  document.getElementById("gameOverDiv").style.display = "block";
  document.getElementById("finalScore").innerHTML = "Your score: " + score;
  clearInterval(timerBarInterval);
  clearInterval(questionInterval);
  saveUserScore();
}

function saveUserScore(){
  if(username.length > 0){
    // XMLHttpRequest: https://www.w3schools.com/xml/tryit.asp?filename=tryxml_httprequest
    // Sending POST data in request: https://stackoverflow.com/questions/9713058/send-post-data-using-xmlhttprequest
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../ajaxRequests/saveTriviaScore.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send("score="+score);
    xhttp.onload = function(){
      var prevHighScore = this.response;
      if(prevHighScore < score){
        document.getElementById("scoreMessage").innerHTML = "Your new high score has been saved! (Previous high score: " + prevHighScore + ")";
      }
      else{
        document.getElementById("scoreMessage").innerHTML = "(High Score: "+prevHighScore+")";
      }
    }
  }
  else{
    document.getElementById("scoreMessage").innerHTML = "In demo mode, no scores are saved.";
  }
}