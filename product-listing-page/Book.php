<?php     

namespace test;
require_once "Product.php";
use PDO;

class Book extends Product
{
    private $sku;
    private $name;
    private $price;
    private $type;
    private $weight;

    public function setSKU($arr) {
        $this->sku = str_replace(' ', '', $arr["SKU"]);
    }

    public function setName($arr) {
        $this->name = $arr["Name"];
    }

    public function setPrice($arr) {
        $this->price = $arr["Price"];
    }

    public function setType($arr) {
        $this->type = $arr["Type"];
    }

    public function setAttributes($arr) {
        $this->weight = $arr["Weight"];          
    }

    public function getSKU() {
        echo $this->sku;
    }

    public function getName() {
        echo $this->name;
    }

    public function getPrice() {
        echo $this->price . " $";
    }
    
    public function getType() {
        echo $this->type;
    }

    public function getAttributes() {
        echo "Weight: " .  $this->weight . " KG";
    }

    public function insert($pdo) {
        $query = "INSERT INTO Products(SKU, Name, Price, Type, Weight)
                    VALUES(:sku, :name, :price, :type, :weight);";
        
        $statement = $pdo->prepare($query);

        $statement->bindParam(":sku", $this->sku, PDO::PARAM_STR);
        $statement->bindParam(":name", $this->name, PDO::PARAM_STR);
        $statement->bindParam(":price", $this->price, PDO::PARAM_STR);
        $statement->bindParam(":type", $this->type, PDO::PARAM_STR);
        $statement->bindParam(":weight", $this->weight, PDO::PARAM_STR);
        
        $statement->execute();
    }
}