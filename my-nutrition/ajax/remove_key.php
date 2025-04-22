<?php

session_start();

$key = $_REQUEST["key"];

unset($_SESSION["vladsite"]["my-nutrition"][$key]);