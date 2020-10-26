<?php
require_once('conexao.php');

class EstoqueController
{
    public $conn = null;

    function __construct()
    {
        $this->conn = PDOconectar::conectar();
    }

    public function newProduto($produto)
    {
        try {
            $this->conn->beginTransaction();
            $query = /** @lang text */
                "INSERT INTO tbl_estoque(principio_ativo,produto_e,quantidade_e,valor_un_e,estoque_minimo_e,apresentacao,concentracao,forma_farmaceutica,tipo) 
			VALUES (:principio_ativo,:produto_e,:quantidade_e,:valor_un_e,:estoque_minimo_e,:apresentacao,:concentracao,:forma_farmaceutica,:tipo)";
            $sql = $this->conn->prepare($query);
            $sql->bindValue(':principio_ativo', $produto['p_ativo']);
            $sql->bindValue(':produto_e', $produto['produto']);
            $sql->bindValue(':quantidade_e', $produto['quantidade']);
            $sql->bindValue(':valor_un_e', $produto['valor']);
            $sql->bindValue(':estoque_minimo_e', $produto['estoque_minimo_e']);
            $sql->bindValue(':apresentacao', $produto['apresentacao']);
            $sql->bindValue(':concentracao', $produto['concentracao']);
            $sql->bindValue(':forma_farmaceutica', $produto['forma_farmaceutica']);
            $sql->bindValue(':tipo', $produto['tipo']);
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
    public function verEstoqueTotal()
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE produto_e!=''");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function verEstoqueFarmacia()
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE tipo='0' AND produto_e!='' ORDER BY produto_e ASC");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function verProdDiversos()
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE tipo='material'");
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
        if ($setor == 'todos') {
            $sql_qtde = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_saida
            WHERE item_s='$item'
            AND data_dia_s BETWEEN '$datai' AND '$dataf'");
        } else {
            $sql_qtde = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_saida
            WHERE item_s='$item'
            AND setor_s='$setor'	
            AND data_dia_s BETWEEN '$datai' AND '$dataf'");
        }
        $sql_qtde->execute();
        return $sql_qtde->fetchAll(PDO::FETCH_OBJ);
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

    public function historicoProd($id)
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_items_compra
                INNER JOIN tbl_ordem_compra ON tbl_items_compra.ordem_compra_id = tbl_ordem_compra.id_ordem
                INNER JOIN tbl_nf ON tbl_ordem_compra.id_fk_nf = tbl_nf.id_nf
                WHERE tbl_items_compra.item_compra='$id'
                ORDER BY tbl_nf.data_emissao DESC");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function historicoLote($idprod)
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque
                INNER JOIN tbl_nf_lotes ON tbl_estoque.id_estoque = tbl_nf_lotes.id_prod                
                WHERE tbl_nf_lotes.id_prod='$idprod'
                ORDER BY tbl_nf_lotes.validade DESC");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function fornecedorProduto($produto, $fornecedor)
    {
        try {
            $this->conn->beginTransaction();
            $query = /** @lang text */
                "INSERT INTO tbl_prod_fornecedor(idfornecedor,idproduto) 
			VALUES (:idfornecedor,:idproduto)";
            $sql = $this->conn->prepare($query);
            $sql->bindValue(':idfornecedor', $fornecedor);
            $sql->bindValue(':idproduto', $produto);
            $sql->execute();
            if ($sql) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function searchFornecedorProduto($prod)
    {
        try {
            $search = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_fornecedores
                INNER JOIN tbl_prod_fornecedor ON tbl_fornecedores.id_fornecedor = tbl_prod_fornecedor.idfornecedor               
                WHERE tbl_prod_fornecedor.idproduto='$prod'
                ORDER BY tbl_fornecedores.nome_fornecedor ASC");
            $search->execute();
            return $search->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function removeFornecedorProf($id)
    {
        try {
            $delete = $this->conn->prepare(/** @lang text */ "DELETE FROM tbl_prod_fornecedor WHERE idfp='$id'");
            $delete->execute();
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
}