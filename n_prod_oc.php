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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css" />
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="images/fire.png" />
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include_once "widget/menu.php" ?>
            <div class="col-9">
                <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                    <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                        <ul class="navbar-nav mr-auto">

                        </ul>
                        <div class="form-inline my-2 my-lg-0">
                            <span><a href="ordem_pdf.php?id_ordem=<?=$_GET['id_ordem']?>" class="text-white roboto-condensed"><i class="fas fa-print"></i> Imprimir Ordem</a></span>
                        </div>
                    </div>
                </nav>
                <div class="container mt-5 ">
                    <table id="example" class="table table-sm text-center roboto-condensed">
                        <thead class="bg-shadow-it bg-primary">
                            <tr class="text-light ">
                                <th class="">Produto / Material</th>
                                <th>Quantidade UN(Compra)</th>
                                <th class="">Valor (UN)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-black-50">
                            <?php
                            require_once('back/crud/bhCRUD.php');
                            $view_estoque = new BhCRUD();
                            $all_estoque = $view_estoque->verEstoque();
                            foreach ($all_estoque as $v) {
                                ?>
                                <tr>
                                    <form method="POST" action="back/response/n_prod_ordem_compra.php">
                                        <input type="hidden" name="produto_c" value="<?= $v->id_estoque ?>">
                                        <input type="hidden" name="ordem" value="<?= $_GET['id_ordem'] ?>">
                                        <td><?= $v->produto_e ?></td>
                                        <td><input type="number" class="form-control" name="saidaqte_p" id="inputPassword4" placeholder="" style="text-align: center;"></td>
                                        <td><?=$v->valor_un_e?></td>
                                        <td>
                                            <button type="submit" class="btn bg-success roboto-condensed text-white mt-1">Adicionar <i class="fas fa-sign-out-alt"></i>
                                        </td>
                                    </form>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="mt-3">                            
                            <ul class="list-group">
                                <?php
                                $dados = new BhCRUD();
                                $dados_ordem = $dados->verOrdemTotal($_GET['id_ordem']);
                                foreach ($dados_ordem as $value) {
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?=$value->produto_e?> x<?=$value->qtde_compra?>
                                        <a href="back/response/d_prod_compra.php?idprod=<?=$value->id_item_compra?>"><i class='fas fa-ban fa-lg' style='color: red;'></i></a>
                                    </li>
                                <?php } ?>
                            </ul>
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
            $(document).ready(function() {
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
            (function() {
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