<?php
  include "../php/questionClass.php";
  include "../php/findQuestionsDivString.php";
  $question = $_POST["question"];
  $audioPath = $_POST["audioPath"];
  $answers = json_decode($_POST["answers"]);
  
  $filepath = "../json_data/questions.json";
  
  //get data that was in file
  $jsonString = file_get_contents($filepath);
  $questions = json_decode($jsonString)->allQuestions;

  //create new question and add it to list
  $newQ = new Question();
  $newQ->question = $question;
  $newQ->audioFilePath = $audioPath;
  $newQ->answers = $answers;
  array_push($questions, $newQ);

  //create new questions object and set its allQuestions field to the new list
  $newQuestions = new Questions();
  $newQuestions->allQuestions = $questions;

  //write updated object to file
  $questionsFile = fopen($filepath, "w");
  $newQuestionString = json_encode($newQuestions);
  fwrite($questionsFile, $newQuestionString);
  fclose($questionsFile);

  //return an html string that'll be displayed in the admin page (menu of radio buttons for updated questions)
  echo findQuestionsDivString($filepath);
?>