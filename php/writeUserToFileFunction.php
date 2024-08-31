<?php
  include "userClass.php";
  function writeUserToFile($filepath, $uname, $psw){
    //get data that was in file
    $jsonString = file_get_contents($filepath);
    $prevUsers = json_decode($jsonString)->allUsers;

    //create new user object to represent current user
    $newUser = new User();
    $newUser->username = $uname;
    $newUser->password = $psw;
    $newUser->score = 0;
    $newUser->avatar = 0;

    //add current user to list of the data that was in the file
    array_push($prevUsers, $newUser);

    //create the wrapper object that will go in the file
    $newUsers = new Users();
    $newUsers->allUsers = $prevUsers;

    //write the wrapper to the file
    $usersFile = fopen($filepath, "w");
    $newUsersString = json_encode($newUsers);
    fwrite($usersFile, $newUsersString);
    fclose($usersFile);
  }
?>