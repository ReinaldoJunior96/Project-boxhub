<?php
require_once('conexao.php');

class ConfigCRUD
{

	public $conn = null;

	function __construct(){$this->conn = PDOconectar::conectar();}


	/* Setores */
	public function insertSetor($setor){
        $setor_replace = str_replace(" ","-",$setor);
		try {
			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_setores(setor_s) VALUES (:setor_s)";
			$sql = $this->conn->prepare($query_Sql);
			$sql->bindValue(':setor_s', $setor_replace);
			$sql->execute();
			if ($sql) {
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			$this->conn->rollBack();
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
    }
    public function delete_setor($id){
		try {
			$query_Sql = $this->conn->prepare("DELETE FROM tbl_setores WHERE id_setor=$id");
			$query_Sql->execute();
			if ($query_Sql) { 
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			// echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
    }
    public function ver_setores(){
		try {
			$setores = $this->conn->prepare("SELECT * FROM tbl_setores");
			$setores->execute();
			$query_result = $setores->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function setor_id($id){
		try {
			$setor = $this->conn->prepare("SELECT * FROM tbl_setores WHERE id_setor='$id'");
			$setor->execute();
			$query_result = $setor->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	
	/* Marca */
	public function insertMarca($marca){
        $marca_replace = str_replace(" ","-",$marca);
		try {
			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_marca(marca_m) VALUES (:marca_m)";
			$sql = $this->conn->prepare($query_Sql);
			$sql->bindValue(':marca_m', $marca_replace);
			$sql->execute();
			if ($sql) {
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			$this->conn->rollBack();
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
    }
    public function delete_marca($id){
		try {
			$query_Sql = $this->conn->prepare("DELETE FROM tbl_marca WHERE id_marca=$id");
			$query_Sql->execute();
			if ($query_Sql) { 
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			// echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
    }
    public function ver_marcas(){
		try {
			$marca = $this->conn->prepare("SELECT * FROM tbl_marca");
			$marca->execute();
			$query_result = $marca->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	/* Unidade de medida */
	public function insertUNM($unm){
        $setor_replace = str_replace(" ","-",$unm);
		try {
			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_un_medida(un_medida) VALUES (:un_medida)";
			$sql = $this->conn->prepare($query_Sql);
			$sql->bindValue(':un_medida', $setor_replace);
			$sql->execute();
			if ($sql) {
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			$this->conn->rollBack();
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
    }
    public function delete_UNM($id){
		try {
			$query_Sql = $this->conn->prepare("DELETE FROM tbl_un_medida WHERE id_medidas=$id");
			$query_Sql->execute();
			if ($query_Sql) { 
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			// echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
    }
    public function ver_UNM(){
		try {
			$query_Sql = $this->conn->prepare("SELECT * FROM tbl_un_medida");
			$query_Sql->execute();
			$query_result = $query_Sql->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	/* Categoria */
	public function insertCategoria($categoria){
        $categoria_replace = str_replace(" ","-",$categoria);
		try {
			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_categoria(categoria_c) VALUES (:categoria_c)";
			$sql = $this->conn->prepare($query_Sql);
			$sql->bindValue(':categoria_c', $categoria_replace);
			$sql->execute();
			if ($sql) {
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			$this->conn->rollBack();
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
    }
    public function delete_categoria($id){
		try {
			$query_Sql = $this->conn->prepare("DELETE FROM tbl_categoria WHERE id_categoria=$id");
			$query_Sql->execute();
			if ($query_Sql) { 
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			// echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
    }
    public function ver_categoria(){
		try {
			$query_Sql = $this->conn->prepare("SELECT * FROM tbl_categoria");
			$query_Sql->execute();
			$query_result = $query_Sql->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
}
