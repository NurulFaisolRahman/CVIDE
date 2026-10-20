<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
mysqli_query($c, "DELETE FROM survei_jawaban WHERE RespondenId IN (145, 146)");
mysqli_query($c, "DELETE FROM survei_responden WHERE Id IN (145, 146)");
echo "Cleaned up test respondents 145 and 146.\n";
