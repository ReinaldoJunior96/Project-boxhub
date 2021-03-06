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
                        <a class="nav-link" href="e_estoque.php?idp=<?= $_GET['idp'] ?>">Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="v_lote_validade.php?idp=<?= $_GET['idp'] ?>">Lote & Validade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="v_prod_fornecedores.php?idp=<?= $_GET['idp'] ?>">Fornecedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="v_prod_historico.php?idp=<?= $_GET['idp'] ?>">Histórico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="v_transacoes.php?idp=<?= $_GET['idp'] ?>">Transações</a>
                    </li>
                </ul>
                <?php
                require_once '../../back/controllers/EstoqueController.php';
                $p = new EstoqueController();
                $hist = $p->searchTransacoes($_GET['idp']);
                ?>
                <div class=" mt-3">
                    <div class="col-12">
                        <table class="table table-sm text-center">
                            <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Estoque Inicial</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Estoque Final</th>
                                <th scope="col">Saída Cancelada</th>
                                <th scope="col">Realizada Por</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($hist as $historico) {
                                $data = date_create($historico->data_t);
                                $dataCancelamento = date_create($historico->cancelada_t);
                                ?>
                                <tr>
                                    <td scope="row"><?= date_format($data, 'd/m/Y H:i:s') ?></td>
                                    <td><?= $historico->tipo_t ?></td>
                                    <td><?= $historico->estoqueini_t ?></td>
                                    <td><?= $historico->quantidade_t ?></td>
                                    <td><?= $historico->estoquefi_t ?></td>
                                    <td><?= $historico->cancelada_t ?></td>
                                    <td><?= $historico->realizadapor_t ?></td>
                                </tr>
                            <?php }?>
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