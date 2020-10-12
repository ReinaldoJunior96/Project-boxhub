<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: ../user/login.php");
}
require_once('../../back/controllers/configCRUD.php');
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
    <link rel="stylesheet" type="text/css" href="../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="../../css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="../../images/fire.png" />
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include_once "../componentes/menu.php" ?>
            <div class="col-10">
                <div class="">
                    <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- <a class="navbar-brand text-white roboto-condensed" href="#">
                        <i class="fas fa-box-open text-primary"></i>
                    </a> -->
                    <h5 class="text-primary roboto-condensed"><img src="../../images/network.png" class="img-fluid" width="40">
                    Setores</h5>
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
                <div class="mt-2">
                    <!-- Adiconar Setores ok -->
                    <div class="container roboto-condensed">
                        <form method="POST" action="../../back/response/config_r.php">
                            <input type="hidden" name="setor" value="1">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Adicionar Setor</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="novo_setor" id="inputEmail4"
                                    placeholder="Nome" required="">                                 
                                </div>
                            </div>
                            <button type="submit" class="btn bg-primary text-white roboto-condensed mb-4 btn-baixo">Adicionar <i class="fas fa-plus"></i></button>
                            </form>
                            <!-- Tabela Setores -->
                            <table id="example" class="table table-sm text-center roboto-condensed">
                                <thead class="bg-nav">
                                    <tr class="text-light">
                                        <th class="">Código</th>
                                        <th class="">Setor</th>
                                        <th class=""></th>
                                    </tr>
                                </thead>
                                <tbody class="text-black-50">
                                    <?php
                                    require_once('../../back/controllers/configCRUD.php');
                                    $s = new ConfigCRUD();
                                    $setores = $s->ver_setores();
                                    foreach ($setores as $v) {
                                        ?>
                                        <tr>
                                            <td><?= $v->id_setor ?></td>
                                            <td><?= str_replace("-", " ", $v->setor_s) ?></td>
                                            <td><a href="../../back/response/config_r.php?id_setor=<?= $v->id_setor ?>">
                                                <i class='fas fa-ban fa-lg text-primary'></i>
                                            </a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <br><br><br><br>
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
    <script type="text/javascript" src="../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <!--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>-->
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
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Buscar: ",
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