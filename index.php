<?php 
include("inc/quiz.php"); 
echo "<pre>";
var_dump($answers);
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
            <p class="breadcrumbs">Question # of #</p>
            <p class="quiz">What is <?php echo $questions[$index]["leftAdder"] . " + " . $questions[$index]["rightAdder"] ;?> ?</p>
            <form action="index.php" method="post">
                <input type="hidden" name="id" value="<?php echo $index; ?>" />
                <?php foreach($answers as $answer){
                    echo "<input type='submit' class='btn' name='answer' value='" . $answer . "'/>";
                }
                ?>
                <!--<input type="submit" class="btn" name="answer" value="" />
                <input type="submit" class="btn" name="answer" value="" /> -->
            </form>
        </div>
    </div>
</body>
</html>