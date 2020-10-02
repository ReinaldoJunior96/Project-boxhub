<?php
require_once('conexao.php');

class NotaFController
{
    public $conn = null;

    function __construct()
    {
        $this->conn = PDOconectar::conectar();
    }

    public function insert($nf)
    {
        try {
            $this->conn->beginTransaction();
            $query_Sql = /** @lang text */
                "INSERT INTO tbl_nf(numero_nf,data_emissao,data_lancamento,fornecedor,valor_nf,obs_nf)
			VALUES (:numero_nf,:data_emissao,:data_lancamento,:fornecedor,:valor_nf,:obs_nf)";
            $sql = $this->conn->prepare($query_Sql);
            $sql->bindValue(':numero_nf', $nf['numero']);
            $sql->bindValue(':data_emissao', $nf['data_e']);
            $sql->bindValue(':data_lancamento', $nf['data_l']);
            $sql->bindValue(':fornecedor', $nf['fornecedor']);
            $sql->bindValue(':valor_nf', $nf['valor']);
            $sql->bindValue(':obs_nf', $nf['obs']);

            $sql->execute();
            if ($sql) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function edit_NF($nf, $id)
    {
        try {
            $this->conn->beginTransaction();
            $query = /** @lang text */
                "UPDATE tbl_nf SET 
			numero_nf=:numero_nf,
			data_emissao=:data_emissao,
			data_lancamento=:data_lancamento,
			fornecedor=:fornecedor,
			valor_nf=:valor_nf,
			obs_nf=:obs_nf
			WHERE id_nf='$id'";
            $editar_nf = $this->conn->prepare($query);
            $editar_nf->bindValue(':numero_nf', $nf['numero']);
            $editar_nf->bindValue(':data_emissao', $nf['data_e']);
            $editar_nf->bindValue(':data_lancamento', $nf['data_l']);
            $editar_nf->bindValue(':fornecedor', $nf['fornecedor']);
            $editar_nf->bindValue(':valor_nf', $nf['valor']);
            $editar_nf->bindValue(':obs_nf', $nf['obs']);
            $editar_nf->execute();
            if ($editar_nf) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function delete_NF($id)
    {
        try {
            $searchProd = $this->conn->prepare("SELECT * FROM tbl_itens_nf WHERE id_nf='$id'");
            $searchProd->execute();
            $itens = $searchProd->fetchAll(PDO::FETCH_OBJ);
            foreach ($itens as $v){

                $qtde = $this->conn->prepare(/** @lang text */"SELECT * FROM tbl_estoque WHERE id_estoque='$v->item_nf'");
                $qtde->execute();
                $item = $qtde->fetchAll(PDO::FETCH_OBJ);
                $qtdeNova = $item[0]->quantidade_e - $v->qtde_nf;
                $alterar_estoque = /** @lang text */
                    "UPDATE tbl_estoque SET quantidade_e=:quantidade WHERE id_estoque='$v->item_nf'";
                $fazer_alteracao = $this->conn->prepare($alterar_estoque);
                $fazer_alteracao->bindValue(':quantidade', $qtdeNova);
                $fazer_alteracao->execute();
            }
            $delete_prod = $this->conn->prepare("DELETE FROM  tbl_itens_nf WHERE id_nf='$id'");
            $delete_prod->execute();
            $delete_nf = $this->conn->prepare("DELETE FROM  tbl_nf WHERE id_nf='$id'");
            $delete_nf->execute();
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function verificarNota($idnf)
    {
        $verificar = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_items_compra
        INNER JOIN tbl_ordem_compra
        ON tbl_items_compra.ordem_compra_id = tbl_ordem_compra.id_ordem
        INNER JOIN tbl_nf
        on tbl_ordem_compra.id_fk_nf = tbl_nf.id_nf
        WHERE tbl_ordem_compra.id_fk_nf = '$idnf' AND tbl_nf.status_nf = 0");
        $verificar->execute();
        return $verificar->rowCount();
    }

    public function importData($idnf)
    {
        $importOrdem = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_items_compra
        INNER JOIN tbl_ordem_compra
        ON tbl_items_compra.ordem_compra_id = tbl_ordem_compra.id_ordem
        INNER JOIN tbl_nf
        on tbl_ordem_compra.id_fk_nf = tbl_nf.id_nf
        WHERE tbl_ordem_compra.id_fk_nf = '$idnf' AND tbl_nf.status_nf = 0");
        $importOrdem->execute();
        $dados = $importOrdem->fetchAll(PDO::FETCH_OBJ);
        foreach ($dados as $v) {
            $produto = array(
                'produto' => $v->item_compra,
                'quantidade' => $v->qtde_compra,
                'lote' => "",
                'validade' => "",
                'nf' => $idnf
            );
            self::addProdNf($produto);
        }
        self::alterarStatus($idnf);
    }

    public function addProdNf($produto_nf)
    {
        try {
            $this->conn->beginTransaction();
            $query_Sql = /** @lang text */
                "INSERT INTO tbl_itens_nf(item_nf,qtde_nf,lote_e,validade_prod_nf,id_nf) 
                VALUES (:item_nf,:qtde_nf,:lote_e,:valiadde_prod_nf,:id_nf)";
            $sql = $this->conn->prepare($query_Sql);
            $sql->bindValue(':item_nf', $produto_nf['produto']);
            $sql->bindValue(':qtde_nf', $produto_nf['quantidade']);
            $sql->bindValue(':lote_e', $produto_nf['lote']);
            $sql->bindValue(':valiadde_prod_nf', $produto_nf['validade']);
            $sql->bindValue(':id_nf', $produto_nf['nf']);
            $sql->execute();
            $produto = $produto_nf['produto'];
            $qtde_antiga = $this->conn->prepare(/** @lang text */"SELECT * FROM tbl_estoque WHERE id_estoque='$produto'");
            $qtde_antiga->execute();
            $query_result = $qtde_antiga->fetchAll(PDO::FETCH_OBJ);
            $qtde_nova = 0;
            foreach ($query_result as $v) {
                $qtde_antiga = $v->quantidade_e;
                $qtde_nova = $qtde_antiga + $produto_nf['quantidade'];
            }
            $alterar_estoque = /** @lang text */ "UPDATE tbl_estoque SET quantidade_e=:quantidade WHERE id_estoque='$produto'";
            $fazer_alteracao = $this->conn->prepare($alterar_estoque);
            $fazer_alteracao->bindValue(':quantidade', $qtde_nova);
            $fazer_alteracao->execute();
            if ($fazer_alteracao) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function alterarStatus($idnf)
    {
        try {
            $this->conn->beginTransaction();
            $query = /** @lang text */
                "UPDATE tbl_nf SET 
			status_nf=:status_nf
			WHERE id_nf='$idnf'";
            $editar_nf = $this->conn->prepare($query);
            $editar_nf->bindValue(':status_nf', 1);
            $editar_nf->execute();
            if ($editar_nf) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function verProdNF($nf)
    {
        try {
            $view_nf = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_itens_nf
				INNER JOIN tbl_estoque ON tbl_itens_nf.item_nf = tbl_estoque.id_estoque
				WHERE id_nf = '$nf'");
            $view_nf->execute();
            return $view_nf->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }


    public function editProfNF($produto,$idprod)
    {
        try {
            $this->conn->beginTransaction();
            $query = /** @lang text */
                "UPDATE tbl_itens_nf SET 
			lote_e=:lote_e,
			validade_prod_nf=:validade_prod_nf
			WHERE id_itens='$idprod'";
            $editProfnf = $this->conn->prepare($query);
            $editProfnf->bindValue(':lote_e', $produto['lote']);
            $editProfnf->bindValue(':validade_prod_nf', $produto['validade']);
            $editProfnf->execute();
            if ($editProfnf) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }


}