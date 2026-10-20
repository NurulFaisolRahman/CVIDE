<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SELECT Username, Password, Level FROM akun LIMIT 5");
while ($r = mysqli_fetch_assoc($res)) {
    print_r($r);
}
