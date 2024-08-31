function addQuestion(){
  var question = document.getElementById("question").value;
  document.getElementById("question").value = "";
  var audioPath = document.getElementById("audioPath").value;
  document.getElementById("audioPath").value = "";
  var correctAnswer = document.getElementById("correctAnswer").value;
  document.getElementById("correctAnswer").value = "";
  var decoy1 = document.getElementById("decoyAnswer1").value;
  document.getElementById("decoyAnswer1").value = "";
  var decoy2 = document.getElementById("decoyAnswer2").value;
  document.getElementById("decoyAnswer2").value = "";
  var decoy3 = document.getElementById("decoyAnswer3").value;
  document.getElementById("decoyAnswer3").value = "";
  var answers = JSON.stringify([correctAnswer, decoy1, decoy2, decoy3]);

  // XMLHttpRequest: https://www.w3schools.com/xml/tryit.asp?filename=tryxml_httprequest
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../ajaxRequests/saveNewQuestion.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.onload = function(){
    var newFileData = this.responseText;
    document.getElementById("scrollBox").innerHTML = newFileData;
  }
  // sending POST data in request: https://stackoverflow.com/questions/9713058/send-post-data-using-xmlhttprequest
  xhttp.send("question="+question+"&audioPath="+audioPath+"&answers="+answers);
}

function removeQuestion(){
  hideQConfirmDiv();
  
  var radioButtons = document.getElementsByName("qToRemove");
  var questionNum = 0;
  for(var i=0; i<radioButtons.length; i++){
    if(radioButtons[i].checked){
      questionNum = i;
    }
  }
  // XMLHttpRequest: https://www.w3schools.com/xml/tryit.asp?filename=tryxml_httprequest
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../ajaxRequests/removeQuestion.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.onload = function(){
    var newFileData = this.responseText;
    document.getElementById("scrollBox").innerHTML = newFileData;
  };
  // sending POST data in request: https://stackoverflow.com/questions/9713058/send-post-data-using-xmlhttprequest
  xhttp.send("questionNum="+questionNum);
}

function removeUserFunction(){
  var selectionMenu = document.getElementById("userOptions");
  var userNum = selectionMenu.selectedIndex;
  // XMLHttpRequest: https://www.w3schools.com/xml/tryit.asp?filename=tryxml_httprequest
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../ajaxRequests/removeUser.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.onload = function(){
    var newFileData = this.responseText;
    document.getElementById("removeUserDiv").innerHTML = newFileData;
  };
  // sending POST data in request: https://stackoverflow.com/questions/9713058/send-post-data-using-xmlhttprequest
  xhttp.send("userNum="+userNum);
}

function showQConfirmDiv(){
  document.getElementById("qRemoveConfirmDiv").style.display = "block";
  document.getElementById("removeQButton").style.display = "none";
}

function hideQConfirmDiv(){
  document.getElementById("qRemoveConfirmDiv").style.display = "none";
  document.getElementById("removeQButton").style.display = "block";
}

function showUConfirmDiv(){
  document.getElementById("uRemoveConfirmDiv").style.display = "block";
  document.getElementById("removeUButton").style.display = "none";
}

function hideUConfirmDiv(){
  document.getElementById("uRemoveConfirmDiv").style.display = "none";
  document.getElementById("removeUButton").style.display = "block";
}