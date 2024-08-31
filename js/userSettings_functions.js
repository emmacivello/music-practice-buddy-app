function updatePassword(){
  var pass = document.getElementById("newPass").value;
  document.getElementById("newPass").value = "";
  // XMLHttpRequest: https://www.w3schools.com/xml/tryit.asp?filename=tryxml_httprequest
  // Sending POST data in request: https://stackoverflow.com/questions/9713058/send-post-data-using-xmlhttprequest
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../ajaxRequests/updateUsersPassword.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send("psw="+pass);
}

function checkPasswordLength(){
  var length = document.getElementById("newPass").value.length;
  if(length>4){
    document.getElementById("changePass").disabled = false;
  }
  else{
    document.getElementById("changePass").disabled = true;
  }
}

function initializeAvatarInterface(){
  //draw all the avatars
  drawAvatar0("avatar0Canvas");
  drawAvatar1("avatar1Canvas");
  drawAvatar2("avatar2Canvas");
  drawAvatar3("avatar3Canvas");
  drawAvatar4("avatar4Canvas");

  radioButtons[savedAvatarIndex].checked = true; //check the box of the avatar that's saved in the user's file
  document.getElementById("origAvatar").innerHTML = "Your saved avatar is: "+avatarNames[savedAvatarIndex]; //verbally say what the saved avatar is
  document.getElementById("avatarName").innerHTML = "You've selected: "+avatarNames[savedAvatarIndex]; //initially, the chosen avatar is the same as sthe aved avatar
  document.getElementById(radioButtons[savedAvatarIndex].id+"Canvas").classList.add("chosenBorder"); //highlight border of saved avatar
}

function updateAvatarFromRadioButton(){
  //when user clicks radio button, highlights background of chosen avatar and updates text description
  var radioButtons = document.getElementsByName("avatars");
  var canvas;
  for(var i=0; i<radioButtons.length; i++){
    //for next line: html is set up so that "radio button ID" + "Canvas" = canvas's ID
    canvas = document.getElementById(radioButtons[i].id+"Canvas"); 
    if(radioButtons[i].checked){
      selectedAvatarIndex = i;
      canvas.classList.add("chosenBorder"); //highlight border of chosen avatar
      document.getElementById("avatarName").innerHTML = "You've selected: "+avatarNames[i]; //write name of chosen avatar to paragraph
    }
    else{
      canvas.classList.remove("chosenBorder"); //remove border of unchosen avatar (in case it had a border before)
    }
  }
}

function updateAvatarInFile(){
  //writes the user's choice to the user data json file
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../ajaxRequests/updateUsersAvatar.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send("avatar="+savedAvatarIndex);
}

function updateAvatarFromButton(){
  savedAvatarIndex = selectedAvatarIndex; //change the saved index
  updateAvatarInFile(); //save to file
  document.getElementById("origAvatar").innerHTML = "Your saved avatar is: "+avatarNames[savedAvatarIndex]; //update "saved avatar" text box
}