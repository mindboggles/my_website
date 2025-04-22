<?php

session_start([ 
    'cookie_path' => '/my-nutrition',
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
]);

spl_autoload_register(function ($className) {
    $className = explode("\\", $className);
    require_once "classes/" . end($className) . ".php";
});

if(!isset($_SESSION["vladsite"]["my-nutrition"])) {
    $_SESSION["vladsite"]["my-nutrition"] = [];
}

$MyTotal = new \My\Total;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my nutrition</title>
    <link rel="stylesheet" href="my_styles.css">
    <script src="my_scripts.js"></script>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>
<body>








    <!-- <div id="my-nutrition"> -->
        <div id="total-nutrition" onclick="closeManagment();">
            <table>
                <thead>
                    <tr>
                        <td><?php $MyTotal->getTotalCalories(); ?></td>
                        <td><?php $MyTotal->getTotalTotalFat(); ?> (<?php $MyTotal->getTotalSatFat(); ?>)</td>
                        <td><?php $MyTotal->getTotalNetCarbs(); ?></td>
                        <td><?php $MyTotal->getTotalFiber(); ?></td>
                        <td><?php $MyTotal->getTotalProtein(); ?></td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>calories</th>
                        <th>total fat</th>
                        <th>net carbs</th>
                        <th>fiber</th>
                        <th>protein</th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="panels">
            <div id="adding-div" style="display: none;">
                <h1 id="food-search-loading" style="color: white;">Fetching...</h1>
                <input id="food-search" type="text" autocomplete="off" style="display: none;">

                <div id="suggestions-div"></div>
            </div>
            
            <div id="editing-div" style="display: none;">
                <h1 id="editing-div-loading" style="color: white; display: none;">Loading...</h1>
                <h1 id="editing-div-saving" style="color: white; display: none;">Saving...</h1>
                <h1 id="editing-div-deleting" style="color: white; display: none;">Deleting...</h1>

                <div id="edit-table">
                    <p id="edited-key" name="edited-key" style="display: none;">
                    <p id="edited-id" name="edited-id" style="display: none;">
                    <p id="edited-name" name="edited-name"></p>

                    <table>
                        <tbody>
                            <tr>
                                <th>Grams</th>
                                <td><input id="edited-grams" name="edited-grams" type="number" step="1"></td>
                            </tr>
                            <tr>
                                <th>Calories</th>
                                <td id="edited-calories" name="edited-calories"></td>
                            </tr>
                            <tr>
                                <th>Total Fat</th>
                                <td id="edited-total-fat" name="edited-total-fat"></td>
                            </tr>
                            <tr>
                                <th>Saturated Fat</th>
                                <td id="edited-sat-fat" name="edited-sat-fat"></td>
                            </tr>
                            <tr>
                                <th>Net Carbs</th>
                                <td><input id="edited-net-carbs" name="edited-net-carbs" type="number" step="1"></td>
                            </tr>
                            <tr>
                                <th>Fiber</th>
                                <td id="edited-fiber" name="edited-fiber"></td>
                            </tr>
                            <tr>
                                <th>Protein</th>
                                <td id="edited-protein" name="edited-protein"></td>
                            </tr>
                        </tbody>
                    </table>

                    <input id="save-edited" type="submit" value="Save" onclick="saveFood();">
                    <input id="delete-edited" type="button" value="Delete" onclick="deleteFood();">
                </div>
            </div>
        </div>

        <div id="foods-div">
            <?php foreach($_SESSION["vladsite"]["my-nutrition"] as $nutrition_array): ?>
                <?php $MySession = new \My\Session($nutrition_array); ?>

                <div class="foodDiv" type="button" value="edit" onclick="collectData('<?php $MySession->getKey(); ?>', '<?php $MySession->getId(); ?>', '<?php $MySession->getName(); ?>', '<?php $MySession->getGrams(); ?>', '<?php $MySession->getCalories(); ?>', '<?php $MySession->getTotalFat(); ?>', '<?php $MySession->getSatFat(); ?>', '<?php $MySession->getNetCarbs(); ?>', '<?php $MySession->getFiber(); ?>', '<?php $MySession->getProtein(); ?>')">
                    <table>
                        <caption><?php $MySession->getName(); ?>, <?php $MySession->getGrams(); ?> g</caption>

                        <thead>
                            <tr>
                                <td><?php $MySession->getCalories(); ?></td>
                                <td><?php $MySession->getTotalFat(); ?> (<?php $MySession->getSatFat(); ?>)</td>
                                <td><?php $MySession->getNetCarbs(); ?></td>
                                <td><?php $MySession->getFiber(); ?></td>
                                <td><?php $MySession->getProtein(); ?></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php endforeach ?>

            <img id="food-adder" src="+_black.png" onclick="openAddingDiv();">
        </div>
    <!-- </div> -->








    <script>
        fetchSuggestions();
    </script>








</body>
</html>