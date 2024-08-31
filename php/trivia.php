<?php
  function findTopScorers(){
    $filepath = "../json_data/users.json";
    if(file_exists($filepath)){
      $jsonString = file_get_contents($filepath);
      $users = json_decode($jsonString)->allUsers;
      usort($users, "cmp");
      $numUsers = count($users);
      $usersSlice = array_slice($users, 0, 10);
      return $usersSlice;
    }
    return $users;
  }

  function cmp($a, $b) { //sorts most to least
    //How to sort php list of objects (users) by a field (trivia score): https://stackoverflow.com/questions/4282413/sort-array-of-objects-by-one-property
    if (intval($a->score) < intval($b->score)){
      return 1;
    }
    else if (intval($a->score) > intval($b->score)){
      return -1;
    }
    else{
      return 0;
    }
    // return (intval($a->score) < intval($b->score));
  }

  function findTableString($topScorers){ //assemble leaderboard
    $tableString = "<table><th>Place</th><th>Avatar & Username</th><th>Score</th>";
    $nScorers = count($topScorers);
    for($i=0; $i<$nScorers; $i++){
      if($i==0){
        $tableString = $tableString . "<tr><td>" . ($i+1) . " <i class='fas fa-crown'></i></td><td><canvas id=" . $topScorers[$i]->username . " width='100' height='100' class='avatarsCanvas avatar" . $topScorers[$i]->avatar . "'></canvas>" . $topScorers[$i]->username . "</td><td>" . $topScorers[$i]->score . "</td></tr>";
      }
      else{
        $tableString = $tableString . "<tr><td>" . ($i+1) . "</td><td><canvas id=" . $topScorers[$i]->username . " width='100' height='100' class='avatarsCanvas avatar" . $topScorers[$i]->avatar . "'></canvas>" . $topScorers[$i]->username . "</td><td>" . $topScorers[$i]->score . "</td></tr>";
      }
    }
    $tableString = $tableString . "</table>";
    return $tableString;
  }
?>
