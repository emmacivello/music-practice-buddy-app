<?php
  function userExists($filepath, $uname){
    $found = false;
    if(file_exists($filepath)){
      $jsonString = file_get_contents($filepath);
      $users = json_decode($jsonString);
      $nUsers = sizeof($users->allUsers);
      for($i=0; $i<$nUsers; $i++){
        if($users->allUsers[$i]->username == $uname){
          $found = true;
        }
      }
    }
    return $found;
  }
?>