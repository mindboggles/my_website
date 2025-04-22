<?php

require "../../config.php";

$login_id = $_COOKIE["Login_ID"];

$PDO = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$statement = $PDO->prepare("UPDATE `Users` SET `Login ID` = NULL WHERE `Login ID` = (:login_id)");
$statement->bindParam(":login_id", $login_id);
$statement->execute();