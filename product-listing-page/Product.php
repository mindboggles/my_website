<?php

namespace test;

abstract class Product
{
    abstract public function setSKU($arr);
    abstract public function setName($arr);
    abstract public function setPrice($arr);
    abstract public function setType($arr);
    abstract public function setAttributes($arr);

    abstract public function getSKU();
    abstract public function getName();
    abstract public function getPrice();
    abstract public function getType();
    abstract public function getAttributes();

    abstract public function insert($pdo);
}