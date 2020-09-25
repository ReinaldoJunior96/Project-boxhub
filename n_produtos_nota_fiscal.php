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
    <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-dt/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="images/fire.png"/>
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php include_once "widget/menu.php" ?>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <?php
                    require_once('back/crud/bhCRUD.php');
                    $dados_nf = new BhCRUD();
                    $nf = $dados_nf->findID($_GET['idnf']);
                    foreach ($nf as $v) { ?>
                        <img src="images/document.png" class="img-fluid"
                             width="40">
                        <h5 class="text-primary roboto-condensed ml-2 mt-1"> Nota Fiscal Nº - <?= $v->numero_nf ?></h5>
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
                            <h6 class="text-black-50 roboto-condensed"><i
                                        class="fas fa-user text-primary"></i> <?= $_SESSION['user'] ?></h6>
                        </div>
                    </div>
                </nav>
                <div class="mt-1 roboto-condensed text-black-50">
                    <?php
                    foreach ($nf as $v) {
                        ?>
                        <h6><i class="fas fa-user-tag text-black-50"></i> Fornecedor: <?= $v->fornecedor ?></h6>

                        <h6><span class="fas fa-calendar-alt text-black-50"></span> Data de
                            Emissão: <?= date("d/m/Y", strtotime($v->data_emissao)) ?></h6>
                        <h6><span class="far fa-calendar-alt text-black-50 "></span> Data de
                            Lançamento: <?= date("d/m/Y", strtotime($v->data_lancamento)) ?></h6>
                        <h6><i class="fas fa-dollar-sign text-black-50"></i> Valor:
                            R$ <?= str_replace(".", ",", $v->valor_nf) ?></h6>
                        <a class="text-primary" target="_blank"
                           href="v_nota_fiscal.php?idnf=<?= $_GET['idnf'] ?>"><i class="fas fa-print"></i> Imprimir</a>
                    <?php } ?>
                    <hr class="bg-primary">
                </div>


                <div class="mt-1 roboto-condensed text-black-50">
                    <div class="container mb-5">
                        <table id="example" class="table table-sm text-center roboto-condensed">
                            <thead class="bg-nav  text-white">
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
                                            <button type="submit" class="btn border-0 bg-white mt-1">
                                                <i class="fas fa-file-import text-secondary"></i>
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
<script type="text/javascript" src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
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