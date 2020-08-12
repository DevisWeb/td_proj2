<?php
/*  session_start(); --> moved to questions.php to create SESSION array with questions available for whole session, 
    means without changing array values during session; 
    this is important to ensure that comparing used indexes to this session array + shuffle still make sense
    and questions are unique so that questions and answers still can be randomized/shuffled without retrieving dublicate questions 
*/ 
// Include questions from questions.php file
include("questions.php");
// ensure that array of $questions doesn# t change during session --> assign session-array:
$questions = $_SESSION['questions'];
// hold the total number of questions to ask
$totalQuestions=count($questions);
// hold toast message and set it to an empty string
$toast = null;
// determine if score will be shown or not. Set to false for starting quiz
$show_score = false;

// Important: Check if server request was “POST”
// if selected answer == correct answer in provided question-bank / array of generated questions
// --> Display appropriate toast 
// --> if answer correct: increment session variable (total number correct) by one.
if($_SERVER['REQUEST_METHOD'] =='POST'){
    if($_POST['answer'] == $questions[$_POST['id']]['correctAnswer']){
        $toast = "Well done! That’s correct.";
        $_SESSION['totalCorrect']+=1; // ++;
        echo $show_score;
    } else {
        $toast = "Bummer! The answer was not correct.";
    }
} 

// Check if session variable has ever been set/created for used indexes of questions asked
// If not: Create session variable for used indexes, set to empty array.
// Set $show_score variable to false (and true when used indexes == nr of total questions available)
if(!isset($_SESSION['used_indexes'])){
    $_SESSION['used_indexes'] = []; // create empty array to hold the indexes of questions already asked
    $_SESSION['totalCorrect']= 0;   // is incremented when user gets a question correct
    $show_score = false;
} 

// if ten questions asked reset session var "used_indexes" back to empty array
// set $show_score to true to display the score (Game Over)
// unset questions-session-array for creating new random session array with next session starting
$countQuestions = count($_SESSION['used_indexes']);

If ($countQuestions == $totalQuestions) {
    $_SESSION['used_indexes'] = [];
    unset($_SESSION['questions']);
    $show_score = true;
    $game_over = "game over"; 
    $next_quiz= "next quiz";  // "&gt; next quiz"; 
} Else {
    // else $show_score = false (quiz is starting/running)
        // if game is being reset and used_indexes is now equal to 0
                // reset values: "totalCorrect" to 0
                // set $toast to an empty string
    $show_score = false;
    if (count($_SESSION['used_indexes']) == 0) {
        $_SESSION['totalCorrect']= 0; 
        $toast = "";
        
    }
    // create random number
    // as long as number generated is found in session variable with used indexes
    // to make sure that questions from array are not asked more than once
    do {
        $index = rand(0, count($questions) - 1); // array_rand($questions); 
    } while (in_array($index, $_SESSION['used_indexes']));

    // pick questions from random index of session_array:
     $question = $questions[$index];
    // push $index into "used_indexes"
     array_push($_SESSION['used_indexes'], $index); // $_SESSION['used_indexes'][] = $index;
     // count used indexes --> counts questions asked/answered during quiz:
     $countQuestions = count($_SESSION['used_indexes']);
     // create array to shuffle answers (retrieve answers from randomly picked $question)
     $answers = array($question["correctAnswer"],$question["firstIncorrectAnswer"],$question["secondIncorrectAnswer"]);
     shuffle($answers);
    }      
// session_destroy(); 
?>


