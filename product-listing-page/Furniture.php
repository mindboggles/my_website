<?php     

namespace test;
require_once "Product.php";
use PDO;

class Furniture extends Product
{
    private $sku;
    private $name;
    private $price;
    private $type;
    private $height;
    private $width;
    private $length;

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
        $this->height = $arr["Height"];
        $this->width = $arr["Width"];
        $this->length = $arr["Length"];       
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
        echo "Dimensions: " . $this->height . " x " . $this->width . " x " . $this->length . " CM";
    }

    public function insert($pdo) {
        $query = "INSERT INTO Products(SKU, Name, Price, Type, Height, Width, Length)
                    VALUES(:sku, :name, :price, :type, :height, :width, :length);";
        
        $statement = $pdo->prepare($query);

        $statement->bindParam(":sku", $this->sku, PDO::PARAM_STR);
        $statement->bindParam(":name", $this->name, PDO::PARAM_STR);
        $statement->bindParam(":price", $this->price, PDO::PARAM_STR);
        $statement->bindParam(":type", $this->type, PDO::PARAM_STR);
        $statement->bindParam(":height", $this->height, PDO::PARAM_STR);
        $statement->bindParam(":width", $this->width, PDO::PARAM_STR);
        $statement->bindParam(":length", $this->length, PDO::PARAM_STR);

        
        $statement->execute();
    }
}