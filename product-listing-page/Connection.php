<?php

namespace test;
require_once "../config.php";
use PDO;
use PDOException;

class Connection
{
    public static function make($host, $dbname, $user, $pass) {

        $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

        try {
            $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];

            return new PDO($dsn, $user, $pass, $options);
        }

        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

return Connection::make($host, $dbname, $user, $pass);