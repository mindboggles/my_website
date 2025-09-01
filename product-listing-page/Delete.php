<?php 

namespace test;
use PDO;

class Delete
{
    public static function row($pdo, $arr) {
        $query = "DELETE FROM Products
                    WHERE sku = :sku";
        
        $statement = $pdo->prepare($query);

        foreach ($arr as $sku) {
            $statement->bindParam(":sku", $sku, PDO::PARAM_STR);
            
            $statement->execute();
        }
    }
}