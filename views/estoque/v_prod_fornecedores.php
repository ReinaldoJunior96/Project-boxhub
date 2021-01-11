<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="../../images/fire.png"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include_once "../componentes/menu.php" ?>
        <div class="col-10">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <h5 class="text-primary roboto-condensed"><img src="../../images/box.png" alt="" class="img-fluid"
                                                                   width="40">
                        Alterar</h5>
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="e_estoque.php?idp=<?= $_GET['idp'] ?>">Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="v_lote_validade.php?idp=<?= $_GET['idp'] ?>">Lote & Validade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                           href="v_prod_fornecedores.php?idp=<?= $_GET['idp'] ?>">Fornecedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="v_prod_historico.php?idp=<?= $_GET['idp'] ?>">Histórico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="v_transacoes.php?idp=<?= $_GET['idp'] ?>">Transações</a>
                    </li>
                </ul>
                <?php if ($_SESSION['user'] == 'compras.hvu'): ?>
                    <form class="form-inline mt-5" method="POST"
                          action="../../back/response/estoque/n_prod_fornecedor.php">
                        <input type="hidden" value="<?= $_GET['idp'] ?>" name="produto">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Fornecedor</label>
                        <select class="custom-select my-1 mr-sm-2 col-5" name="fornecedor"
                                id="inlineFormCustomSelectPref">
                            <option selected></option>
                            <?php
                            require_once('../../back/controllers/FornecedorController.php');
                            $f = new FornecedorController();
                            $fornecedores = $f->verFornecedores();
                            foreach ($fornecedores as $listf) {
                                ?>
                                <option value="<?= $listf->id_fornecedor ?>"><?= $listf->nome_fornecedor ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="btn btn-primary my-1 text-white shadow">Cadastrar</button>
                    </form>

                    <div class="mt-5">
                        <h4 class="roboto-condensed text-secondary"><i class="fas fa-calendar-week"></i> Fornecedores
                        </h4>
                        <ul class="list-group">
                            <?php
                            require '../../back/controllers/EstoqueController.php';
                            $forProdutor = new EstoqueController();
                            $for = $forProdutor->searchFornecedorProduto($_GET['idp']);

                            foreach ($for as $value) {
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= $value->nome_fornecedor ?>
                                    <a href="../../back/response/estoque/d_fornecedor_prod.php?idpf=<?= $value->idfp ?>">
                                        <span class="badge badge-pill far fa-window-close text-danger float-right"> </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="../../node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
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