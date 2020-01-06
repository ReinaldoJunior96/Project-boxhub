<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Meu CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Hospital Veterinário</title>
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="shadow-lg p-3 mb-5 rounded col-sm-6 mt-5">
            <img src="../images/logo.png" class="rounded mx-auto d-block col-sm-7" alt="...">
            <table id="example" class="table table-sm comfortaa">
                <thead class="bg-shadow-it bg-nav">
                    <tr class="text-light text-center">
                        <th>ID</th>
                        <th class="">Produto / Meterial</th>
                        <th class="">Quantidade</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../crud/requisicao_crud.php');
                    $v = new RequisicaoCRUD();
                    $all_estoque = $v->ver_estoque();
                    foreach ($all_estoque as $v) {
                        ?>
                        <tr class="text-center">
                            <form method="POST" action="../response/requisicao_r.php">
                                <input type="hidden" name="setor" value="<?= $_POST['setor'] ?>">
                                <input type="hidden" name="solicitante" value="<?= $_POST['solicitante'] ?>">
                                <input type="hidden" name="item_solicitado" value="<?= $v->id_estoque ?>">
                                <td><?= $v->id_estoque ?></td>
                                <td><?= $v->produto_e ?></td>
                                <td><input type="number" class="form-control" name="qtde_solicitada" id="inputPassword4" placeholder="" style="text-align: center;"></td>
                                <td><button type="submit" class="btn btn-success comfortaa mt-1">Solicitar <i class="fas fa-sign-out-alt"></i></td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>









    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "",
                    "sInfoEmpty": "",
                    "sInfoFiltered": "",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "<r class='search'>Buscar <i class='fas fa-search'></i></r>",
                    "oPaginate": {
                        "sNext": "",
                        "sPrevious": "",
                        "sFirst": "",
                        "sLast": ""
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