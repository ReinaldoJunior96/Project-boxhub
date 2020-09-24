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
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="images/fire.png" />
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include_once "widget/menu.php"?>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                    <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i>
                        Box Hub / Nota Fiscal Nº
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
                <div class="text-center mt-3">
                    <?php
                    require_once('back/crud/bhCRUD.php');
                    $nf = new BhCRUD();
                    $ver_nf = $nf->ver_NF($_GET['idnf']);
                    foreach ($ver_nf as $v) {
                        ?>
                        <ul class="list-group col-sm-6 exo">
                            <li class="list-group-item active">Nota Fiscal Nº <?= $v->numero_nf ?></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $v->fornecedor ?>
                                <span class="fas fa-user-tag text-secondary fa-lg"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                R$ <?= $v->valor_nf ?>
                                <span class="fas fa-money-bill-wave text-secondary fa-lg"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= date("d/m/Y", strtotime($v->data_emissao)); ?>
                                <span class="fas fa-calendar-alt text-secondary fa-lg"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= date("d/m/Y", strtotime($v->data_lancamento)); ?>
                                <span class="far fa-calendar-alt text-secondary fa-lg"></span>
                            </li>
                        </ul>
                    <?php } ?>
                    <div class="container mt-5">
                        <table id="example" class="table table-sm roboto-condensed text-center ">
                            <thead class="bg-shadow-it bg-primary">
                            <tr class="text-light">
                                <th class="">Prod / Material</th>
                                <th class="">Qtde</th>
                                <th class="">Valor(UN)</th>
                                <th class="">Lote</th>
                                <th class="">Validade</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once('back/crud/bhCRUD.php');
                            $nf = new BhCRUD();
                            $ver_nf = $nf->ver_prod_NF($_GET['idnf']);
                            foreach ($ver_nf as $v) {
                                ?>
                                <tr>
                                    <td><?= $v->produto_e ?></td>
                                    <td><?= $v->qtde_nf ?></td>
                                    <td>R$ <?= $v->valor_un_e ?></td>
                                    <td><?= $v->lote_e ?></td>
                                    <td><?= date("d/m/Y", strtotime($v->validade_prod_nf)) ?></td>
                                    <?php echo "<td><a href=back/response/d_produto_nf.php?id_prod_nf=" . $v->id_itens . "&item_estoque=" . $v->item_nf . "&qtde_nf=" . $v->qtde_nf . "><i class='fas fa-trash text-danger'></i></a></td>" ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

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