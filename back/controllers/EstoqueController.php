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
            $qtde_antiga_sql = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE id_estoque='$id'");
            $qtde_antiga_sql->execute();
            $query_result = $qtde_antiga_sql->fetchAll(PDO::FETCH_OBJ);
            $qtde_antiga = 0;
            foreach ($query_result as $v) {
                $qtde_antiga = $v->quantidade_e;
            }
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
                if ($qtde_antiga != $produto['quantidade']) {
                    /* transacao */
                    date_default_timezone_set('America/Sao_Paulo');
                    $hora = new DateTime();
                    $transacao = array(
                        'produto' => $id,
                        'data' => date("Y-m-d H:i:s"),
                        'tipo' => 'Ajuste de Estoque',
                        'estoqueini' => $qtde_antiga,
                        'quantidade' => ($produto['quantidade'] >= $qtde_antiga) ? $produto['quantidade'] - $qtde_antiga : $qtde_antiga - $produto['quantidade'],
                        'estoquefi' => $produto['quantidade'],
                        'cancelada' => ' ',
                        'user' => $produto['user']
                    );
                    $registrarTransaocao = new EstoqueController();
                    $registrarTransaocao->transacaoRegistro($transacao);
                }
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public
    function verEstoqueTotal()
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE produto_e!=''");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public
    function verEstoqueFarmacia()
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE tipo='0' AND produto_e!='' ORDER BY produto_e ASC");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public
    function verEstoqueFarmaciaSaida()
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE tipo='0' AND produto_e != '' AND quantidade_e != '' ORDER BY produto_e ASC");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public
    function verProdDiversos()
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE tipo='material'");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public
    function estoqueID($id)
    {
        try {
            $view_estoque = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE id_estoque='$id'");
            $view_estoque->execute();
            return $view_estoque->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function relatorio($setor, $dataI, $dataF)
    {
        try {
            $query_sql = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_saida
            INNER JOIN tbl_estoque ON tbl_saida.item_s = tbl_estoque.id_estoque
            WHERE setor_s='$setor'
            AND data_dia_s BETWEEN '$dataI' AND '$dataF' ORDER BY item_s ASC");
            $query_sql->execute();
            return $query_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function relatorioGeral($dataI, $dataF)
    {
        try {
            $query_sql = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_saida
            INNER JOIN tbl_estoque ON tbl_saida.item_s = tbl_estoque.id_estoque
            WHERE data_dia_s BETWEEN '$dataI' AND '$dataF' ORDER BY item_s ASC");
            $query_sql->execute();
            return $query_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
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

    public function transacaoRegistro($dados)
    {
        try {
            $this->conn->beginTransaction();
            $transacaoQuery = /** @lang text */
                "INSERT INTO tbl_transacoes(produto_t, data_t,tipo_t, estoqueini_t,quantidade_t,estoquefi_t,cancelada_t, realizadapor_t) 
                VALUES (:produto_t, :data_t,:tipo_t,:estoqueini_t,:quantidade_t,:estoquefi_t,:cancelada_t,:realizadapor_t)";
            $tranSQL = $this->conn->prepare($transacaoQuery);
            $tranSQL->bindValue(':produto_t', $dados['produto']);
            $tranSQL->bindValue(':data_t', $dados['data']);
            $tranSQL->bindValue(':tipo_t', $dados['tipo']);
            $tranSQL->bindValue(':estoqueini_t', $dados['estoqueini']);
            $tranSQL->bindValue(':quantidade_t', $dados['quantidade']);
            $tranSQL->bindValue(':estoquefi_t', $dados['estoquefi']);
            $tranSQL->bindValue(':cancelada_t', $dados['cancelada']);
            $tranSQL->bindValue(':realizadapor_t', $dados['user']);
            $tranSQL->execute();
            if ($tranSQL) {
                $this->conn->commit();
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erraaaaao...\")</script>";
        }
    }

    public function searchTransacoes($prod)
    {
        try {
            $search = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_transacoes           
                WHERE produto_t='$prod'
                ORDER BY data_t DESC LIMIT 0,50");
            $search->execute();
            return $search->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }


    public function registrar_saida($saida)
    {
        try {
            $this->conn->beginTransaction();
            $query_Sql = /** @lang text */
                "INSERT INTO tbl_saida(item_s,quantidade_s,setor_s,data_s,data_dia_s) VALUES (:item_s,:quantidade_s,:setor_s,:data_s,:data_dia_s)";
            $sql = $this->conn->prepare($query_Sql);
            $sql->bindValue(':item_s', $saida['produto']);
            $sql->bindValue(':quantidade_s', $saida['quantidade']);
            $sql->bindValue(':setor_s', $saida['setor']);
            $sql->bindValue(':data_s', $saida['data']);
            $sql->bindValue(':data_dia_s', $saida['data']);
            $sql->execute();
            $produto = $saida['produto'];
            $qtde_antiga = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE id_estoque='$produto'");
            $qtde_antiga->execute();
            $query_result = $qtde_antiga->fetchAll(PDO::FETCH_OBJ);
            $qtde_nova = 0;
            foreach ($query_result as $v) {
                $qtde_antiga = $v->quantidade_e;
                $qtde_nova = $qtde_antiga - $saida['quantidade'];
                $produtoNome = $v->produto_e;
            }
            if ($saida['quantidade'] > $qtde_antiga) {
                echo "<script language=\"javascript\">alert(\"Quantidade solicitada é maior que a quantidade em estoque\")</script>";
            } else {
                $alterar_estoque = /** @lang text */
                    "UPDATE tbl_estoque SET quantidade_e=:quantidade WHERE id_estoque='$produto'";
                $fazer_alteracao = $this->conn->prepare($alterar_estoque);
                $fazer_alteracao->bindValue(':quantidade', $qtde_nova);
                $fazer_alteracao->execute();
                if ($fazer_alteracao) {
                    $this->conn->commit();
                    /* transacao */
                    date_default_timezone_set('America/Sao_Paulo');
                    $hora = new DateTime();
                    $transacao = array(
                        'produto' => $saida['produto'],
                        'data' => date("Y-m-d H:i:s"),
                        'tipo' => 'Saída',
                        'estoqueini' => $qtde_antiga,
                        'quantidade' => $saida['quantidade'],
                        'estoquefi' => $qtde_nova,
                        'cancelada' => ' ',
                        'user' => $saida['user']
                    );
                    $registrarTransaocao = new EstoqueController();
                    $registrarTransaocao->transacaoRegistro($transacao);
                    echo "<script language=\"javascript\">alert(\"Saída Registrada\")</script>";
                }
            }
        } catch (PDOException $erro) {
            $this->conn->rollBack();
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function historico_saida()
    {
        try {
            $view_nf = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_saida
				INNER JOIN tbl_estoque ON tbl_saida.item_s = tbl_estoque.id_estoque 
				ORDER BY tbl_saida.id_saida DESC LIMIT 0,5000");
            $view_nf->execute();
            return $view_nf->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function filtro_historico($setor)
    {
        try {
            $view_nf = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_saida
				INNER JOIN tbl_estoque ON tbl_saida.item_s = tbl_estoque.id_estoque 
				WHERE setor_s = '$setor'
				ORDER BY tbl_saida.id_saida DESC LIMIT 0,500");
            $view_nf->execute();
            return $view_nf->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function cancelarSaida($id, $prod, $qtde, $user)
    {
        try {
            $ver_prod = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque WHERE id_estoque=$prod");
            $ver_prod->execute();
            $query_result = $ver_prod->fetchAll(PDO::FETCH_OBJ);
            $qtdeA = 0;
            foreach ($query_result as $p) {
                $qtdeA = $p->quantidade_e;
            }
            $alterar_estoque = /** @lang text */
                "UPDATE tbl_estoque SET quantidade_e=:quantidade WHERE id_estoque='$prod'";
            $fazer_alteracao = $this->conn->prepare($alterar_estoque);
            $fazer_alteracao->bindValue(':quantidade', $qtdeA + $qtde);
            $fazer_alteracao->execute();
            $delete_saida = $this->conn->prepare(/** @lang text */ "DELETE FROM  tbl_saida WHERE id_saida='$id'");
            $delete_saida->execute();
            /* transacao */
            date_default_timezone_set('America/Sao_Paulo');
            $hora = new DateTime();
            $transacao = array(
                'produto' => $prod,
                'data' => date("Y-m-d H:i:s"),
                'tipo' => 'Saída',
                'estoqueini' => $qtdeA,
                'quantidade' => $qtde,
                'estoquefi' => $qtdeA + $qtde,
                'cancelada' => 'Sim',
                'user' => $user
            );
            $registrarTransaocao = new EstoqueController();
            $registrarTransaocao->transacaoRegistro($transacao);
        } catch (PDOException $erro) {
            echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
        }
    }

    public function ver_notificacoes()
    {
        $ver = $this->conn->prepare(/** @lang text */ "SELECT * FROM tbl_estoque");
        $ver->execute();
        return $ver->fetchAll(PDO::FETCH_OBJ);
    }
}