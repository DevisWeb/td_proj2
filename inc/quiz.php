<?php
// Start the session
session_start();

// Include questions from the questions.php file
include("questions.php");

// Make a variable to hold the total number of questions to ask
$totalQuestions=count($questions);
// Make a variable to hold the toast message and set it to an empty string
$toast = null;
// Make a variable to determine if the score will be shown or not. Set it to false.
$show_score = false;

echo "<pre>"; 
//var_dump($question);
echo "</pre>";

/* nested if-statement: check if server request was “POST”
        if so: check if $_POST[‘answer’] is equal to $questions[$_POST[‘index’]][‘correctAnswer’]
                - [x] assign congrats to $toast
                - [x] ToDo: Increment the session variable that holds the total number correct by one.
        else set $toast a bummer message
*/

if($_SERVER['REQUEST_METHOD'] =='POST'){
    if($_POST['answer'] == $questions[$_POST['id']]['correctAnswer']){
        $toast = "Well done! That’s correct.";
        $_SESSION['totalCorrect']+=1; // ++;
        echo $show_score;
    } else {
        $toast = "Bummer! Try again.";
    }
} 

/*
    Check if a session variable has ever been set/created to hold the indexes of questions already asked.
    If it has NOT: 
        1. Create a session variable to hold used indexes and initialize it to an empty array.
        2. Set the show score variable to false.
*/

if(!isset($_SESSION['used_indexes'])){
    $_SESSION['used_indexes'] = []; // create empty array to hold the indexes of questions already asked
    $_SESSION['totalCorrect']= 0;   // will be incremented when user gets a question correct
    $show_score = false;
} 
// $_SESSION['used_indexes'][] = $index;
// moved:
// array_push($_SESSION['used_indexes'], $index);
// $countQuestions = count($_SESSION['used_indexes']);

// if ten questions asked reset session var "used_indexes" back to empty array
// set $show_score to true to display the score (Game Over)
$countQuestions = count($_SESSION['used_indexes']);

If ($countQuestions == $totalQuestions) {
    $_SESSION['used_indexes'] = [];
    $show_score = true;
    $nextQuiz = "GAME OVER &gt; NextQuiz"; // (ToDo addlink)
} Else {
    // else set $show_score to false
        // if the game is being reset and used_indexes is now equal to 0
                // set the "totalCorrect" to 0
                // set $toast to an empty string
    $show_score = false;
    if (count($_SESSION['used_indexes']) == 0) {
        $_SESSION['totalCorrect']= 0; 
        $toast = "";
        
    }
    // Outside nested if, inside the else, MOVE $index declaration with random number
    // Continue for as long as number generated is found in the session variable that holds used indexes.
    // do while ..
    do {
        $index = rand(0, count($questions) - 1); // array_rand($questions); // 
    } while (in_array($index, $_SESSION['used_indexes']));

    // Move the $question variable assignment just below $index
     $question = $questions[$index];
    // Move array_push of $index below $question variable to push the $index into "used_indexes"
     array_push($_SESSION['used_indexes'], $index);
     $countQuestions = count($_SESSION['used_indexes']);
     $answers = array($question["correctAnswer"],$question["firstIncorrectAnswer"],$question["secondIncorrectAnswer"]);
     shuffle($answers);
    
    // ##################################################################### 

    /*echo "This is question ". ($countQuestions+1) . " with INDEX " . $index . "<br>";
    echo "Counted " . $_SESSION['totalCorrect'] . " CORRECT answers";
    */      
    }      
     // session_destroy(); 

