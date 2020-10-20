<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: ../user/login.php");
}
require_once('../../back/controllers/configCRUD.php');
$s = new ConfigCRUD();
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
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include_once "../componentes/menu.php" ?>
        <div class="col-10">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- <a class="navbar-brand text-white roboto-condensed" href="#">
                    <i class="fas fa-box-open text-primary"></i>
                </a> -->
                <h5 class="text-primary roboto-condensed"><img src="../../images/shopping.png" class="img-fluid" width="40">
                    Compras</h5>
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
            <div class="mt-1 roboto-condensed">
                <form method="post" action="../../back/response/compra/n_ordem_compra.php">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Fornecedor</label>
                        <div class="col-sm-9">
                            <select class="form-control col-5" id="exampleFormControlSelect1" name="nome_f" required>
                                <option selected></option>
                                <?php
                                require_once('../../back/controllers/FornecedorController.php');
                                $fornecedorController = new FornecedorController();
                                $fornecedores = $fornecedorController->verFornecedores();
                                foreach ($fornecedores as $v) {
                                    ?>
                                    <option class="roboto-condensed"
                                            value="<?= $v->nome_fornecedor ?>"><?= str_replace("-", " ", $v->nome_fornecedor) ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="form-inline mt-3">
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="radio" class="form-check-input" name="info_ne" value="0" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">Nota Fiscal</label>
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="radio" class="form-check-input" name="info_ne" value="1" id="exampleCheck2" required>
                                    <label class="form-check-label" for="exampleCheck2">Nota de Entrega</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">Nova Ordem <i class="fas fa-plus"></i>
                    </button>
                </form>
            </div>
            <hr>
            <div class="">
                <div class="container mt-1">
                    <table id="example" class="table table-sm text-center roboto-condensed">
                        <thead class="bg-shadow-it bg-nav">
                        <tr class="text-light ">
                            <th class="">Ordem C</th>
                            <th class="">NE / NF</th>
                            <th class="">Fornecedor / Ordem </th>
                            <th class="">Criada em</th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-black-50">
                        <?php
                        include '../../back/controllers/CompraController.php';
                        $view_ordens = new CompraController();
                        $all_ordens = $view_ordens->verOrdens();
                        foreach ($all_ordens as $v) {
                            ?>
                            <tr>
                                <td class=""><?= $v->id_ordem ?></td>
                                <td class=""><a href="../notaf/n_produtos_nota_fiscal.php?idnf=<?= $v->id_fk_nf ?>"><?= $v->id_fk_nf ?></a></td>
                                <td class="text-primary"><a href="n_prod_oc.php?id_ordem=<?= $v->id_ordem ?>"><?= $v->nome_f ?></a></td>
                                <td class=""><?= date("d/m/Y H:i:s", strtotime($v->data_c)) ?></td>

                                <td><a href="../../back/response/compra/d_ordem_compra.php?idordem=<?= $v->id_ordem ?>"><i
                                                class='fas fa-trash text-danger'></i></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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