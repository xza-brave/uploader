<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>upload</title>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>管理者画面ですよ</p>
    </div>
    <table class="table table-striped">
        <tr>
            <th>ファイル名</th>
            <th>サイズ</th>
            <th>日付</th>
            <th>コメント</th>
            <th>削除</th>
        </tr>
        <?php foreach ($files as $file) { ?>
            <tr>
                <td><?= $file['ファイル名'] ?></td>
                <td><?= $file['サイズ'] ?></td>
                <td><?= $file['日付'] ?></td>
                <td><?= $file['コメント'] ?></td>
                <td class="delete-btn"><span class="btn btn-link" aria-hidden="true">&times;</span></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
