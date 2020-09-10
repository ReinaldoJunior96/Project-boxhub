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
                    <?php
                    require_once('back/crud/bhCRUD.php');
                    $dados_nf = new BhCRUD();
                    $nf = $dados_nf->findID($_GET['idnf']);
                    foreach ($nf

                             as $v) {
                        ?>
                        <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i>
                            Box Hub / Produtos NF nº <?= $v->numero_nf ?> / <a class="text-white roboto-condensed"
                                                                               target="_blank"
                                                                               href="v_nota_fiscal.php?idnf=<?= $_GET['idnf'] ?>">
                                Abrir NF</a>
                        </a>

                        <!--<h5>
                            / Fornecedor: <?= $v->fornecedor ?> - Valor: R$ <?= $v->valor_nf ?> - Data de Emissão:
                            <?= date("d/m/Y", strtotime($v->data_emissao)) ?> - Data de Lançamento:
                            <?= date("d/m/Y", strtotime($v->data_lancamento)) ?>
                        </h5> -->
                    <?php } ?>

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
                <div class="text-center mt-5">
                    <?php
                    foreach ($nf as $v) {
                        ?>
                        <p class="roboto-condensed text-black-50">
                            Fornecedor: <?= $v->fornecedor ?> /
                            Valor: R$ <?= $v->valor_nf ?> /
                            Data de Emissão: <?= date("d/m/Y", strtotime($v->data_emissao)) ?> /
                            Data de Lançamento: <?= date("d/m/Y", strtotime($v->data_lancamento)) ?>
                        </p>
                    <?php } ?>
                    <hr class="bg-primary">
                    <div class="container mt-5 mb-5">
                        <table id="example" class="table table-striped roboto-condensed text-center">
                            <thead class="bg-primary text-white">
                            <tr class="text-white">
                                <th class="">Prod / Material</th>
                                <th class="">Quantidade</th>
                                <th class="">Lote</th>
                                <th class="">Validade</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="text-black-50">
                            <?php
                            require_once('back/crud/bhCRUD.php');
                            $produtos = new BhCRUD();
                            $ver_produtos = $produtos->verEstoque();
                            foreach ($ver_produtos as $v) {
                                ?>
                                <tr>
                                    <form method="POST" action="back/response/n_produtos_nfr.php">
                                        <td>
                                            <?= $v->produto_e ?>
                                        </td>
                                        <input type="hidden" name="nf" value="<?= $_GET['idnf'] ?>">
                                        <input type="hidden" name="prod_id" value="<?= $v->id_estoque ?>">
                                        <td>
                                            <input type="number" class="form-control" name="quantidade_pnf"
                                                   id="inputPassword4"
                                                   placeholder="">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="lote_pnf" id="inputPassword4"
                                                   placeholder="">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" name="validade_pnf"
                                                   id="inputPassword4" placeholder="">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn border-0 bg-primary mt-1">
                                                <i class="fas fa-plus text-white"></i>
                                            </button>
                                        </td>
                                    </form>
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
                "sLengthMenu": "_MENU_ <r class='varela-round azul-mateus'>resultados por página</r>",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "<r class='varela-round azul-mateus'>Buscar</r>",
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