<!-- Sources for register.html.php
  how to use isset: https://www.w3schools.com/php/func_var_isset.asp
-->
<?php
  session_start();
?>
<html>
  <head>
    <link rel="stylesheet" href="../css/logIn.css">
    <?php
      include "../php/userExistsRegistration.php";
      include "../php/writeUserToFileFunction.php";

      if(isset($_POST["uname"]) && isset($_POST["psw"])){
        $filepath = "../json_data/users.json";
        $uname = $_POST["uname"];
        $psw = $_POST["psw"];
        $userExists = userExists($filepath, $uname);
        if(!$userExists){
          $_SESSION["uname"] = $uname;
          writeUserToFile($filepath, $uname, $psw);
        }
      }
      else{
        $userExists = true; //triggers "unsuccessful registration" mode below
      }
    ?>
  </head>
  <body>
    <?php
      if(!$userExists){
        echo "<h1>Welcome, " . $uname . "</h1>";
        echo "<p class='centeredText'>Registration was successful.</p>";
        echo "<p class='centeredText'>Go to the 'gear' icon on your homepage to further customize your account.</p>";
        echo "<form class='centeredForm' action='homepage.html.php' method='post'><button class='homepageButton' type='submit'>Homepage</button></form>";
      }
      else{
        echo "<h1>Unsuccessful Registration</h1>";
        echo "<p class='centeredText'>The username \"" . $uname . "\" already exists.</p>";
        echo "<form class='centeredForm' action='../main.html.php' method='post'><button class='homepageButton' type='submit'>Back</button></form>";
      }
    ?>
  </body>
</html>