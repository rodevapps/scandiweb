<?php

require __DIR__ . "/../configs/bootstrap.php";

use Scandiweb\Databases\SqliteDatabase;

$db = new SqliteDatabase();

$db->generate();

?>

