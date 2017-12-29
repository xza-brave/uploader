<?php
class commonModel {

	protected $pdoIns;

	public function __construct(){
		$this->pdoIns = $this->dbconnect();
	}

	private function dbconnect(){
		$user="root";
		$password="";
		$dsn="mysql:dbname=uploders;host=localhost;charset=utf8";
		$pdoIns=new PDO($dsn,$user,$password);
		return $pdoIns;
	}
}
