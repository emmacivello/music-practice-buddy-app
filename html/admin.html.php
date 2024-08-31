<html>
  <head>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../js/admin_functions.js"></script> 
  </head>
  <body>
    <form action="../main.html.php">
      <button type="submit" class="backButton">Back</button>
    </form>
    <h1>Admin Page</h1>
    <div style="margin-left: auto; margin-right: auto; width: 440px;">
      <hr class="hrDotted">
      <h3>Create Trivia Question</h3>
      <div class="grid-container">
        <div><label for="question">Question:</label></div>
        <div><input id="question" type="text" class="textBox"></div>
        <div><label for="audioPath">Audio source path:</label></div>
        <div><input id="audioPath" type="text" class="textBox"></div>
        <div><label for="correctAnswer">Correct answer:</label></div>
        <div><input id="correctAnswer" type="text" class="textBox"></div>
        <div><label for="decoyAnswer1">Decoy answer 1:</label></div>
        <div><input id="decoyAnswer1" type="text" class="textBox"></div>
        <div><label for="decoyAnswer2">Decoy answer 2:</label></div>
        <div><input id="decoyAnswer2" type="text" class="textBox"></div>
        <div><label for="decoyAnswer3">Decoy answer 3:</label></div>
        <div><input id="decoyAnswer3" type="text" class="textBox"></div>
      </div>
      <br>
      <button class="submitButton" onclick="addQuestion();">Submit Question</button>
      <hr class="hrDotted">
      <h3>Remove Trivia Question</h3>

      <div class="scrollBox" id="scrollBox">
        <?php 
          include "../php/findQuestionsDivString.php";
          $filepath = "../json_data/questions.json";
          echo findQuestionsDivString($filepath);
        ?>
      </div>
      
      <div id="removeQButton">
        <br>
        <button class="submitButton" onclick="showQConfirmDiv();">Remove Question</button>
      </div>
      <div id="qRemoveConfirmDiv" style="display:none;">
        <p>Are you sure you want to remove this question?</p>
        <button class="submitButton" onclick="hideQConfirmDiv();">Cancel</button>
        <button class="submitButton" onclick="removeQuestion();">Remove</button>
      </div>
      <hr class="hrDotted">

      <h3>Remove User</h3>
      <div id="removeUserDiv">
        <?php 
          include "../php/findUsersMenuString.php";
          $filepath = "../json_data/questions.json";
          echo findUsersMenuString($filepath);
        ?>
      </div>
      <div id="removeUButton">
        <br>
        <button class="submitButton" onclick="showUConfirmDiv();">Remove User</button>
      </div>
      <div id="uRemoveConfirmDiv" style="display:none;">
        <p>Are you sure you want to remove this user?</p>
        <button class="submitButton" onclick="hideUConfirmDiv();">Cancel</button>
        <button class="submitButton" onclick="removeUserFunction();">Remove</button>
      </div>
    </div>   
  </body>
</html>