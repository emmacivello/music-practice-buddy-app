<?php
  include "../php/userClass.php";
  include "../php/findUsersMenuString.php";
  $userNum = $_POST["userNum"];
  $filepath = "../json_data/users.json";

  //get data that was in file
  $jsonString = file_get_contents($filepath);
  $users = json_decode($jsonString)->allUsers;
  
  //remove the user
  //use unset and then array_values to re-index array: https://www.geeksforgeeks.org/removing-array-element-and-re-indexing-in-php/
  unset($users[$userNum]);
  $users = array_values($users);

  //create new users object and set its allUsers field to the new list
  $newUsers = new Users();
  $newUsers->allUsers = $users;

  //write the new object to the file
  $usersFile = fopen($filepath, "w");
  $newUsersString = json_encode($newUsers);
  fwrite($usersFile, $newUsersString);
  fclose($usersFile);

  //return an html string (representing a selection menu of updated users) that'll be displayed in the admin page
  echo findUsersMenuString($filepath);
?>