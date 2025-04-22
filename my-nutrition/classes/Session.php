<?php

namespace My;

class Session
{
    private $key;
    private $id;
    private $name;
    private $grams;
    private $calories;
    private $totalFat;
    private $satFat;
    private $netCarbs;
    private $fiber;
    private $protein;

    function __construct($arr) {
        $this->key = $arr[0];
        $this->id = $arr[1];
        $this->name = $arr[2];
        $this->grams = $arr[3];
        $this->calories = $arr[4];
        $this->totalFat = $arr[5];
        $this->satFat = $arr[6];
        $this->netCarbs = $arr[7];
        $this->fiber = $arr[8];
        $this->protein = $arr[9];
    }

    public function getKey() {
        echo $this->key;
    }
    
    public function getId() {
        echo $this->id;
    }

    public function getName() {
        echo $this->name;
    }
    
    public function getGrams() {
        echo $this->grams;
    }
    
    public function getCalories() {
        echo $this->calories;
    }
    
    public function getTotalFat() {
        echo $this->totalFat;
    }
    
    public function getSatFat() {
        echo $this->satFat;
    }
    
    public function getNetCarbs() {
        echo $this->netCarbs;
    }
    
    public function getFiber() {
        echo $this->fiber;
    }
    
    public function getProtein() {
        echo $this->protein;
    }
}