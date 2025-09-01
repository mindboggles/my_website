<?php

require_once "DVD.php";
require_once "Book.php";
require_once "Furniture.php";

$pdo = require_once "Connection.php";

try {
    if (isset($_POST["Save"])) {
        $type = "test\\".$_POST["Type"];

        $product = new $type();

        $product -> setSKU($_POST);
        $product -> setName($_POST);
        $product -> setPrice($_POST);
        $product -> setType($_POST);
        $product -> setAttributes($_POST);

        $product -> insert($pdo);

        header("Location: index.php");
    }
} catch (PDOException $e) {
    die("<h1>Could not save product due to error</h1>" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 0.85">
    <link rel="stylesheet" href="styles.css"/>
    <script src="scripts.js"></script>
    <title>Add Product</title>
</head>
<body>
    <form method="POST" action="<?php ($_SERVER['PHP_SELF'])?>" id="product_form">
        <header>
            <button type="submit" name="Save" id="save" value="Submit" onclick="return checkForm()">Save</button>
            <button formaction="index.php">Cancel</button>
        </header>
        
        <label for="sku">SKU</label>
        <input type="text" name="SKU" id="sku" maxlength="12">
        <br>
        <label for="name">Name</label>
        <input type="text" name="Name" id="name" maxlength="50">
        <br>
        <label for="price">Price</label>
        <input type="number" step="0.01" name="Price" id="price" min="0" max="100000">
        <br>
        <label for="productType">Type:</label>
        <select name="Type" id="productType" onchange="changeInput(this.value)">
            <option></option>
            <option>DVD</option>
            <option>Book</option>
            <option>Furniture</option>
        </select>
        <br>
        <div id="DVD" style="display: none;">
            <label for="size">Size</label>
            <input type="number" step="0.01" name="Size" id="size" min="0" max="100000">
            <br>
            <div class="requirment">*Please, provide size in MB</div>
        </div>
        <div id="Book" style="display: none;">
            <label for="weight">Weight</label>
            <input type="number" step="0.01" name="Weight" id="weight" min="0" max="100000">
            <div class="requirment">*Please, provide weight in KG</div>
        </div>
        <div id="Furniture" style="display: none;">
            <label for="height">Height</label>
            <input type="number" step="0.01" name="Height" id="height" min="0" max="100000">
            <br>
            <label for="width">Width</label>
            <input type="number" step="0.01" name="Width" id="width" min="0" max="100000">
            <br>
            <label for="length">Length</label>
            <input type="number" step="0.01" name="Length" id="length" min="0" max="100000">
            <div class="requirment">*Please, provide dimensions in CM</div>
        </div>
    </form>
</body>
</html>