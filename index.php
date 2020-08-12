<?php 
include("inc/quiz.php"); 
// echo "<pre>";
//var_dump($answers);
//echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div <?php if ($show_score === true) {echo 'id="score-box" ';} else {echo 'id="quiz-box" ';} ?>>
        <?php if (!empty($toast)){
            echo "<p>" . $toast . "</p>";
            }
            if ($show_score === false) {
            ?> 
            <p class="breadcrumbs">This is Question <?php echo $countQuestions; ?> of <?php echo $totalQuestions; ?></p>

            <p class="quiz">What is <?php echo $questions[$index]["leftAdder"] . " + " . $questions[$index]["rightAdder"] ;?> ?</p>
            <form action="index.php" method="post">
                <input type="hidden" name="id" value="<?php echo $index; ?>" />
                <!-- display randomized answers - Variant 1 - shorter version: --> 
                <?php   foreach($answers as $answer){
                            echo "<input type='submit' class='btn' name='answer' value='" . $answer . "'/>";
                        } 
                ?>
                <!-- display randomized answers - Variant 2 - suggested in study-guide: -->
                <!-- <input type="submit" class="btn" name="answer" value="<?php // echo $answers[0]; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php // echo $answers[1]; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php // echo $answers[2]; ?>" /> -->
               
                </form>
            <?php
            }



          
        if ($show_score === true) {
               
            echo "<p class='quiz'><span class='game-over'>" . strtoupper($game_over) . "</span></p>"; 
            echo "<p> You got ". $_SESSION['totalCorrect'] . " of " . $totalQuestions . " correct.<br><br></p>";
            
            // got to next quiz:?>
            <p class=''><button type="submit" class="btn next-quiz" name="nextquiz" value="" 
            onClick="document.location.href='index.php'" ><?php  echo strtoupper($next_quiz); ?></button>    </p>
            
        <?php //echo "</p>";   
        } //var_dump($show_score);
        ?>

        </div>
   
        <div class="">
        <?php  
        // ToDo CSS 2 display numbers on (rotated/rotating) cards + shuffle cardnumbers
        // if ($show_score === true) { 
        ?>
          <!--  <p> 
                <div id="card1" class="card_box">1</div>
                <div id="card2" class="card_box">2</div>
                <div id="card3" class="card_box card_box_right">3</div>
                <div id="card4" class="card_box card_box_right">4</div>
            </p> -->
        </div>
        <?php // } ?>
    </div> 

    <!-- Notice: all var_dumps in project are for testing only, during deployment and evaluating process -> staging;
        would be removed completely for production environment --> 
    
    <!-- <div style="top: 50%; position: absolute">
        <table border="1"> 
                <tr><td colspan="2">Check var_dumps: </td></tr>
                <tr><td><?php 
                /*    
                    echo "used indexes in CHRONOLOGICAL order:__ <br>";
                    $arr = ($_SESSION)['used_indexes'];
                    //asort($arr);
                    echo "<pre>";
                        var_dump($arr);
                    echo "</pre>";
                */
                ?></td>
                <td><?php
                /*
                    echo "used indexes in NUMERICAL order:__ <br>";
                    echo "to check that used questions indexes of session array are unique__<br>";
                    $arr = ($_SESSION)['used_indexes'];
                    asort($arr);
                    echo "<pre>";
                        var_dump($arr);
                    echo "</pre>";
                */
                ?></td></tr>
                <tr><td><?php                
                /*  
                    if(isset($_SESSION["questions"])) {
                    echo 'var_dump of ($_SESSION["questions"]: <br>';
                    echo "<pre>";
                    var_dump($_SESSION["questions"] );
                    echo "</pre>"; 
                    } else {
                        echo "Game over --> session-array is unset for next quiz session to create new random session-array";
                    }
                */
                ?></td><td><?php
                /*  
                    echo 'var_dump of ($questions): <br>';
                    echo 'to make sure that array of $question == session-array__<br>';
                    echo "<pre>";
                    var_dump($questions);
                    echo "</pre>"; 
                */
                ?></td></tr>
        </table>
    </div> -->
    
</body>

</html>

<?php
// Check values from global var $_POST after clicking an answer button:
/* 
echo "<pre>";
    echo "Value of \$_POST['answer'] is: ";
    var_dump($_POST["answer"]);
echo "</pre>";
echo "<pre>";
    echo "Value of \$_POST['id'] is: ";
    var_dump($_POST["id"]);
echo "</pre>"; 
*/  

// echo "This is question ". ($countQuestions+1) . " with INDEX " . $index . "<br>";
// echo "Counted " . $_SESSION['totalCorrect'] . " CORRECT answers";

// check array for dublicate numbers:
    /*
$arr = ($_SESSION)['used_indexes'];
//asort($arr);
echo "<pre>";
    var_dump($arr);
echo "</pre>";
*/
?>