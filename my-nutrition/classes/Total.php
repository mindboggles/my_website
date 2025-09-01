<?php

namespace My;

class Total 
{
    private $calories = 0;
    private $totalFat = 0;
    private $satFat = 0;
    private $netCarbs = 0;
    private $fiber = 0;
    private $protein = 0;

    public function __construct() {
        foreach($_SESSION["vladsite"]["my-nutrition"] as $array) {
            $this->calories += $array[4];
            $this->totalFat += $array[5];
            $this->satFat += $array[6];
            $this->netCarbs += $array[7];
            $this->fiber += $array[8];
            $this->protein += $array[9];
        }
    }

    public function getTotalCalories() {
        echo $this->calories;
    }

    public function getTotalTotalFat() {
        echo $this->totalFat;
    }

    public function getTotalSatFat() {
        echo $this->satFat;
    }

    public function getTotalNetCarbs() {
        echo $this->netCarbs;
    }

    public function getTotalFiber() {
        echo $this->fiber;
    }

    public function getTotalProtein() {
        echo $this->protein;
    }
}