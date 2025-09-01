<?php

namespace My;

use PDO;

class Select
{
	public static function getNames($connection) {
		$statement = $connection->prepare("SELECT `ID`, `Name` FROM `nutrition_facts_100g`");

		$statement->execute();

		$fetched_result = $statement->fetchAll(PDO::FETCH_ASSOC);

		$result = "";

		foreach($fetched_result as $item) {
			$result .= "/" . $item["ID"] . "-" . $item["Name"];
		}

		return $result;
	}

	public static function getFood($connection, $id) {
		$statement = $connection->prepare("SELECT * FROM `nutrition_facts_100g` WHERE ID = (:id)");

		$statement->bindParam(":id", $id);

		$statement->execute();

		$fetched_result = $statement->fetch(PDO::FETCH_ASSOC);

		$result = "";

		foreach($fetched_result as $item) {
			$result .= "-" .$item;
		}

		return $result;
	}

	public static function getName($connection, $id) {
		$statement = $connection->prepare("SELECT `Name` FROM `nutrition_facts_100g` WHERE ID = (:id)");

		$statement->bindParam(":id", $id);

		$statement->execute();

		$result = $statement->fetch(PDO::FETCH_ASSOC);

		return $result;
	}
}