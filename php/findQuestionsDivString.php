<?php
  function findQuestionsDivString($filepath){
    //return updated file contents to show in div
    $jsonString = file_get_contents($filepath);
    $questions = json_decode($jsonString)->allQuestions;
    $counter = 0;
    $htmlDivContents = "";

    // radio button example: https://www.w3schools.com/tags/tryit.asp?filename=tryhtml5_input_type_radio
    for($i=0; $i<sizeof($questions); $i++){
      $q = $questions[$i];
      if($i==0){
        $htmlDivContents = $htmlDivContents . "<input class='qButton' type='radio' name='qToRemove' oninput='hideQConfirmDiv();' id='question" . $counter. "' checked=true>";
      }
      else{
        $htmlDivContents = $htmlDivContents . "<input class='qButton' type='radio' name='qToRemove' oninput='hideQConfirmDiv();' id='question" . $counter. "'>";
      }
      $labelTemplate = "<label class='qLabel' for='question" . $counter . "'>";
      $labelTemplate = $labelTemplate . $q->question . "<br>";
      $labelTemplate = $labelTemplate . $q->audioFilePath . "<br>";
      for($j=0; $j<sizeof($q->answers); $j++){
        $labelTemplate = $labelTemplate . $q->answers[$j] . "<br>";
      }
      $labelTemplate = $labelTemplate . "</label>";
      if($i != sizeof($questions)-1){
        $labelTemplate = $labelTemplate . "<hr class='hrBlue'>";
      }
      $htmlDivContents = $htmlDivContents . $labelTemplate;
      $counter++;
    }
    return $htmlDivContents;
  }
?>