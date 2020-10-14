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
                "INSERT INTO tbl_estoque(principio_ativo,produto_e,quantidade_e,valor_un_e,estoque_minimo_e,apresentacao,concentracao,forma_farmaceutica) 
			VALUES (:principio_ativo,:produto_e,:quantidade_e,:valor_un_e,:estoque_minimo_e,:apresentacao,:concentracao,:forma_farmaceutica)";
            $sql = $this->conn->prepare($query);
            $sql->bindValue(':principio_ativo', $produto['p_ativo']);
            $sql->bindValue(':produto_e', $produto['produto']);
            $sql->bindValue(':quantidade_e', $produto['quantidade']);
            $sql->bindValue(':valor_un_e', $produto['valor']);
            $sql->bindValue(':estoque_minimo_e', $produto['estoque_minimo_e']);
            $sql->bindValue(':apresentacao', $produto['apresentacao']);
            $sql->bindValue(':concentracao', $produto['concentracao']);
            $sql->bindValue(':forma_farmaceutica', $produto['forma_farmaceutica']);
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
            $query_update = /** @lang text */"UPDATE tbl_estoque SET 
            principio_ativo=:principio_ativo,
			produto_e=:produto_e,
			quantidade_e=:quantidade_e,
			valor_un_e=:valor_un_e,
			estoque_minimo_e=:estoque_minimo_e,
			apresentacao=:apresentacao,
			concentracao=:concentracao,
			forma_farmaceutica=:forma_farmaceutica
			WHERE id_estoque='$id'";
            $editar_prod = $this->conn->prepare($query_update);
            $editar_prod->bindValue(':principio_ativo', $produto['p_ativo']);
            $editar_prod->bindValue(':produto_e', $produto['produto']);
            $editar_prod->bindValue(':quantidade_e', $produto['quantidade']);
            $editar_prod->bindValue(':valor_un_e', $produto['valor']);
            $editar_prod->bindValue(':estoque_minimo_e', $produto['estoque_minimo_e']);
            $editar_prod->bindValue(':apresentacao', $produto['apresentacao']);
            $editar_prod->bindValue(':concentracao', $produto['concentracao']);
            $editar_prod->bindValue(':forma_farmaceutica', $produto['forma_farmaceutica']);
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

    /* função para relatorio */
    public function pega_nome($item)
    {
        try {
            $sql_p_id = $this->conn->prepare("SELECT * FROM tbl_estoque
			WHERE id_estoque='$item'");
            $sql_p_id->execute();
            $query_result = $sql_p_id->fetchAll(PDO::FETCH_OBJ);
            foreach ($query_result as $k) {
                $produto = array(
                    'produto' => $k->produto_e,
                    'quantidade' => $k->quantidade_e,
                    'valor_un' => $k->valor_un_e
                );
            }
            return $produto;
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function pega_saida($item, $setor, $datai, $dataf)
    {
        $sql_qtde = $this->conn->prepare("SELECT * FROM tbl_saida
		WHERE item_s='$item'
		AND setor_s='$setor'	
		AND data_dia_s BETWEEN '$datai' AND '$dataf'");
        $sql_qtde->execute();
        $query_result = $sql_qtde->fetchAll(PDO::FETCH_OBJ);
        return $query_result;
    }

    public function destroyProduto($id)
    {
        try {
            $deleteProduto = $this->conn->prepare(/** @lang text */ "DELETE FROM tbl_estoque WHERE id_estoque='$id'");
            $deleteProduto->execute();
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
}