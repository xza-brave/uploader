<?php
// セッション使う宣言
session_start();

// 裏コマンドが打ち込まれてきた時
if (isset($_POST['keys'])) {
    // 打ち込まれたパスワードを復元
    $pass = "";
    foreach ($_POST['keys'] as $key) {
        $pass += $key;
    }
    // パスワードを照合
    if ($pass == "hanazawakanaShiftEnter") {
        // パスワードが一致した時
        // セッションに権限を保存
        $_SESSION['rank'] = "admin";
        // 200(OK) を返す
        header("HTTP/1.0 200 OK");
        $res = "花澤香菜様万歳！！！"
        echo json_encode($res);
    } else {
        // パスワードが違った時 401(Unauthorized) を返す
        header("HTTP/1.0 401 Unauthorized");
        $res = ""; // 失敗メッセージ(いらない)
        echo json_encode($res);
    }
} else if (isset($_SESSION['rank']) && $_SESSION['rank'] == "admin") {
    // 管理者権限を持つ人がアクセスしてきた時
    require_once "../view/admin.php";
} else {
    // 不正アクセス(URL直打ちなど)
    header("Location:./index.php");
}
