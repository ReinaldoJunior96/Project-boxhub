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
                        <a class="nav-link active" href="e_estoque.php?idp=<?= $_GET['idp'] ?>">Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="v_lote_validade.php?idp=<?= $_GET['idp'] ?>">Lote & Validade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="v_prod_fornecedores.php?idp=<?= $_GET['idp'] ?>">Fornecedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="v_prod_historico.php?idp=<?= $_GET['idp'] ?>">Histórico</a>
                    </li>
                </ul>
                <div class="mt-5">

                    <?php
                    require_once '../../back/controllers/EstoqueController.php';
                    $p = new EstoqueController();
                    $produtos = $p->estoqueID($_GET['idp']);
                    foreach ($produtos as $v) {
                        ?>
                        <form method="POST" action="../../back/response/estoque/estoque_r.php">
                            <input type="hidden" name="edit" value="1">
                            <input type="hidden" name="id" value="<?= $_GET['idp'] ?>">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Principio Ativo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="p_ativo" value="<?= $v->principio_ativo ?>"
                                           class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nome Comercial /
                                    Material</label>
                                <div class="col-sm-6">
                                    <input type='text' class='form-control' value="<?= $v->produto_e ?>"
                                           name='produto_e' placeholder=''>
                                </div>
                                <label for="inputEmail3"
                                       class="col-sm-2 col-form-label text-right">Concentração:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" value="<?= $v->concentracao ?>"
                                           name="concentracao" id="inputEmail4">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Apresentação</label>
                                <div class="col-sm-4">
                                    <input type='text' class='form-control' value="<?= $v->apresentacao ?>"
                                           name='apresentacao' placeholder=''>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Forma
                                    Farmacêutica</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="<?= $v->forma_farmaceutica ?>"
                                           name="forma_farmaceutica" id="inputEmail4"
                                           placeholder="">
                                </div>
                            </div>

                            <hr>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Valor Unitário</label>
                                <div class="col-sm-2">
                                    <?php if ($_SESSION['user'] == 'compras.hvu') { ?>
                                        <input type='text' class='form-control' value="<?= $v->valor_un_e ?>"
                                               name='valor_un' placeholder='R$'>
                                        <small class="roboto-condensed">Ex: 24.23 / 1253.65 / 14256.25</small>
                                    <?php } else { ?>
                                        <input type='hidden' class='form-control ' name='valor_un'
                                               placeholder='' value="<?= $v->valor_un_e ?>"
                                        >
                                    <?php } ?>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Quantidade</label>
                                <div class="col-sm-2">
                                    <?php if ($_SESSION['user'] == 'compras.hvu') { ?>
                                        <input type="number" class="form-control" value="<?= $v->quantidade_e ?>"
                                               name="quantidade_e" id="inputEmail4">
                                    <?php } else { ?>
                                        <input type="hidden" class="form-control" value="<?= $v->quantidade_e ?>"
                                               name="quantidade_e" id="inputEmail4">
                                    <?php } ?>

                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Estoque
                                    Mínimo</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" value="<?= $v->estoque_minimo_e ?>"
                                           name="estoque_minimo_e" id="inputEmail4"
                                           placeholder="">
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn bg-primary col-sm-2 roboto-condensed text-white">Alterar <i
                                        class="far fa-edit ml-2"></i>
                            </button>
                            <a href="../../back/response/estoque/d_produto.php?idp=<?= $_GET['idp'] ?>"
                            <button class="btn btn-danger float-right text-white">Excluir
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            </a>
                            <hr>
                        </form>
                    <?php } ?>
                </div>
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