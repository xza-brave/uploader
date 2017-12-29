<?php
require_once "../model/uploadModel.php";
$model = new uploadModel();
if (isset($_GET['id'])) {
    $file = $model->get($_GET['id']);
} else {
    $file = $model->get($_POST['file-no'], $_POST['pass']);
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
} else {
    // ダウンロードに失敗した時は一覧を表示
    $files = $model->getFiles();

    $msg = "パスワードが違います";

    require_once "../view/index.php";
}
