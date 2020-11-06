<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('../../back/controllers/configCRUD.php');
$s = new ConfigCRUD();
require_once('../../back/controllers/EstoqueController.php');
$view_estoque = new EstoqueController();
$all_estoque = $view_estoque->verEstoqueFarmaciaSaida();
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
    <link rel="stylesheet" type="text/css" href="../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="../../css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="../../images/fire.png"/>
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
    <style>
        #tabela {
            display: none;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include_once "../componentes/menu.php" ?>
        <div class="col-10">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <h5 class="text-primary roboto-condensed"><img src="../../images/delivery-box.png" class="img-fluid"
                                                                   width="40">
                        <?php $date = date_create($_GET['data_s']); ?>
                        Setor de saída: <?= str_replace("-", " ", $_GET['nomesetor']) ?> /
                        data: <?= date_format($date, 'd/m/Y') ?></h5>
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
                <div class="mt-2 roboto-condensed container" id="tabela">
                    <div class="">
                        <form method="POST" action="../../back/response/saidasetor/n_saida_r.php">
                            <input type="hidden" name="data_s" value="<?= $_GET['data_s'] ?>">
                            <input type="hidden" name="setor_s" value="<?= $_GET['nomesetor'] ?>">

                            <?php foreach ($all_estoque as $value) { ?>
                                <input type="hidden" name="produto_s[]" value="<?= $value->id_estoque ?>">
                                <div class="form-group row">
                                    <label for="inputEmail3"
                                           class="col-sm-5 col-form-label text-right"><?= $value->produto_e ?></label>

                                    <label for="inputEmail3"
                                           class="col-sm-2 col-form-label text-right">Quantidade</label>
                                    <div class="col-sm-2">
                                        <input type="number" name="saidaqte_p[]">
                                    </div>
                                    <label for="inputEmail3"
                                           class="col-sm-2 col-form-label text-right">Em Estoque: <?=$value->quantidade_e?></label>
                                </div>
                                <hr>
                            <?php } ?>
                            <button type="submit" class="btn bg-primary col-sm-2 roboto-condensed text-white">Registrar
                                Saída
                                <i   class="far fa-edit ml-2"></i>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="../../node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
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
<script type='text/javascript'>
    $(document).ready(function () {
        $('#tabela').css("display", "block");
    });
</script>
</body>

</html>