<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
if ($m->connect_error) {
  die("Connect error: " . $m->connect_error);
}

// 1. Delete answers belonging to respondents of SurveiId = 4
$delAnswers = $m->query("DELETE FROM survei_jawaban WHERE RespondenId IN (SELECT Id FROM survei_responden WHERE SurveiId = 4)");
echo "Deleted answers: " . $m->affected_rows . "\n";

// 2. Delete respondents of SurveiId = 4
$delResp = $m->query("DELETE FROM survei_responden WHERE SurveiId = 4");
echo "Deleted respondents: " . $m->affected_rows . "\n";

// 3. Verify counts
$res1 = $m->query("SELECT COUNT(*) as c FROM survei_responden WHERE SurveiId = 4")->fetch_assoc();
$res2 = $m->query("SELECT COUNT(*) as c FROM survei_jawaban WHERE RespondenId IN (SELECT Id FROM survei_responden WHERE SurveiId = 4)")->fetch_assoc();
echo "Remaining respondents for Survei 4: " . $res1['c'] . "\n";
echo "Remaining answers for Survei 4: " . $res2['c'] . "\n";
