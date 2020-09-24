<?php
require_once('conexao.php');

class BhCRUD
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
			$query_Sql = "INSERT INTO tbl_nf(numero_nf,data_emissao,data_lancamento,fornecedor,valor_nf,obs_nf)
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
			$query = "UPDATE tbl_nf SET 
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
			$delete_prod = $this->conn->prepare("DELETE FROM  tbl_itens_nf WHERE id_nf='$id'");
			$delete_prod->execute();
			$delete_nf = $this->conn->prepare("DELETE FROM  tbl_NF WHERE id_nf='$id'");
			$delete_nf->execute();
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function delete_prod_NF($id, $item_estoque, $qtde_nf)
	{
		try {
			$this->conn->beginTransaction();
			$qtde_antiga = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE id_estoque='$item_estoque'");
			$qtde_antiga->execute();
			$query_result = $qtde_antiga->fetchAll(PDO::FETCH_OBJ);
			foreach ($query_result as $v) {
				$qtde_antiga = $v->quantidade_e;
				$qtde_nova = $qtde_antiga - $qtde_nf;
			}
			$query = "UPDATE tbl_estoque SET 
			quantidade_e=:quantidade_e
			WHERE id_estoque='$item_estoque'";
			$editar_nf = $this->conn->prepare($query);
			$editar_nf->bindValue(':quantidade_e', $qtde_nova);
			$editar_nf->execute();
			$delete_prod = $this->conn->prepare("DELETE FROM  tbl_itens_nf WHERE id_itens='$id'");
			$delete_prod->execute();
			if ($delete_prod) {
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	public function index()
	{
		try {
			$view_nf = $this->conn->prepare("SELECT * FROM tbl_nf");
			$view_nf->execute();
			$query_result = $view_nf->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	public function findID($id)
	{
		try {
			$find_nf = $this->conn->prepare("SELECT * FROM tbl_nf WHERE id_nf='$id'");
			$find_nf->execute();
			$query_result = $find_nf->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	public function newProduto($produto)
	{
		try {
			// var_dump($produto);
			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_estoque(produto_e,quantidade_e,valor_un_e,categoria_e,marca_e,unidade_e,estoque_minimo_e) 
			VALUES (:produto_e,:quantidade_e,:valor_un_e,:categoria_e,:marca_e,:unidade_e,:estoque_minimo_e)";
			$sql = $this->conn->prepare($query_Sql);
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
			$query = "UPDATE tbl_estoque SET 
			produto_e=:produto_e,
			quantidade_e=:quantidade_e,
			valor_un_e=:valor_un_e,
			categoria_e=:categoria_e,
			marca_e=:marca_e,
			unidade_e=:unidade_e,
			estoque_minimo_e=:estoque_minimo_e
			WHERE id_estoque='$id'";
			$editar_nf = $this->conn->prepare($query);
			$editar_nf->bindValue(':produto_e', $produto['produto']);
			$editar_nf->bindValue(':quantidade_e', $produto['quantidade']);
			$editar_nf->bindValue(':valor_un_e', $produto['valor']);
			$editar_nf->bindValue(':categoria_e', $produto['categoria']);
			$editar_nf->bindValue(':marca_e', $produto['marca']);
			$editar_nf->bindValue(':unidade_e', $produto['unidade']);
			$editar_nf->bindValue(':estoque_minimo_e', $produto['estoque_minimo_e']);
			$editar_nf->execute();
			if ($editar_nf) {
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
			$view_estoque = $this->conn->prepare("SELECT * FROM tbl_estoque");
			$view_estoque->execute();
			$query_result = $view_estoque->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	public function estoqueID($id)
	{
		try {
			$view_estoque = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE id_estoque='$id'");
			$view_estoque->execute();
			$query_result = $view_estoque->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function estoque_anestesia()
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
	public function addProd_nf($produto_nf)
	{
		try {

			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_itens_nf(item_nf,qtde_nf,lote_e,validade_prod_nf,id_nf) VALUES (:item_nf,:qtde_nf,:lote_e,:valiadde_prod_nf,:id_nf)";
			$sql = $this->conn->prepare($query_Sql);
			$sql->bindValue(':item_nf', $produto_nf['produto']);
			$sql->bindValue(':qtde_nf', $produto_nf['quantidade']);
			$sql->bindValue(':lote_e', $produto_nf['lote']);
			$sql->bindValue(':valiadde_prod_nf', $produto_nf['validade']);
			$sql->bindValue(':id_nf', $produto_nf['nf']);
			$sql->execute();
			$produto = $produto_nf['produto'];
			$qtde_antiga = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE id_estoque='$produto'");
			$qtde_antiga->execute();
			$query_result = $qtde_antiga->fetchAll(PDO::FETCH_OBJ);
			foreach ($query_result as $v) {
				$qtde_antiga = $v->quantidade_e;
				$qtde_nova = $qtde_antiga + $produto_nf['quantidade'];
			}
			$alterar_estoque = "UPDATE tbl_estoque SET quantidade_e=:quantidade WHERE id_estoque='$produto'";
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
	public function ver_NF($nf)
	{
		try {
			$view_nf = $this->conn->prepare("SELECT * FROM tbl_nf WHERE id_nf = '$nf'");
			$view_nf->execute();
			$query_result = $view_nf->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function ver_prod_NF($nf)
	{
		try {
			$view_nf = $this->conn->prepare("SELECT * FROM tbl_itens_nf
				INNER JOIN tbl_estoque ON tbl_itens_nf.item_nf = tbl_estoque.id_estoque
				WHERE id_nf = '$nf'");
			$view_nf->execute();
			$query_result = $view_nf->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	public function registrar_saida($saida)
	{
		try {
			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_saida(item_s,quantidade_s,setor_s,data_s,data_dia_s) VALUES (:item_s,:quantidade_s,:setor_s,:data_s,:data_dia_s)";
			$sql = $this->conn->prepare($query_Sql);
			$sql->bindValue(':item_s', $saida['produto']);
			$sql->bindValue(':quantidade_s', $saida['quantidade']);
			$sql->bindValue(':setor_s', $saida['setor']);
			$sql->bindValue(':data_s', $saida['data']);
			$sql->bindValue(':data_dia_s', date("Y-m-d H:i:s"));
			$sql->execute();
			$produto = $saida['produto'];
			$qtde_antiga = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE id_estoque='$produto'");
			$qtde_antiga->execute();
			$query_result = $qtde_antiga->fetchAll(PDO::FETCH_OBJ);
			foreach ($query_result as $v) {
				$qtde_antiga = $v->quantidade_e;
				$qtde_nova = $qtde_antiga - $saida['quantidade'];
			}
			if ($saida['quantidade'] > $qtde_antiga) {
				echo "<script language=\"javascript\">alert(\"Quantidade solicitada é maior que a quantidade em estoque\")</script>";
			} else {
				$alterar_estoque = "UPDATE tbl_estoque SET quantidade_e=:quantidade WHERE id_estoque='$produto'";
				$fazer_alteracao = $this->conn->prepare($alterar_estoque);
				$fazer_alteracao->bindValue(':quantidade', $qtde_nova);
				$fazer_alteracao->execute();
				if ($fazer_alteracao) {
					$this->conn->commit();
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
			$view_nf = $this->conn->prepare("SELECT * FROM tbl_saida
				INNER JOIN tbl_estoque ON tbl_saida.item_s = tbl_estoque.id_estoque");
			$view_nf->execute();
			$query_result = $view_nf->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	public function filtro_historico($setor)
	{
		try {
			$query_sql = $this->conn->prepare("SELECT * FROM tbl_saida
			INNER JOIN tbl_estoque ON tbl_saida.item_s = tbl_estoque.id_estoque WHERE setor_s='$setor'");
			$query_sql->execute();
			$query_result = $query_sql->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	public function cancelarSaida($id, $prod, $qtde)
	{
		try {
			$ver_prod = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE id_estoque=$prod");
			$ver_prod->execute();
			$query_result = $ver_prod->fetchAll(PDO::FETCH_OBJ);
			foreach ($query_result as $p) {
				$qtdeA = $p->quantidade_e;
			}
			$alterar_estoque = "UPDATE tbl_estoque SET quantidade_e=:quantidade WHERE id_estoque='$prod'";
			$fazer_alteracao = $this->conn->prepare($alterar_estoque);
			$fazer_alteracao->bindValue(':quantidade', $qtdeA + $qtde);
			$fazer_alteracao->execute();
			$delete_saida = $this->conn->prepare("DELETE FROM  tbl_saida WHERE id_saida='$id'");
			$delete_saida->execute();
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

	/* função para relatorio */




	public function v_pedidos()
	{
		try {
			$pedidossql = $this->conn->prepare("SELECT * FROM tbl_solicitacoes
				INNER JOIN tbl_estoque ON tbl_solicitacoes.item_req = tbl_estoque.id_estoque
				WHERE status_req='0'");
			$pedidossql->execute();
			$query_result = $pedidossql->fetchAll(PDO::FETCH_OBJ);
			return $query_result;
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function aceitar_pedidos($id, $ide)
	{
		try {
			$qtde_antiga = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE id_estoque='$ide'");
			$qtde_antiga->execute();
			$v_qa = $qtde_antiga->fetchAll(PDO::FETCH_OBJ);
			foreach ($v_qa as $q) {
				$q_antiga = $q->quantidade_e;
			}
			$qtde_solicitada = $this->conn->prepare("SELECT * FROM tbl_solicitacoes WHERE id_req='$id'");
			$qtde_solicitada->execute();
			$v_qs = $qtde_solicitada->fetchAll(PDO::FETCH_OBJ);
			foreach ($v_qs as $q) {
				$q_solicitada = $q->qtde_req;
			}

			$n_qtde = $q_antiga - $q_solicitada;

			$alterar_qtde = "UPDATE tbl_estoque SET quantidade_e=:quantidade_e WHERE id_estoque='$ide'";
			$alterar_qtde = $this->conn->prepare($alterar_qtde);
			$alterar_qtde->bindValue(':quantidade_e', $n_qtde);
			$alterar_qtde->execute();

			$alterar_status = "UPDATE tbl_solicitacoes SET status_req=:status_req WHERE id_req='$id'";
			$alterar_status = $this->conn->prepare($alterar_status);
			$alterar_status->bindValue(':status_req', "1");
			$alterar_status->execute();

			foreach ($v_qs as $i) {
				echo "<pre>";
				var_dump($i);
				echo "<pre>";
				$this->conn->beginTransaction();
				$query_Sql = "INSERT INTO tbl_saida(item_s,quantidade_s,setor_s,data_s,data_dia_s) 
				VALUES (:item_s,:quantidade_s,:setor_s,:data_s,:data_dia_s)";
				$sql = $this->conn->prepare($query_Sql);
				$sql->bindValue(':item_s', $ide);
				$sql->bindValue(':quantidade_s', $i->qtde_req);
				$sql->bindValue(':setor_s', $i->setor_req);
				$sql->bindValue(':data_s', $i->data_req);
				$sql->bindValue(':data_dia_s', date("Y-m-d"));
				$sql->execute();
				if ($sql) {
					$this->conn->commit();
				} else {
					$this->conn->rollBack();
				}
			}
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function recusar_pedidos($id)
	{
		try {
			$alterar_status = "UPDATE tbl_solicitacoes SET status_req=:status_req WHERE id_req='$id'";
			$alterar_status = $this->conn->prepare($alterar_status);
			$alterar_status->bindValue(':status_req', "2");
			$alterar_status->execute();
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}

	public function contar_notificacao()
	{
		$contar = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE quantidade_e<=estoque_minimo_e");
		$contar->execute();
		$quantidade = $contar->rowCount();
		return $quantidade;
	}

	public function ver_notificacoes()
	{
		$ver = $this->conn->prepare("SELECT * FROM tbl_estoque WHERE quantidade_e<=estoque_minimo_e");
		$ver->execute();
		return $ver->fetchAll(PDO::FETCH_OBJ);
	}

	public function login($user, $password)
	{
		$user = $this->conn->prepare("SELECT * FROM tbl_usuarios WHERE nome_user='$user' and password='$password'");
		$user->execute();
		return $user->rowCount();
	}

	public function cadOrdemCompra($forcenedor, $data)
	{
		try {
			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_ordem_compra(nome_f,data_c) VALUES (:nome_f,:data_c)";
			$sql = $this->conn->prepare($query_Sql);
			$sql->bindValue(':nome_f', $forcenedor);
			$sql->bindValue(':data_c', $data);
			$sql->execute();
			if ($sql) {
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			$this->conn->rollBack();
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function ver_ordensCompra()
	{
		$ver = $this->conn->prepare("SELECT * FROM tbl_ordem_compra");
		$ver->execute();
		return $ver->fetchAll(PDO::FETCH_OBJ);
	}
	public function verOrdemTotal($idOrdem)
	{
		$ver = $this->conn->prepare("SELECT * FROM tbl_ordem_compra
		INNER JOIN tbl_items_compra 
		ON tbl_ordem_compra.id_ordem = tbl_items_compra.ordem_compra_id
		INNER JOIN tbl_estoque
		ON tbl_items_compra.item_compra = tbl_estoque.id_estoque
		WHERE tbl_ordem_compra.id_ordem='$idOrdem'");
		$ver->execute();
		return $ver->fetchAll(PDO::FETCH_OBJ);
	}
	public function deleteOrdem($id)
	{
		try {
			$delete_ordem = $this->conn->prepare("DELETE FROM  tbl_ordem_compra WHERE id_ordem='$id'");
			$delete_ordem->execute();
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function addProdOdemCompra($produto, $ordemCompra,$qtdeCompra)
	{
		try {
			$this->conn->beginTransaction();
			$query_Sql = "INSERT INTO tbl_items_compra(item_compra,ordem_compra_id,qtde_compra) VALUES (:item_compra,:ordem_compra_id,:qtde_compra)";
			$sql = $this->conn->prepare($query_Sql);
			$sql->bindValue(':item_compra', $produto);
			$sql->bindValue(':ordem_compra_id', $ordemCompra);
			$sql->bindValue(':qtde_compra', $qtdeCompra);
			$sql->execute();
			if ($sql) {
				$this->conn->commit();
			}
		} catch (PDOException $erro) {
			$this->conn->rollBack();
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
	public function deleteProdOrdem($id)
	{
		try {
			$deleteProd = $this->conn->prepare("DELETE FROM tbl_items_compra WHERE id_item_compra='$id'");
			$deleteProd->execute();
		} catch (PDOException $erro) {
			echo "<script language=\"javascript\">alert(\"Erro...\")</script>";
		}
	}
}
