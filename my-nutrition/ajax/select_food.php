<?php

require_once "../../config.php";
require_once "../classes/Connection.php";
require_once "../classes/Select.php";

$connection = \My\Connection::create($host, $dbname, $user, $pass);
$food = \My\Select::getFood($connection, $_REQUEST["id"]);

echo $food;