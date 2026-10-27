<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$res = $m->query("SHOW TABLES LIKE '%user%'");
while ($r = $res->fetch_array()) echo $r[0] . "\n";
$res = $m->query("SHOW TABLES LIKE '%admin%'");
while ($r = $res->fetch_array()) echo $r[0] . "\n";
$res = $m->query("SHOW TABLES LIKE '%surve%'");
while ($r = $res->fetch_array()) echo $r[0] . "\n";
