<?php

namespace My;

use PDO;

class Connection
{
	public static function create($host, $dbname, $user, $pass) {
		return new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	} 
}