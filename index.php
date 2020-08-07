<?php 
include("inc/quiz.php"); 
echo "<pre>";
//var_dump($answers);

echo "</pre>";

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
        <div id="quiz-box">
        <?php 
        if (!empty($toast)){
            echo "<p>" . $toast . "</p>";
        }
      
        ?>
            <p class="breadcrumbs">Question #<?php //echo $countQuestions; ?> of <?php echo $totalQuestions; ?></p>
            <p class="quiz">What is <?php echo $questions[$index]["leftAdder"] . " + " . $questions[$index]["rightAdder"] ;?> ?</p>
            <form action="index.php" method="post">
                <input type="hidden" name="id" value="<?php echo $index; ?>" />
                <!-- display randomized answers - Variant 1: --> 
                <?php 
                foreach($answers as $answer){
                   echo "<input type='submit' class='btn' name='answer' value='" . $answer . "'/>";
                }
                ?>
                <!-- display randomized answers - Variant 2 - suggested in study-guide: -->
                <!-- <input type="submit" class="btn" name="answer" value="<?php echo $answers[0]; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $answers[1]; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $answers[2]; ?>" /> -->
               
            </form>
            
        </div>
    </div>
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
?>