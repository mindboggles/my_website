<?php

require_once "Select.php";
require_once "Delete.php";
require_once "DVD.php";
require_once "Book.php";
require_once "Furniture.php";

$pdo = require_once "Connection.php";

if (isset($_POST["mass-delete"])) {
    if (!empty($_POST["delete"])) {
        test\Delete::row($pdo, $_POST["delete"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.85">
    <link rel="stylesheet" href="styles.css">
    <title>Product List</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>
<body>
    <form method="POST">
        <header>
            <button formaction="add-product.php">ADD</button>
            <button formaction="index.php" name="mass-delete">MASS DELETE</button>
        </header>

        <?php foreach(test\Select::allRows($pdo) as $row): 
                $type = "test\\".$row["Type"];
                $product = new $type();

                $product->setSKU($row);
                $product->setName($row);
                $product->setPrice($row);
                $product->setType($row);
                $product->setAttributes($row);
            ?>

            <div class="product">
                <input type="checkbox" name="delete[]" class="delete-checkbox" value=<?php $product->getSKU();?>>
                <div class="info"><?php $product->getSKU();?></div>
                <div class="info"><?php $product->getName();?></div>
                <div class="info"><?php $product->getPrice();?></div>
                <div class="info"><?php $product->getAttributes();?></div>
            </div>
        <?php endforeach ?>
    </form>
</body>
</html>