<?php

session_start();

$key = $_GET["edited-key"];
$id = $_GET["edited-id"];
$name = $_GET["edited-name"];
$grams = $_GET["edited-grams"];
$calories = $_GET["edited-calories"];
$totalFat = $_GET["edited-total-fat"];
$satFat = $_GET["edited-sat-fat"];
$netCarbs = $_GET["edited-net-carbs"];
$fiber = $_GET["edited-fiber"];
$protein = $_GET["edited-protein"];

if($key == 0) {
    $key = time();
}

$_SESSION["vladsite"]["my-nutrition"][$key] = [$key, $id, $name, $grams, $calories, $totalFat, $satFat, $netCarbs, $fiber, $protein];


?>
Saving...