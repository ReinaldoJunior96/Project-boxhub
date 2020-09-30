<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('back/controllers/configCRUD.php');
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
        <?php include_once "componentes/menu.php" ?>
        <div class="col-10">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- <a class="navbar-brand text-white roboto-condensed" href="#">
                        <i class="fas fa-box-open text-primary"></i>
                    </a> -->
                    <h5 class="text-primary roboto-condensed"><img src="images/grupo.png" class="img-fluid" width="40">
                        Fornecedores</h5>
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
                        <form method="POST" action="back/response/fornecedores_n.php">
                            <input type="hidden" name="new" value="1">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label text-center">Adicionar
                                    Fornecedor</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="fornecedor" id="inputEmail4"
                                           placeholder="Nome" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label text-center">Telefone(s)</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="telefone_fornecedor" id="inputEmail4"
                                           placeholder="Contato" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label text-center">E-mail</label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" name="email_fornecedor" id="inputEmail4"
                                           placeholder="E-mail" required="">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-3  d-flex justify-content-center">
                                    <button type="submit" class="btn bg-primary text-white roboto-condensed mb-4">
                                        Adicionar <i class="fas fa-plus"></i></button>
                                </div>

                            </div>

                        </form>
                        <!-- Tabela Setores -->
                        <table id="example" class="table table-sm text-center roboto-condensed">
                            <thead class="bg-nav">
                            <tr class="text-light">
                                <th class="">Código</th>
                                <th class="">Fornecedor</th>
                                <th class=""></th>
                                <th class=""></th>
                            </tr>
                            </thead>
                            <tbody class="text-black-50">
                            <?php
                            require_once('back/controllers/FornecedorController.php');
                            $f = new FornecedorController();
                            $fornecedores = $f->verFornecedores();
                            foreach ($fornecedores as $v) {
                                ?>
                                <tr>
                                    <td><?= $v->id_fornecedor ?></td>
                                    <td><?=  $v->nome_fornecedor?></td>
                                    <?php echo "<td><a href=e_fornecedor.php?idfornecedor=" . $v->id_fornecedor . "><i class='fas fa-pen fa-1x color-icon-nf text-primary'></i></a></td>" ?>
                                    <?php echo "<td><a href=back/response/d_fornecedor.php?idfornecedor=" . $v->id_fornecedor . "><i class='fas fa-trash-alt fa-1x text-danger'></i></a></td>" ?>
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
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
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