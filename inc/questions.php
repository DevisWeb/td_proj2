<?php
session_start(); // see first note in quiz.php

// create multi-dimensional array with inner arrays for each question (as used before in static version of questions.php):
        /*
            $questions[$i] = [
                "leftAdder" => 3,
                "rightAdder" => 2,
                "correctAnswer" =>  5,
                "firstIncorrectAnswer" => 1,
                "secondIncorrectAnswer" => 8
            ];
        */
// -----------------------------------------------------------------------------------
// inner array (each question) contains 2 summands to be added and 
// 3 answer options (1 correct, 2 incorrect in a range of -10 to +10 from the correct answer)    
        /* structure:    
            $questions[$i]['leftAdder'] = rand(1, ..); 
            $questions[$i]['rightAdder'] = rand(1, ..);
            $questions[$i]['correctAnswer'] = $questions[$i]['leftAdder'] + $questions[$i]['rightAdder'];
            $questions[$i]['firstIncorrectAnswer'] = ..;
            $questions[$i]['secondIncorrectAnswer'] = ..;
        */
// ###################################################################################

    // declare empty questions array to be filled with randomly created questions
    $questions = [];

    // declare range values;
    $rangeIncorrect=10; 
    $minAdder=1;
    $maxAdder=100;
    
    // ###########################################################################
    /*$questions[$i]['leftAdder'] = rand(1, 5);
    $questions[$i]['rightAdder'] = rand(1, 5);
    $questions[$i]['correctAnswer'] = $questions[$i]['leftAdder'] + $questions[$i]['rightAdder'];
    $questions[$i]['firstIncorrectAnswer'] = 2;
    $questions[$i]['secondIncorrectAnswer'] = 2;*/
    
    // declare and calculate values randomly generated for array of 10 questions (avoid dublicates):
    for($i=0; $i < 10; $i++){ 
        // - [x] questions should not repeat within array, also not in reverse order of left and rightAdder 
        // - [x] value 0 should not be an answer option
 
        do {
            $dublicates = false;   
            $leftAdder = rand($minAdder, $maxAdder);
            $rightAdder = rand($minAdder, $maxAdder);
            
            foreach($questions as $question) {
                if((($leftAdder == $question["leftAdder"]) && ($rightAdder == $question["rightAdder"])) 
                    || (($leftAdder == $question["rightAdder"]) 
                        && ($rightAdder == $question["leftAdder"]) 
                        && (($leftAdder+$rightAdder)==$question["correctAnswer"]))) 
                {
                    $dublicates = true;
                    continue;  
                } 
            } 
        } while($dublicates == true); // do while (as long as there are dublicates in question)
        
        $correctAnswer = $leftAdder + $rightAdder;
    
        // ###########################################################################
        // - [x] answer options must be unique within question (2 or 3 equal answers are not allowed)   
        // - [x] answer options must display positive values
        do {      
            $firstIncorrectAnswer = $correctAnswer + rand(-$rangeIncorrect, +$rangeIncorrect);
            $secondIncorrectAnswer = $correctAnswer + rand(-$rangeIncorrect, +$rangeIncorrect);
        } while (($firstIncorrectAnswer == $correctAnswer) 
                || ($secondIncorrectAnswer == $correctAnswer) 
                || ($firstIncorrectAnswer == $secondIncorrectAnswer)
                || ($firstIncorrectAnswer == 0) 
                || ($secondIncorrectAnswer == 0)
        );
        // ###########################################################################

        // add randomly generated questions with its keys and values to $questions array
        // $questions[$i] = [
        $questions[$i] = [
            "leftAdder" => $leftAdder,
            "rightAdder" => $rightAdder,
            "correctAnswer" =>  $correctAnswer,
            "firstIncorrectAnswer" => $firstIncorrectAnswer,
            "secondIncorrectAnswer" => $secondIncorrectAnswer
        ];        
    
    } // end of for-loop
   
// ###################################################################################
    // creates the needed session array with 10 questions for whole session
    // from this session array questions can be compared logical with the used indexes and picked randomly in quiz.php
    // when session ends this session array will be unset in quiz.php 
    // so that a new session array can be generated and filled with new random questions to be used once
    if(!isset($_SESSION["questions"])) {
        $_SESSION["questions"] = array();

        foreach($questions as $question) {
            $_SESSION["questions"][] = $question;
        }    
    } // end of if-statement for creating session array

// ###################################################################################

 
        
    
    

    
    


     
    
    