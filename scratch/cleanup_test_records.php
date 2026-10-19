<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$m->query('DELETE FROM survei_jawaban WHERE RespondenId IN (135,136,137,138)');
$m->query('DELETE FROM survei_responden WHERE Id IN (135,136,137,138)');
echo "Cleaned test respondents successfully.\n";
