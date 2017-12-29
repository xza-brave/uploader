<?php
require_once("../model/uploadModel.php");
$obj = new uploadModel();
if (isset($_GET['id'])) {
    $file = $obj->get($_GET['id']);
} else {
    $file = $obj->get($_POST['file-no'], $_POST['pass']);
}

if ($file != false) {

    // ファイルタイプを指定
    header('Content-Type: application/octet-stream');

    // ファイルサイズを取得し、ダウンロードの進捗を表示
    header('Content-Length: ' . $file['size']);

    // ファイルのダウンロード、リネームを指示
    header('Content-Disposition: attachment; filename="'.$file['name'].'"');

    // バイナリ指定
    header('Content-Transfer-Encoding: binary');

    // 出力バッファのゴミ捨て
    ob_end_clean();

    // ファイルを出力
    echo $file['data'];
}
