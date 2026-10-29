<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$res = $m->query("SELECT Username, Password, Level FROM akun");
$common = ['admin', '123456', '12345', 'password', 'survei', 'Surveiyor', 'super', 'banyuwangi', 'cvide'];
while ($row = $res->fetch_assoc()) {
    foreach ($common as $test) {
        if (password_verify($test, $row['Password'])) {
            echo $row['Username'] . " password is: '$test'\n";
            break;
        }
    }
}
