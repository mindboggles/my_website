<?php

namespace test;
use PDO;

class Select
{
    public static function allRows($pdo) {   
        $query = "SELECT * FROM Products";

        $statement = $pdo->query($query);
        
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }
}