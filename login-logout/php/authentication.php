<?php

require_once "../../config.php";

$login = $_REQUEST["login"];
$password = $_REQUEST["password"];
$login_id = "";

foreach(str_split($login) as $letter) {
    $login_id = $login_id . $letter . random_int(1000, 9999);
}

$login_time = time();

$PDO = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $PDO->prepare("UPDATE `Users` SET `Login ID` = (:login_id), `Login time` = (:login_time) WHERE `Login` = (:login) AND `Password` = (:password);");
$statement->bindParam(":login_id", $login_id);
$statement->bindParam("login_time", $login_time);
$statement->bindParam(":login", $login);
$statement->bindParam(":password", $password);
$statement->execute();

echo $login_id;