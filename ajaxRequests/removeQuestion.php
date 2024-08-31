<?php
  include "../php/questionClass.php";
  include "../php/findQuestionsDivString.php";
  $questionNum = $_POST["questionNum"];
  $filepath = "../json_data/questions.json";
  
  // get data that was in file
  $jsonString = file_get_contents($filepath);
  $questions = json_decode($jsonString)->allQuestions;

  //remove the question the admin doesn't want
  //use unset and then array_values to re-index array: https://www.geeksforgeeks.org/removing-array-element-and-re-indexing-in-php/
  unset($questions[$questionNum]);
  $questions = array_values($questions);

  //create new question object and set its allQuestions field to the new list of questions
  $newQuestions = new Questions();
  $newQuestions->allQuestions = $questions;

  //write new object to file
  $questionsFile = fopen($filepath, "w");
  $newQuestionString = json_encode($newQuestions);
  fwrite($questionsFile, $newQuestionString);
  fclose($questionsFile);

  //return an html string that'll be displayed in the admin page (menu of radio buttons for updated questions)
  echo findQuestionsDivString($filepath);
?>