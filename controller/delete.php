<?php
session_start();

// 不正アクセス制御
if (!isset($_SESSION['rank']) && $_SESSION['rank'] != "admin" && !isset($_POST['no'])) {
    header("Location:index.php");
    exit(0);
}

// ファイル削除
require_once "../model/fileModel.php";
$model = new fileModel();
$res = $model->delete($_POST['no']);

echo json_encode($res);
