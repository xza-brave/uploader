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
    <?php if (isset($msg)) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $msg ?>
        </div>
    <?php } ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="MAX_FILE_SIZE" value="4000000">
            <input type="text" name="data[name]" hidden="hidden" id="name">
            <label class="form-label" for="file">ファイル</label>
            <input class="btn btn-sm btn-default" type="file" name="upfile" id="file">
        </div>
        <div class="form-group">
            <label class="form-label" for="password">パスワード</label>
            <input class="form-control" id="password" type="password" name="data[pass]" maxlength="4">
        </div>
        <div class="form-group">
            <label class="form-label" for="comment">コメント</label>
            <input class="form-control" id="comment" type="text" name="data[comment]">
        </div>
        <button class="btn btn-success" type="submit" name="uploadExe">アップロード</button>
        <script type="text/javascript">
        $(function() {
            $('#file').on('change', function() {
                $('#name').val(this.files[0].name);
            });
        });
        </script>
    </form>
    <table class="table table-striped">
        <tr>
            <th>ファイル名</th>
            <th>サイズ</th>
            <th>日付</th>
            <th>コメント</th>
            <th>ダウンロード</th>
        </tr>
        <?php foreach ($files as $file) { ?>
            <tr>
                <td><?= $file['ファイル名'] ?></td>
                <td><?= $file['サイズ'] ?></td>
                <td><?= $file['日付'] ?></td>
                <td><?= $file['コメント'] ?></td>
                <td>
                    <a
                        <?php
                        if (empty($file['パスワード'])) {
                            // パスワードがない時そのままダウンロードできるリンクを貼る
                            echo 'href="download.php?id='.$file['ファイルNo'].'"';
                        } else {
                            // パスワードがある時はパスワード確認モーダルを開く
                            echo 'data-toggle="modal" data-target="#modal" class="toggle-modal"';
                        }
                        ?>>
                        <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
<div class="modal fade" id="modal">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">パスワードを入力</h4>
            </div>
            <div class="modal-body">
                <form id="download" action="download.php" method="post">
                    <input type="hidden" id="file-no" name="file-no">
                    <input type="password" id="pass" class="form-control" name="pass">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                <button type="button" class="btn btn-success" id="submit">送信</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    var key = "";
    $('.toggle-modal').on('click', function() {
        $('#file-no').val($(this).parent().find('.file-no').val());
        $('#pass').val('');
    });
    $('#submit').on('click', function() {
        $('#download').submit();
    });
    $(window).on('keydown', function(e) {
        key += e.key;
        if (key == "hanazawakana") {
            alert("花澤香菜かわいい(はあと");
        }
    });
});
</script>
</body>
</html>
