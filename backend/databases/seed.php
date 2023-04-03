<?php

require __DIR__ . "/../configs/bootstrap.php";

use Scandiweb\Databases\MysqlDatabase;

$db = new MysqlDatabase();

$db->generate();

?>

