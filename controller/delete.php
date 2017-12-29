<?php
require_once("../model/commonModel.php");
require_once("../model/deleteModel.php");

$deleteOBJ = new deleteModel();

$pointValue=0;
if(isset($_POST['deleteExe'])){
	foreach ($_POST['selectCountry'] as $country) {
		$pointValue = intval(htmlspecialchars($country));
		$deleteOBJ->deleteTable($pointValue);
		}
	}
$outputValue = $deleteOBJ -> displayTable();
?>
