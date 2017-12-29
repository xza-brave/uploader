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
    <link rel="stylesheet" href="../view/css/style.css">
</head>

<body>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>管理者画面ですよ</p>
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
                    var no = $(this).parent().find('.no').text();
                    $.ajax({
                        url: 'delete.php',
                        type: 'POST',
                        data: {
                            'no': no
                        },
                        success: function(res) {
                            if (res) {
                                alert("削除に成功しました！");
                                window.location.href = 'admin.php';
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
