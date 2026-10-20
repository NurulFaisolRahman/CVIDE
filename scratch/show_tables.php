<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SHOW TABLES");
while ($r = mysqli_fetch_row($res)) {
    echo $r[0] . "\n";
}
