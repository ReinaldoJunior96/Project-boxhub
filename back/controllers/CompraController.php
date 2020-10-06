<?php
require_once('conexao.php');
require_once ('bhCRUD.php');

class CompraController{
    public $conn = null;

    function __construct()
    {
        $this->conn = PDOconectar::conectar();
    }
    public function cadOrdemCompra($forcenedor, $data)
    {
        try {
            $this->conn->beginTransaction();
            $notaTemp = /** @lang text */ "INSERT INTO tbl_nf(numero_nf,fornecedor) VALUES (:numero_nf,:fornecedor)";
            $sqlTemp = $this->conn->prepare($notaTemp);
            $sqlTemp->bindValue(':numero_nf', 'temp'.rand(0,99999));
            $sqlTemp->bindValue(':fornecedor', $forcenedor);
            $sqlTemp->execute();
            $lastID = $this->conn->lastInsertId();
            $query_Sql = /** @lang text */ "INSERT INTO tbl_ordem_compra(nome_f,data_c,id_fk_nf) VALUES (:nome_f,:data_c,:id_fk_nf)";
            $sql = $this->conn->prepare($query_Sql);
            $sql->bindValue(':nome_f', $forcenedor);
            $sql->bindValue(':data_c', $data);
            $sql->bindValue(':id_fk_nf', $lastID);
            $sql->execute();
            if ($sqlTemp) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function deleteOrdem($id)
    {
        try {
            $search = self::verOrdem($id);
            $idNF = $search[0]->id_fk_nf;
            $deleteNF = $this->conn->prepare("DELETE FROM  tbl_nf WHERE id_nf='$idNF' AND status_nf='0'");
            $deleteNF->execute();
            $delete_ordem = $this->conn->prepare("DELETE FROM  tbl_ordem_compra WHERE id_ordem='$id'");
            $delete_ordem->execute();
            $deleteProdOrdem = $this->conn->prepare("DELETE FROM  tbl_items_compra WHERE ordem_compra_id='$id'");
            $deleteProdOrdem->execute();
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function addProdCompra($produto, $ordemCompra, $qtdeCompra, $valorUn)
    {
        try {
            $this->conn->beginTransaction();
            $query_Sql = /** @lang text */ "INSERT INTO tbl_items_compra(item_compra,ordem_compra_id,qtde_compra,valor_un_c) VALUES (:item_compra,:ordem_compra_id,:qtde_compra,:valor_un_c)";
            $sql = $this->conn->prepare($query_Sql);
            $sql->bindValue(':item_compra', $produto);
            $sql->bindValue(':ordem_compra_id', $ordemCompra);
            $sql->bindValue(':qtde_compra', $qtdeCompra);
            $sql->bindValue(':valor_un_c', $valorUn);
            $sql->execute();
            if ($sql) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }
    public function verOrdens()
    {
        $ver = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_ordem_compra");
        $ver->execute();
        return $ver->fetchAll(PDO::FETCH_OBJ);
    }
    public function verOrdem($id)
    {
        $ver = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_ordem_compra WHERE id_ordem='$id'");
        $ver->execute();
        return $ver->fetchAll(PDO::FETCH_OBJ);
    }
    public function verOrdemTotal($idOrdem)
    {
        $ver = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_ordem_compra
		INNER JOIN tbl_items_compra 
		ON tbl_ordem_compra.id_ordem = tbl_items_compra.ordem_compra_id
		INNER JOIN tbl_estoque
		ON tbl_items_compra.item_compra = tbl_estoque.id_estoque
		WHERE tbl_ordem_compra.id_ordem='$idOrdem'");
        $ver->execute();
        return $ver->fetchAll(PDO::FETCH_OBJ);
    }
}

