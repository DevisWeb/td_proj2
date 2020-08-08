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
// Make a variable to hold a random index. Assign null to it.
$index = array_rand($questions); // rand(0, count($questions) - 1);
// Make a variable to hold the current question. Assign null to it.
$question = $questions[$index];
echo "<pre>"; 
//var_dump($question);
echo "</pre>";

$answers = array($question["correctAnswer"],$question["firstIncorrectAnswer"],$question["secondIncorrectAnswer"]);
shuffle($answers);

/* nested if-statement:
        check if server request was “POST”
        if so:
            check if $_POST[‘answer’] is equal to $questions[$_POST[‘index’]][‘correctAnswer’]
                - [x] assign congrats to $toast
                - [] ToDo: Ancrement the session variable that holds the total number correct by one.
            else
                - set $toast a bummer message
*/

if($_SERVER['REQUEST_METHOD'] =='POST'){
    if($_POST['answer'] == $questions[$_POST['id']]['correctAnswer']){
        $toast = "Well done! That’s correct.";
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
    $_SESSION['used_indexes'] = [];
    $show_score = false;
} 
// $_SESSION['used_indexes'][] = $index;
array_push($_SESSION['used_indexes'], $index);
$countQuestions = count($_SESSION['used_indexes']);
echo "This is question $countQuestions with INDEX " . $index;


/*
  If the number of used indexes in our session variable is equal to the total number of questions
  to be asked:
        1.  Reset the session variable for used indexes to an empty array 
        2.  Set the show score variable to true.

  Else:
    1. Set the show score variable to false 
    2. If it's the first question of the round:
        a. Set a session variable that holds the total correct to 0. 
        b. Set the toast variable to an empty string.
        c. Assign a random number to a variable to hold an index. Continue doing this
            for as long as the number generated is found in the session variable that holds used indexes.
        d. Add the random number generated to the used indexes session variable.      
        e. Set the individual question variable to be a question from the questions array and use the index
            stored in the variable in step c as the index.
        f. Create a variable to hold the number of items in the session variable that holds used indexes
        g. Create a new variable that holds an array. The array should contain the correctAnswer,
            firstIncorrectAnswer, and secondIncorrect answer from the variable in step e.
        h. Shuffle the array from step g.
*/
