<?php
  function findAvatar($uname, $filepath){
    $avatar = 0; //default
    if(file_exists($filepath)){
      $jsonString = file_get_contents($filepath);
      $users = json_decode($jsonString)->allUsers;
      for($i=0; $i<sizeof($users); $i++){
        if($users[$i]->username == $uname){
          $avatar = $users[$i]->avatar;
        }
      }
    }
    return $avatar;
  }
?>