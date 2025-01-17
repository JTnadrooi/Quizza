<?php
    include 'php/functions.php';
    $quizId = $_GET['quizid'];
    $questionsData = getQuestionsData($quizId);
    include 'php/db-connect.php';
    if (! checkLogin()) {
        header('Location: index.php');
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Quizza
    </title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/lib/asitdebug.js"></script>
    <script src="js/main.js"></script>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div id="quiz-container">
        <div id="main-container">
            <div class="subcontainer-quiz">
                <div class="textQuestionTitle"><?php echo $questionsData[0]['question'] ?></div>
            </div>
            <div class="quizTileContainer">
                <button class="answerTile" onClick="answered(0)" id="answerText-0"><?php echo $questionsData[0]['answers'][0] ?></button>
                <button class="answerTile" onClick="answered(1)" id="answerText-1"><?php echo $questionsData[0]['answers'][1] ?></button>
                <button class="answerTile" onClick="answered(2)" id="answerText-2"><?php echo $questionsData[0]['answers'][2] ?></button>
                <button class="answerTile" onClick="answered(3)" id="answerText-3"><?php echo $questionsData[0]['answers'][3] ?></button>
            </div>
        </div>
    </div>
    <div id="bottomIconContainer"></div>
</body>

</html>

<?php 
    echo '<script> let questionsData = ' . json_encode($questionsData) . '</script>';
?>

<script>
    let currentQuestion = 0;

    let currentStats = [
        total = 0,
        correct = 0,
        incorrect = 0
    ]

    function answered(num) {
        if (questionsData[currentQuestion].correctAnswer == questionsData[currentQuestion].answers[num]) {
            currentStats[0]++;
            currentStats[1]++;
            alert("Goed");
        } else {
            currentStats[0]++;
            currentStats[2]++;
            alert("Fout");
        }
        currentQuestion++;

        if (currentQuestion < questionsData.length) {
            document.getElementById("answerText-0").innerHTML = questionsData[currentQuestion].answers[0];
            document.getElementById("answerText-1").innerHTML = questionsData[currentQuestion].answers[1];
            document.getElementById("answerText-2").innerHTML = questionsData[currentQuestion].answers[2];
            document.getElementById("answerText-3").innerHTML = questionsData[currentQuestion].answers[3];
            document.getElementsByClassName("textQuestionTitle")[0].innerHTML = questionsData[currentQuestion].question;
        } else {
            alert("Je hebt alle vragen ingevuld, je hebt " + currentStats[1] + " van de " + currentStats[0] + " vragen goed beantwoord.");
            window.location.href = `index.php`;
        }

    }
</script>