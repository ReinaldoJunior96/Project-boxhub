<?php
require_once('conexao.php');

class FornecedorController
{
    public $conn = null;

    function __construct()
    {
        $this->conn = PDOconectar::conectar();
    }
        public function novoFornecedor($fornecedor)
    {
        try{
            $this->conn->beginTransaction();
            $query = /** @lang text */
                "INSERT INTO tbl_fornecedores(nome_fornecedor,contato_fornecedor,email_fornecedor) 
			VALUES (:nome_fornecedor,:contato_fornecedor,:email_fornecedor)";
            $sql = $this->conn->prepare($query);
            $sql->bindValue(':nome_fornecedor', $fornecedor['nome']);
            $sql->bindValue(':contato_fornecedor', $fornecedor['contato']);
            $sql->bindValue(':email_fornecedor', $fornecedor['email']);
            $sql->execute();
            if ($sql) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function editFornecedor($fornecedor, $id)
    {
        try {
            $this->conn->beginTransaction();
            $query_update = /** @lang text */
                "UPDATE tbl_fornecedores SET 
			nome_fornecedor=:nome_fornecedor,
			contato_fornecedor=:contato_fornecedor,
			email_fornecedor=:email_fornecedor
			WHERE id_fornecedor='$id'";
            $editFornecedor = $this->conn->prepare($query_update);
            $editFornecedor->bindValue(':nome_fornecedor', $fornecedor['nome']);
            $editFornecedor->bindValue(':contato_fornecedor', $fornecedor['contato']);
            $editFornecedor->bindValue(':email_fornecedor', $fornecedor['email']);
            $editFornecedor->execute();
            if ($editFornecedor) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function verFornecedores()
    {
        try {
            $viewFornecedores = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_fornecedores");
            $viewFornecedores->execute();
            return $viewFornecedores->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function verFornecedor($id)
    {
        try {
            $viewFornecedor = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_fornecedores WHERE id_fornecedor='$id'");
            $viewFornecedor->execute();
            return $viewFornecedor->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function destroyFornecedor($id)
    {
        try {
            $deleteFornecedor = $this->conn->prepare(/** @lang text */ "DELETE FROM tbl_fornecedores WHERE id_fornecedor='$id'");
            $deleteFornecedor->execute();
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

}