<?php
  function listUsernames($filepath){
    $usernames = [];
    if(file_exists($filepath)){
      $jsonString = file_get_contents($filepath);
      $usersList = json_decode($jsonString)->allUsers;
      for($i=0; $i<sizeof($usersList); $i++){
        array_push($usernames, $usersList[$i]->username);
      }
    }
    return $usernames;
  }
?>