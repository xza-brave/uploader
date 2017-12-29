<?php
require_once "commonModel.php";
class uploadModel extends commonModel {

    /**
     * IDと一致するファイルを返す
     * @param  int   $id ファイルNo
     * @return mixed     見つかったファイルのデータ or 見つからなかった時false
     */
	public function get($id, $pass = ""){
        if ($pass != "") {
            $pass = md5($pass);
        }
		$sql = "SELECT `ファイル名` name, `ファイル` data, `サイズ` size FROM upload WHERE `ファイルNo` = {$id} AND `パスワード` = \"{$pass}\"";
		$stmt = $this->pdoIns->prepare($sql);
		$stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }
        return false;
    }

    /**
     * ファイルの一覧を取得する
     * @return array ファイル一覧
     */
    public function getFiles(){
		$sql = "SELECT * FROM upload";
		$stmt = $this->pdoIns->prepare($sql);
		$stmt->execute();
    	$rows = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $rows[] = $row;
		}
		return $rows;
	}

    /**
     * アップロードされたファイルをDBに保存する
     */
	public function uploadFile(){
		$data = $_POST["data"];
        if (!empty($data['pass'])) {
            $data['pass'] = md5($data['pass']);
        }
		$file = $_FILES["upfile"];
		$handle = fopen($file["tmp_name"], "rb");
        $fileData = "";
        while (!feof($handle)) {
            $buffer = fread($handle, 100000);
            $fileData .= $buffer;
            ob_flush();
            flush();
        }
        $status = fclose($handle);
		//$mime = preg_replace("/ [^ ]*/", "", trim(shell_exec('file -bi ' . escapeshellcmd($file["tmp_name"]))));
		$mime = $file["type"];
        // 許可する拡張子のリスト
        // $extensions = array(
        //     'jpeg' => 'image/jpeg',
        //     'jpg'  => 'image/jpg',
        //     'png'  => 'image/png',
        //     'gif'  => 'image/gif',
        //     'bmp'  => 'image/bmp'
        // );
        // $ext = array_search($mime, $extensions);

		$sql = "INSERT INTO `upload` (`ファイル名`, `ファイル`, `パスワード`, `サイズ`, `コメント`) VALUES(?, ?, ?, ?, ?)";
		$stmt = $this->pdoIns->prepare($sql);
		$stmt->execute(array($data['name'], $fileData, $data['pass'], $file["size"], $data['comment']));
	}

}
