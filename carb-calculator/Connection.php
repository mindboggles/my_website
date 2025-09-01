<?php 

class Connection 
{
    public static function create($host, $db, $user, $pass) {
        $dsn = "mysql:host=$host;dbname=$db";
        
        try {
            $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
            return new PDO($dsn, $user, $pass, $options);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }
}

return Connection::create($host, $dbname, $user, $pass);