<?php
  include "../php/userClass.php";
  session_start();
  $uname = $_SESSION["uname"];
  $avatar = $_POST["avatar"];
  $filepath = "../json_data/users.json";
  
  //get data that was in file
  $jsonString = file_get_contents($filepath);
  $users = json_decode($jsonString)->allUsers;
  
  //update avatar for user $uname
  $nUsers = sizeof($users);
  for($i=0; $i<$nUsers; $i++){
    if($users[$i]->username == $uname){
      $users[$i]->avatar = intval($avatar);
    }
  }

  //create new users object
  $newUsers = new Users();
  $newUsers->allUsers = $users;

  //write updated users to file
  $usersFile = fopen($filepath, "w");
  $newUsersString = json_encode($newUsers);
  fwrite($usersFile, $newUsersString);
  fclose($usersFile);
?>