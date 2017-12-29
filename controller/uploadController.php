<?php
require_once("../model/uploadModel.php");

$uploadOBJ = new uploadModel();

if(isset($_POST['uploadExe'])){
	$data = $_POST["data"];
	$password = trim(htmlspecialchars($data['pass']));
	$comment = trim(htmlspecialchars($data['comment']));
	$uploadOBJ->uploadFile();
}
$outputValue = $uploadOBJ->getFiles();
