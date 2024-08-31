<?php
  session_start();
  include "../php/findAvatar.php";
  $uname = $_SESSION["uname"];
  $filepath = "../json_data/users.json";
  $avatar = findAvatar($uname, $filepath);
?>

<html>
  <head>
    <link rel="stylesheet" href="../css/userSettingsPage.css">
  </head>
  <body>
    <!-- back button -->
    <form action="homepage.html.php">
      <button type="submit" class="homeButton">Home</button>
    </form>
    <!-- title -->
    <h1>User Settings</h1>
    <div style="margin-left:auto; margin-right:auto; width: 90%; max-width: 600px;">
      <hr>
      <!-- change password feature -->
      <h3>Change Password</h3>
      <label for="newPass">New Password:</label>
      <input id="newPass" type="text" oninput="checkPasswordLength();">
      <button id="changePass" class="confirmChangeButton" onclick="updatePassword()" disabled>Change</button>
      <p class="smallText">A password must be 5+ characters.</p>
      <hr>
      <!-- change avatar feature -->
      <h3>Choose Avatar</h3>
      <p id="origAvatar"></p>
      <p id="avatarName" style="display:inline-block"></p>
      <button class="confirmChangeButton" onclick="updateAvatarFromButton();">Confirm</button>
      <div class="grid-container" oninput="updateAvatarFromRadioButton();">
        <div>
          <input type="radio" id="avatar0" name="avatars" class="invisibleFeature">
          <label for="avatar0"><canvas id="avatar0Canvas" class="avatarsCanvas" width="100" height="100"></canvas></label>
        </div>
        <div>
          <input type="radio" id="avatar1" name="avatars" class="invisibleFeature">
          <label for="avatar1"><canvas id="avatar1Canvas" class="avatarsCanvas" width="100" height="100"></canvas></label> 
        </div>
        <div>
          <input type="radio" id="avatar2" name="avatars" class="invisibleFeature">
          <label for="avatar2"><canvas id="avatar2Canvas" class="avatarsCanvas" width="100" height="100"></canvas></label> 
        </div>
        <div>
          <input type="radio" id="avatar3" name="avatars" class="invisibleFeature">
          <label for="avatar3"><canvas id="avatar3Canvas" class="avatarsCanvas" width="100" height="100"></canvas></label> 
        </div>
        <div>
          <input type="radio" id="avatar4" name="avatars" class="invisibleFeature">
          <label for="avatar4"><canvas id="avatar4Canvas" class="avatarsCanvas" width="100" height="100"></canvas></label> 
        </div>
      </div>
      </div>
    </div>
    
    <script src="../js/userSettings_functions.js"></script>
    <script src="../js/avatarDrawing_functions.js"></script>
    <script>
      var savedAvatarIndex = <?php echo $avatar; ?>; //number 0-4
      var radioButtons = document.getElementsByName("avatars");
      var selectedAvatarIndex = savedAvatarIndex;
      var avatarNames = ["eighth notes", "bass clef", "keyboard", "violin", "treble clef"];   
      initializeAvatarInterface();
    </script>
  </body>
</html>