<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('back/crud/configCRUD.php');
$s = new ConfigCRUD();
switch ($_SESSION['user']) {
    case 'farma.hvu':
        $permissao = 'disabled';
        break;
    case 'compras.hvu':
        $permissao = '';
        break;
    default:
        $permissao = '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title>Box Hub</title>
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="shadow p-3">
                <?php

                ?>
                <div class="text-center">
                    <img src="images/box.png" class="img-fluid mt-2" width="100" alt="Imagem responsiva">
                </div>
                <ul class="list-group mt-5">
                    <a href="n_nota_fiscal.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 <?= $permissao ?>"><i
                                class="fas fa-cart-arrow-down"></i> Entrada</a>
                    <a href="nv_estoque.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0"><i
                                class="fas fa-box-open"></i> Estoque</a>
                    <!-- Botão dropright padrão -->
                    <div class="dropright">
                        <a href="#"
                           class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0"
                           data-toggle="dropdown"><i class="fas fa-external-link-alt"></i> Saída</a>
                        <div class="dropdown-menu">
                            <ul class="list-group border-0">
                                <?php
                                $setores = $s->ver_setores();
                                foreach ($setores as $v) {
                                    ?>
                                    <a href="n_saida_setor.php?setor=<?= $v->id_setor ?>&nomesetor=<?= str_replace("-", " ", $v->setor_s) ?>"
                                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0">
                                        <?= str_replace("-", " ", $v->setor_s) ?>
                                    </a>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <a href="n_relatorio.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 <?= $permissao ?>">Relatórios</a>
                    <a href="vd_pedidos.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 >"><i
                                class="fas fa-ticket-alt"></i> Solicitação</a>
                    <a href="config_farma.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 <?= $permissao ?>"><i
                                class="fas fa-cog"></i> Configurações</a>
                    <a href="back/response/destroy_sessao.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 ">Sair</a>
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                    <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i> Box Hub /  Editar produto
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado"
                            aria-expanded="false" aria-label="Alterna navegação">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                        <ul class="navbar-nav mr-auto">

                        </ul>
                        <div class="form-inline my-2 my-lg-0">
                            <a href="#" class="badge badge-secondary"><i class="fas fa-bell text-white"></i> <span
                                        class="badge text-white">5</span></a>
                        </div>
                    </div>
                </nav>
                <div class="mt-5">
                    <?php
                    require_once 'back/crud/farmaciaCRUD.php';
                    $p = new FarmaciaCRUD();
                    $produtos = $p->estoqueID($_GET['idp']);
                    foreach ($produtos as $v) {
                        ?>
                        <form method="POST" action="back/response/estoque_r.php">
                            <input type="hidden" name="edit" value="1">
                            <input type="hidden" name="id" value="<?= $_GET['idp'] ?>">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="inputEmail4" class="exo">Produto</label>
                                    <input type="text" class="form-control" value="<?= $v->produto_e ?>"
                                           name="produto_e"
                                           id="inputEmail4" placeholder="">
                                </div>
                                <?php
                                if ($permissao != 'farma.hvu') {
                                    ?>
                                    <div class="col-2">
                                        <label for="inputEmail4" class="roboto-condensed">Valor</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-primary text-light roboto-condensed">R$
                                                </div>
                                            </div>
                                            <input type="text" class="form-control disabled" name="valor_un" id=""
                                                    placeholder="" value="<?= $v->valor_un_e ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4" class="roboto-condensed">Estoque Mínimo</label>
                                    <input type="text" class="form-control" name="estoque_minimo_e" id="inputEmail4"
                                           value="<?= $v->estoque_minimo_e ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4" class="roboto-condensed">Quantidade</label>
                                    <input type="text" class="form-control" value="<?= $v->quantidade_e ?>"
                                           name="quantidade_e"
                                           id="inputEmail4" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">

                                <!--<div class="form-group col-sm-3">
                                    <label for="exampleFormControlSelect1">Categoria</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="categoria_e">
                                        <?php /*echo "<option value='$v->categoria_e'>$v->categoria_e</option>"; */?>
                                        <?php
/*                                        require_once('back/crud/configCRUD.php');
                                        $c = new ConfigCRUD();
                                        $categorias = $c->ver_categoria();
                                        foreach ($categorias as $c) {
                                            */?>
                                            <?php /*echo "<option value=$c->categoria_c>" . str_replace("-", " ", $c->categoria_c) . "</option>" */?>
                                        <?php /*} */?>
                                    </select>
                                </div>-->
                                <!--<div class="form-group col-sm-3">
                                    <label for="exampleFormControlSelect1">Unidade de medida</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="unidade_e">
                                        <?php /*echo "<option value='$v->unidade_e'>$v->unidade_e</option>"; */?>
                                        <?php
/*                                        require_once('back/crud/configCRUD.php');
                                        $un = new ConfigCRUD();
                                        $uni_medida = $un->ver_UNM();
                                        foreach ($uni_medida as $un) {
                                            */?>
                                            <?php /*echo "<option value=$un->un_medida>" . str_replace("-", " ", $un->un_medida) . "</option>" */?>
                                        <?php /*} */?>
                                    </select>
                                </div>-->
                                <!--<div class="form-group col-sm-3">
                                    <label for="exampleFormControlSelect1">Marca</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="marca_e">
                                        <?php /*echo "<option value='$v->marca_e'>$v->marca_e</option>"; */?>
                                        <?php
/*                                        require_once('back/crud/configCRUD.php');
                                        $m = new ConfigCRUD();
                                        $marca = $m->ver_marcas();
                                        foreach ($marca as $m) {
                                            */?>
                                            <?php /*echo "<option value=$m->marca_m>" . str_replace("-", " ", $m->marca_m) . "</option>" */?>
                                        <?php /*} */?>
                                    </select>
                                </div>-->
                            </div>
                            <button type="submit" class="btn bg-primary col-sm-2 roboto-condensed text-white">Alterar <i
                                        class="far fa-edit ml-2"></i>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ <r class='exo azul-mateus'>resultados por página</r>",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "<r class='exo azul-mateus'>Buscar</r>",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });
</script>
<script type='text/javascript'>
    (function () {
        if (window.localStorage) {
            if (!localStorage.getItem('firstLoad')) {
                localStorage['firstLoad'] = true;
                window.location.reload();
            } else
                localStorage.removeItem('firstLoad');
        }
    })();
</script>
</body>

</html>