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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="alert alert-info alert-dismissible" role="alert">
        <p>
            ここは<b>管理画面</b>です。<br>
            通常ページは<a href="index,php" class="alert-link">こちら</a>
        </p>
    </div>
    <table class="table table-striped">
        <tr>
            <th>No.</th>
            <th>ファイル名</th>
            <th>サイズ</th>
            <th>日付</th>
            <th>コメント</th>
            <th>削除</th>
        </tr>
        <?php foreach ($files as $file) { ?>
            <tr>
                <td class="no"><?= $file['ファイルNo'] ?></td>
                <td><?= $file['ファイル名'] ?></td>
                <td><?= $file['サイズ'] ?></td>
                <td><?= $file['日付'] ?></td>
                <td><?= $file['コメント'] ?></td>
                <td class="delete"><span class="btn btn-link" aria-hidden="true">&times;</span></td>
            </tr>
        <?php } ?>
    </table>
    <script type="text/javascript">
        $(function() {
            $(".delete").on('click', function() {
                if (confirm("削除してもよろしいですか？\n２度と元に戻すことはできません！")) {
                    var no = $(this).parent().find('.no').val();
                    $.ajax({
                        url: 'delete.php',
                        type: 'POST',
                        data: {
                            'no': no
                        },
                        success: function(res) {
                            if (res) {
                                alert("削除に成功しました！");
                                $(this).parent().fadeOut();
                            } else {
                                alert("削除に失敗しました...");
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
