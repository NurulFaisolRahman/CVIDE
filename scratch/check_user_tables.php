<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SHOW TABLES");
while ($r = mysqli_fetch_row($res)) {
    if (stripos($r[0], 'user') !== false || stripos($r[0], 'admin') !== false) {
        echo $r[0] . "\n";
    }
}
