<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$res = $m->query("SHOW COLUMNS FROM survei_dinamis");
while ($r = $res->fetch_assoc()) {
  echo $r['Field'] . " (" . $r['Type'] . ")\n";
}
