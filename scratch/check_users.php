<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SELECT Username, Password, Level FROM user LIMIT 5");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        print_r($r);
    }
}
