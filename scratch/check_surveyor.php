<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$res = $m->query("SELECT * FROM surveyor LIMIT 1");
print_r($res->fetch_assoc());
