<?php
require_once("commonModel.php");
class deleteModel extends commonModel{

	public function displayTable(){
		$rank = 1;
		$returnValue = "";
		$sql = "SELECT * FROM fifaranking NATURAL JOIN areas ORDER BY point DESC";
		$stmt = $this->pdoIns->prepare($sql);
		$stmt->execute();
		$output = "";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$country = $row['countryname'];
			$returnValue .= "<tr><td><input type='checkbox' name='selectCountry[]' value='{$country}'></td><td>{$rank}</td><td>{$row['countryname']}</td><td>{$row['point']}</td><td>{$row['areaname']}</td></tr>";
			$rank++;
		}
		return $returnValue;
	}
	public function deleteTable(){
		foreach($_POST['selectCountry'] as $value){
				$sql = "DELETE FROM fifaranking WHERE countryname=?";
				$stmt = $this->pdoIns->prepare($sql);
				$stmt->execute(array($value));
		}
	}
}
?>
