<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('back/crud/configCRUD.php');
$s = new ConfigCRUD();
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
    <title>Box Hub</title>
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
                            <a href="#" class="badge badge-secondary"><i class="fas fa-bell text-white"></i> <span class="badge text-white">5</span></a>
                        </div>
                    </div>
                </nav>
                <div class="mt-4 roboto-condensed">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Fornecedor</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <small class="text-black-50">Caso a data não seja preenchida, entrará como o dia presente. </small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Data</label>
                                <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Novo <i class="fas fa-plus"></i></button>
                    </form>
                </div>
                <hr>
                <div class="">
                    <div class="container mt-5 ">
                        <table id="example" class="table table-sm text-center roboto-condensed">
                            <thead class="bg-shadow-it bg-primary">
                                <tr class="text-light ">
                                    <th class=""></th>
                                    <th class="">Fornecedr</th>
                                    <th class="">Data</th>
                                </tr>
                            </thead>
                            <tbody class="text-black-50">
                                <th class="">4JK3341</th>
                                <th class="">Castro Comércio</th>
                                <th class="">16/09/2020</th>
                            </tbody>
                        </table>
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