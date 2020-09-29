<?php
require_once('conexao.php');

class EstoqueController{
    public $conn = null;

    function __construct()
    {
        $this->conn = PDOconectar::conectar();
    }
    public function newProduto($produto)
    {
        try{
            $this->conn->beginTransaction();
            $query = /** @lang text */
                "INSERT INTO tbl_estoque(produto_e,quantidade_e,valor_un_e,categoria_e,marca_e,unidade_e,estoque_minimo_e) 
			VALUES (:produto_e,:quantidade_e,:valor_un_e,:categoria_e,:marca_e,:unidade_e,:estoque_minimo_e)";
            $sql = $this->conn->prepare($query);
            $sql->bindValue(':produto_e', $produto['produto']);
            $sql->bindValue(':quantidade_e', $produto['quantidade']);
            $sql->bindValue(':valor_un_e', $produto['valor']);
            $sql->bindValue(':categoria_e', $produto['categoria']);
            $sql->bindValue(':marca_e', $produto['marca']);
            $sql->bindValue(':unidade_e', $produto['unidade']);
            $sql->bindValue(':estoque_minimo_e', $produto['estoque_minimo_e']);
            $sql->execute();
            if ($sql) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function edit_Produto($produto, $id)
    {
        try {
            $this->conn->beginTransaction();
            $query_update = /** @lang text */
                "UPDATE tbl_estoque SET 
			produto_e=:produto_e,
			quantidade_e=:quantidade_e,
			valor_un_e=:valor_un_e,
			categoria_e=:categoria_e,
			marca_e=:marca_e,
			unidade_e=:unidade_e,
			estoque_minimo_e=:estoque_minimo_e
			WHERE id_estoque='$id'";
            $editar_prod = $this->conn->prepare($query_update);
            $editar_prod->bindValue(':produto_e', $produto['produto']);
            $editar_prod->bindValue(':quantidade_e', $produto['quantidade']);
            $editar_prod->bindValue(':valor_un_e', $produto['valor']);
            $editar_prod->bindValue(':categoria_e', $produto['categoria']);
            $editar_prod->bindValue(':marca_e', $produto['marca']);
            $editar_prod->bindValue(':unidade_e', $produto['unidade']);
            $editar_prod->bindValue(':estoque_minimo_e', $produto['estoque_minimo_e']);
            $editar_prod->execute();
            if ($editar_prod) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function verEstoque()
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function estoqueID($id)
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE id_estoque='$id'");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
}