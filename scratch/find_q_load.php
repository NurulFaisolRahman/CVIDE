<?php
$lines = file("application/views/SurveyDashboard.php");
foreach($lines as $num => $l) {
    if (stripos($l, "dashQuestionsContainer") !== false || stripos($l, "loadSurveyQuestions") !== false || stripos($l, "renderSurveyQuestions") !== false) {
        echo ($num+1) . ": " . trim($l) . "\n";
    }
}
