<?php
/**
*
*/
class PDOconectar{

	function __construct(){	}
	public function conectar(){
		try{
			$pdo=new PDO("mysql:host=localhost;dbname=farmaciahvu;charset=utf8","root","",
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			return $pdo;
		}catch( PDOException $ex ){ echo "Erro: ".$ex->getMessage(); }
	}
}
?>
