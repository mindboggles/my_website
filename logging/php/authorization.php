<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/config.php";

if(isset($_COOKIE["Login_ID"])) {
    global $host, $dbname, $user, $pass;
    $login_id = $_COOKIE["Login_ID"];

    $PDO = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $statement = $PDO->prepare("SELECT * FROM `Users` WHERE `Login ID` = (:login_id)");
    $statement->bindParam("login_id", $login_id);
    $statement->execute();
    $statement = $statement->fetchAll(PDO::FETCH_ASSOC);

    if(isset($statement[0])) {
        if(time() - $statement[0]["Login time"] > 86400) {
            $update_statement = $PDO->prepare("UPDATE `Users` SET `Login ID` = NULL WHERE `Login ID` = (:login_id);");
            $update_statement->bindParam("login_id", $login_id);
            $update_statement->execute();
        } else {
            $current_time = time();
            $update_statement = $PDO->prepare("UPDATE `Users` SET `Login time` = (:current_time) WHERE `Login ID` = (:login_id);");
            $update_statement->bindParam("current_time", $current_time);
            $update_statement->bindParam("login_id", $login_id);
            $update_statement->execute();

            echo json_encode($statement[0]);
        }
    }
}