<?php
  include "../php/userClass.php";
  session_start();
  $uname = $_SESSION["uname"];
  $score = $_POST["score"];
  $filepath = "../json_data/users.json";
  $prevHighscore = 0;
  
  //get data that was in file
  $jsonString = file_get_contents($filepath);
  $users = json_decode($jsonString)->allUsers;
  
  //update score of relevant user if it's higher than their saved high score
  $nUsers = sizeof($users);
  for($i=0; $i<$nUsers; $i++){
    if($users[$i]->username == $uname){
      $prevHighscore = intval($users[$i]->score);
      if($score > intval($users[$i]->score)){
        $users[$i]->score = intval($score);
      }
    }
  }

  //create new users object and set its allUsers field to the updated users
  $newUsers = new Users();
  $newUsers->allUsers = $users;

  //write updated users to file
  $usersFile = fopen($filepath, "w");
  $newUsersString = json_encode($newUsers);
  fwrite($usersFile, $newUsersString);
  fclose($usersFile);

  echo $prevHighscore; //return high score to the client
?>