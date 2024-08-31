<!-- Sources for logIn.html.php
  using isset: https://www.w3schools.com/php/func_var_isset.asp
-->
<?php
  session_start();
?>
<html>
  <head>
    <link rel="stylesheet" href="../css/logIn.css">
    <?php
      include "../php/userExistsLogIn.php";

      if(isset($_POST["uname"]) && isset($_POST["psw"])){
        $uname = $_POST["uname"];
        $psw = $_POST["psw"];
        $logInSuccessful = userExists("../json_data/users.json", $uname, $psw);
        if($logInSuccessful){
          $_SESSION["uname"] = $uname;
        }
      }
      else{
        $logInSuccessful = false; //trigger "unsuccessful login" mode below
      }
    ?>
  </head>
  <body>
    <?php
      if($logInSuccessful){
        echo "<h1>Welcome, " . $uname . "</h1>";
        echo "<p class='centeredText'>Login was successful.</p>";
        echo "<form class='centeredForm' action='homepage.html.php' method='post'><button class='homepageButton' type='submit'>Homepage</button></form>";
      }
      else{
        echo "<h1>Unsuccessful Login</h1>";
        echo "<p class='centeredText'>Username or password was incorrect</p>";
        echo "<form class='centeredForm' action='../main.html.php' method='post'><button class='homepageButton' type='submit'>Back</button></form>";
      }
    ?>
  </body>
</html>