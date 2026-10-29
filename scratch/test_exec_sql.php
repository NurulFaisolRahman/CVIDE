<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
if ($m->connect_error) {
    die("DB error: " . $m->connect_error . "\n");
}

$sql = file_get_contents(__DIR__ . '/../insert_update_rtkd_foto.sql');
if ($m->multi_query($sql)) {
    do {
        if ($res = $m->store_result()) {
            $res->free();
        }
    } while ($m->more_results() && $m->next_result());
    echo "insert_update_rtkd_foto.sql EXECUTED SUCCESSFULLY WITHOUT ERRORS!\n";
} else {
    echo "SQL execution error: " . $m->error . "\n";
}
