<?php

session_start([ 
    'cookie_path' => '/carb-calculator',
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
]);

require_once "../config.php";
$Food = require_once "Food.php";
$pdoConnection = require_once "Connection.php";

$Food->setPdoConnection($pdoConnection);
$foods = $Food->getAllFoodNames();

$totalCarbs = 0;
$totalCalories = 0;

if(!isset($_SESSION["vladsite"]["carb-calculator"])) {
    $_SESSION["vladsite"]["carb-calculator"] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST["FoodAdder"])) {
        $selectedFoodName = $_POST['FoodAdder'];

        $Food->setName($selectedFoodName);
        $Food->setGrams();
        $Food->setCalories();
        $Food->setCarbohydrates();

        $_SESSION["vladsite"]["carb-calculator"][$selectedFoodName] = [$Food->getName(), $Food->getGrams(), $Food->getCarbohydrates(), $Food->getCalories()];
    }

    else if(isset($_POST["SessionUnsetter"])) {
        $_SESSION["vladsite"]["carb-calculator"] = [];
        header("Refresh:0");
    }
    
    else if(isset($_POST["SessionSaver"])) {
        foreach($foods as $food) {
            foreach($_POST as $post) {
                if(isset($_POST["$food" . "_grams"])) {
                    $_SESSION["vladsite"]["carb-calculator"][$food][1] = $_POST["$food" . "_grams"];
                }

                if(isset($_POST["$food" . "_carbs"])) {
                    $_SESSION["vladsite"]["carb-calculator"][$food][2] = $_POST["$food" . "_carbs"];
                }

                if(isset($_POST["$food" . "_calories"])) {
                    $_SESSION["vladsite"]["carb-calculator"][$food][3] = $_POST["$food" . "_calories"];
                }
            }
        }
    }
}

foreach($_SESSION["vladsite"]["carb-calculator"] as $food) {
    $totalCarbs += $food[2];
    $totalCalories += $food[3];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogļhidrātu kalkulators</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>
<body style="margin: 10px;">
    <!-- ALL FOODS LIST -->
    <form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
        <ul style="position: absolute; list-style-type: none; margin: 0px; padding: 0px; width: 100px;">
            <?php foreach($foods as $food):?>
                <li><button name="FoodAdder" style="background-color: white; border: 1px solid gray; border-radius: 5px; padding: 5px; margin: 1px;" value="<?php echo $food ?>"><?php echo $food ?></button></li>
            <?php endforeach ?>
        </ul>
    </form>

    <form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
        <!-- SELECTED FOODS TABLE -->
        <table style="border: 1px solid gray; position: absolute; left: 120px; width: 400px; text-align: center; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid gray;">
                    <td>Produkts</td>
                    <th>Grami</th>
                    <th style="background-color: rgb(225, 225, 225)">Ogļhidrāti</th>
                    <td>Kalorijas</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($_SESSION["vladsite"]["carb-calculator"] as $foodInfo): ?>
                    <?php if (!empty($foodInfo)): $name = $foodInfo[0]; $grams = $foodInfo[1]; $carbs = $foodInfo[2]; $calories = $foodInfo[3]; ?> 
                        <tr>
                            <th>
                                <input readonly style="width: 60px;" value="<?php echo $name ?>">
                            </th>



                            <td>
                                <input type="number" step="any" style="width: 60px;" id="<?php echo $name . "_grams" ?>" name="<?php echo $name . "_grams" ?>" value="<?php echo $grams ?>" onchange="<?php echo $name . "_changeGrams(this.value)" ?>">
                            </td>



                            <td style="background-color: rgb(225, 225, 225);">
                                <input type="number" step="any" style="width: 60px" id="<?php echo $name . '_carbs'?>" name="<?php echo $name . '_carbs'?>" value="<?php echo $carbs ?>" onchange="<?php echo $name . "_changeCarbs(this.value)" ?>">
                            </td>



                            <td>
                                <input type="number" readonly style="width: 60px;" id="<?php echo $name . '_calories'?>" name="<?php echo $name . '_calories'?>"  value="<?php echo $calories ?>">
                            </td>
                        </tr>

                        <script>
                            function <?php echo $name . "_changeGrams(gramsParameter)" ?> {
                                const name = "<?php echo $name ?>";
                                const grams = <?php echo $grams ?>;
                                const carbs = <?php echo $carbs ?>;
                                const calories = <?php echo $calories ?>;

                                document.getElementById(name + "_carbs").value = (carbs / grams * gramsParameter).toFixed(2);
                                document.getElementById(name + "_calories").value = (calories / grams * gramsParameter).toFixed(2);
                            }

                            function <?php echo $name . "_changeCarbs(carbsParameter)" ?> {
                                const name = "<?php echo $name ?>";
                                const grams = <?php echo $grams ?>;
                                const carbs = <?php echo $carbs ?>;
                                const calories = <?php echo $calories ?>;

                                document.getElementById(name + "_grams").value = (grams / carbs * carbsParameter).toFixed(2);
                                document.getElementById(name + "_calories").value = (calories / carbs * carbsParameter).toFixed(2);
                            }
                        </script>
                    <?php endif?>
                <?php endforeach?>
                
                <tfoot>
                    <tr style="border-top: 1px solid gray;">
                        <td></td>
                        <td></td>
                        <th id="demo" style="background-color: rgb(225, 225, 225);"><?php echo "Kopā: " .  $totalCarbs; ?></th>
                        <th id="demo"><?php echo "Kopā: " . $totalCalories; ?></th>
                    </tr>
                </tfoot>
            </tbody>
        </table>
        <button type="submit" name="SessionSaver" style="position: absolute; height: 40px; width: 100px; left: 530px; background-color: #99FF33;">Save Changes</button>
    </form>

    <!-- BUTTONS -->
    <form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
        <button type="submit" name="SessionUnsetter" style="position: absolute; height: 40px; width: 100px; left: 635px; background-color: #FF3333;">Clear Table</button>
    </form>
</body>
</html>
