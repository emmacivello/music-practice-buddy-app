<?php
// return html string to display
  include "listUsernames.php";
  
  function findUsersMenuString($filepath){
    $users = listUsernames("../json_data/users.json");
    $i = 0;

    $htmlUsersString = "<select id='userOptions' oninput='hideUConfirmDiv();'>";
    for($i=0; $i<sizeof($users); $i++){
      $htmlUsersString = $htmlUsersString . "<option>" . $users[$i] . "</option>";
    }
    $htmlUsersString = $htmlUsersString . "</select>";
    return $htmlUsersString;
  }
?>