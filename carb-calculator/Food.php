<?php

class Food
{
    public $pdo;
    public $name;
    public $grams;
    public $calories;
    public $carbohydrates;



    public function setPdoConnection($pdoConnection) {
        $this->pdo = $pdoConnection;
    }



    public function setName($foodsName) {
        $query = "SELECT name FROM foods2 WHERE name = '$foodsName'";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $foodName = $statement->fetchColumn();
        
        $this->name = $foodName;
    }



    public function setGrams() {
        $query = "SELECT g FROM foods2 WHERE name = '$this->name'";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $foodGrams = $statement->fetchColumn();
        
        $this->grams = $foodGrams;
    }



    public function setCalories() {
        $query = "SELECT cal FROM foods2 WHERE name = '$this->name'";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $foodCalories = $statement->fetchColumn();
        
        $this->calories = $foodCalories;
    }


    
    public function setCarbohydrates() {
        $query = "SELECT carbs FROM foods2 WHERE name = '$this->name'";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $foodCarbs = $statement->fetchColumn();
        
        $this->carbohydrates = $foodCarbs;
    }
    


    public function getAllFoodNames() {
        $query = "SELECT name FROM foods2;";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $allFoodNames = $statement->fetchAll(PDO::FETCH_COLUMN);

        return $allFoodNames;
    }



    public function getName() {
        return $this->name;
    }
    


    public function getGrams() {
        return $this->grams;
    }
    


    public function getCalories() {
        return $this->calories;
    }
    


    public function getCarbohydrates() {
        return $this->carbohydrates;
    }
}

return new Food;