<?php

session_start();

require_once "../../config.php";
require_once "../classes/Connection.php";
require_once "../classes/Select.php";

$key = $_REQUEST["key"];
$id = $_REQUEST["id"];
$grams = $_REQUEST["grams"];
$calories = $_REQUEST["calories"];
$totalFat = $_REQUEST["totalFat"];
$satFat = $_REQUEST["satFat"];
$netCarbs = $_REQUEST["netCarbs"];
$fiber = $_REQUEST["fiber"];
$protein = $_REQUEST["protein"];

if($key == 0) {
    $key = time();
}

$connection = \My\Connection::create($host, $dbname, $user, $pass);
$name_array = \My\Select::getName($connection, $id);
$name = $name_array["Name"];

$_SESSION["vladsite"]["my-nutrition"][$key] = [$key, $id, $name, $grams, $calories, $totalFat, $satFat, $netCarbs, $fiber, $protein];