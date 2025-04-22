<?php

require_once "../../config.php";
require_once "../classes/Connection.php";
require_once "../classes/Select.php";

$connection = \My\Connection::create($host, $dbname, $user, $pass);
$names = \My\Select::getNames($connection);

echo $names;