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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css"/>
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
        <?php include_once "widget/menu.php"?>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                    <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i> Box Hub
                        / Estoque
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
                            <!--<a href="#" class="badge badge-secondary"><i class="fas fa-bell text-white"></i> <span
                                        class="badge text-white">5</span></a>-->
                        </div>
                    </div>
                </nav>
                <div class="mt-5 roboto-condensed">
                    <form method="POST" action="back/response/estoque_r.php">
                        <input type="hidden" name="new" value="1">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="roboto-condensed">Produto</label>
                                <input type="text" class="form-control" name="produto_e" id="inputEmail4"
                                       placeholder="" required>
                            </div>

                            <div class="col-md-2">
                                <label for="inputEmail4" class="roboto-condensed">Valor</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-primary text-light roboto-condensed">R$
                                        </div>
                                    </div>
                                    <?php if ($_SESSION['user'] == 'compras.hvu') { ?>
                                        <input type='text' class='form-control ' name='valor_un' placeholder=''>
                                        <small>Utilize ponto no lugar da vírgula</small>
                                    <?php } else { ?>
                                        <input type='text' class='form-control ' name='valor_un' placeholder=''
                                               disabled>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail4" class="roboto-condensed">Quantidade</label>
                                <input type="text" class="form-control" name="quantidade_e" id="inputEmail4"
                                       placeholder="">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4" class="roboto-condensed">Estoque Mínimo</label>
                                <input type="text" class="form-control" name="estoque_minimo_e" id="inputEmail4"
                                       placeholder="">
                            </div>
                        </div>
                        <!--<div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="exampleFormControlSelect1">Categoria</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="categoria_e">
                                    <option value="">Escolher...</option>
                                    <?php
                        /*                                    require_once('back/crud/configCRUD.php');
                                                            $c = new ConfigCRUD();
                                                            $categorias = $c->ver_categoria();
                                                            foreach ($categorias as $c) {
                                                                */ ?>
                                        <?php /*echo "<option value=$c->categoria_c>" . str_replace("-", " ", $c->categoria_c) . "</option>" */ ?>
                                    <?php /*} */ ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleFormControlSelect1">Unidade de medida</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="unidade_e">
                                    <option value="">Escolher...</option>
                                    <?php
                        /*                                    require_once('back/crud/configCRUD.php');
                                                            $un = new ConfigCRUD();
                                                            $uni_medida = $un->ver_UNM();
                                                            foreach ($uni_medida as $un) {
                                                                */ ?>
                                        <?php /*echo "<option value=$un->un_medida>" . str_replace("-", " ", $un->un_medida) . "</option>" */ ?>
                                    <?php /*} */ ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleFormControlSelect1">Marca</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="marca_e">
                                    <option value="">Escolher...</option>
                                    <?php
                        /*                                    require_once('back/crud/configCRUD.php');
                                                            $m = new ConfigCRUD();
                                                            $marca = $m->ver_marcas();
                                                            foreach ($marca as $m) {
                                                                */ ?>
                                        <?php /*echo "<option value=$m->marca_m>" . str_replace("-", " ", $m->marca_m) . "</option>" */ ?>
                                    <?php /*} */ ?>
                                </select>
                            </div>
                        </div>-->
                        <button type="submit" class="btn bg-primary shadow col-sm-2 exo mt-1 text-white">Novo Produto <i
                                    class="fas fa-plus ml-2"></i></button>
                    </form>
                </div>
            </div>
            <div class="container mt-5 ">
                <table id="example" class="table table-sm text-center roboto-condensed">
                    <thead class="bg-shadow-it bg-primary">
                    <tr class="text-light ">
                        <th class="">Cod.</th>
                        <th class="">Produto / Meterial</th>
                        <th class="">Quantidade</th>
                        <th class="">Valor (UN)</th>
                    </tr>
                    </thead>
                    <tbody class="text-black-50">
                    <?php
                    require_once('back/crud/farmaciaCRUD.php');
                    $view_estoque = new FarmaciaCRUD();
                    $all_estoque = $view_estoque->verEstoque();
                    foreach ($all_estoque as $v) {
                        ?>
                        <tr>
                            <td><?= $v->id_estoque ?></td>
                            <?php echo "<td><a class='text-black-50' style='text-decoration: none' href=e_estoque_farma.php?idp=" . $v->id_estoque . ">$v->produto_e</td>"; ?>
                            <td><?= $v->quantidade_e ?></td>

                            <td><?= ($permissao == 'disabled') ? '*****' : 'R$' . $v->valor_un_e ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
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
                "sSearch": "Buscar",
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