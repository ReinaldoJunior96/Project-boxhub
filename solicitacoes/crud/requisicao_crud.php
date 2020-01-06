<?php
require_once('conexao.php');
date_default_timezone_set('America/Sao_Paulo');

class RequisicaoCRUD
{

    public $conn = null;

    function __construct()
    {
        $this->conn = PDOconectar::conectar();
    }

    public function new_requisicao($solicitacao)
    {
        var_dump($solicitacao['data']);
        try {
            $this->conn->beginTransaction();
            $query_Sql = "INSERT INTO tbl_solicitacoes(item_req,qtde_req,setor_req,data_req,solicitante_req,status_req)
                VALUES (:item_req,:qtde_req,:setor_req,:data_req,:solicitante_req,:status_req)";
            $sql = $this->conn->prepare($query_Sql);
            $sql->bindValue(':item_req', $solicitacao['item']);
            $sql->bindValue(':qtde_req', $solicitacao['quantidade']);
            $sql->bindValue(':setor_req', $solicitacao['setor']);
            $sql->bindValue(':data_req', $solicitacao['data']);
            $sql->bindValue(':solicitante_req', $solicitacao['solicitante']);
            $sql->bindValue(':status_req', $solicitacao['status']);
            $sql->execute();
            if ($sql) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function ver_estoque()
    {
        try {
            $view_estoque = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE categoria_e='Anestesia'");
            $view_estoque->execute();
            $query_result = $view_estoque->fetchAll(PDO::FETCH_OBJ);
            return $query_result;
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function verifica_users($user)
    {
        try {
            $verifica_user = $this->conn->prepare("SELECT * FROM tbl_usuarios WHERE cod_user='$user' AND permission_user='A1'");
            $verifica_user->execute();
            $existe = $verifica_user->rowCount();
            return $existe;
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function solicitacoes()
    {
        try {
            $solicitacoes = $this->conn->prepare("SELECT * FROM tbl_solicitacoes");
            $solicitacoes->execute();
            $query_result = $solicitacoes->fetchAll(PDO::FETCH_OBJ);
            return $query_result;
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
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
}
