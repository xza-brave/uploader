<?php
require_once "../model/uploadModel.php";

$model = new uploadModel();

if(isset($_POST['uploadExe'])){
	$data = $_POST["data"];
	$password = trim(htmlspecialchars($data['pass']));
	$comment = trim(htmlspecialchars($data['comment']));
	$model->uploadFile();
}

$files = $model->getFiles();

require_once "../view/index.php";
