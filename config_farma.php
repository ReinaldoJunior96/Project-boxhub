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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title>Box Hub</title>
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include_once "widget/menu.php"?>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                    <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i>
                        Box Hub / Configurações
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado"
                            aria-expanded="false" aria-label="Alterna navegação">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                        <ul class="navbar-nav mr-auto">

                        </ul>
                        <div class="form-inline my-2 my-lg-0">
                            <!--<a href="#" class="badge badge-secondary"><i class="fas fa-bell text-white"></i> <span
                                        class="badge text-white">5</span></a>-->
                        </div>
                    </div>
                </nav>
                <div class="mt-5">
                    <!-- Adiconar Setores ok -->
                    <div class="container roboto-condensed">
                        <form method="POST" action="back/response/config_r.php">
                            <input type="hidden" name="setor" value="1">
                            <div class="form-row">
                                <div class="form-group col-sm-4">
                                    <label for="exampleFormControlSelect1">Novo Setor</label>
                                    <input type="text" class="form-control" name="novo_setor" id="inputEmail4"
                                           placeholder="" required="">
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn bg-primary text-white roboto-condensed btn-baixo">Adicionar <i
                                                class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </form>
                        <!-- Tabela Setores -->
                        <ul class="list-group col-6">
                            <?php
                            require_once('back/crud/configCRUD.php');
                            $s = new ConfigCRUD();
                            $setores = $s->ver_setores();

                            foreach ($setores as $v) {
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= str_replace("-", " ", $v->setor_s) ?>
                                    <a href="back/response/config_r.php?id_setor=<?= $v->id_setor ?>">
                                        <i class='fas fa-ban fa-lg text-primary'></i>
                                    </a>
                                </li>

                            <?php } ?>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- Adiconar Marca
<div class="container mt-3">
    <h3 class="exo titulo-1 mt-5">Adicionar Marca </h3>
    <hr class="bg-nav">
    <form method="POST" action="back/response/config_r.php">
        <div class="form-row">
            <input type="hidden" name="marca" value="1">
            <div class="form-group col-sm-4">
                <label for="exampleFormControlSelect1">Nova Marca</label>
                <input type="text" class="form-control" name="nova_marca" id="inputEmail4" placeholder="" required="">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn bg-color-roxo comfortaa btn-baixo">Adicionar <i
                            class="fas fa-plus"></i></button>
            </div>
        </div>
    </form>
    <div class="row mx-auto">
        <table id="example" class="table table-striped exo text-center col-sm-5">
            <thead class="bg-shadow-it bg-table">
            <tr class="">
                <th class="">Marcas</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
require_once('back/crud/configCRUD.php');
$m = new ConfigCRUD();
$marca = $m->ver_marcas();
foreach ($marca as $v) {
    ?>
                <tr>
                    <?php echo "<td class=''>" . str_replace("-", " ", $v->marca_m) . "</td>" ?>
                    <?php echo "<td><a href=back/response/config_r.php?idmarca=" . $v->id_marca . "><i class='fas fa-ban fa-lg' style='color: red;'></i></a></td>" ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

 Adiconar Unidade de Medida
<div class="container mt-3">
    <h3 class="exo titulo-1 mt-5">Adicionar Unidade de Medida</h3>
    <hr class="bg-nav">
    <form method="POST" action="back/response/config_r.php">
        <input type="hidden" name="uni_medida" value="1">
        <div class="form-row">
            <div class="form-group col-sm-4">
                <label for="exampleFormControlSelect1">Unidade de Medida</label>
                <input type="text" class="form-control" name="nova_uni_medida" id="inputEmail4" placeholder=""
                       required="">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn bg-color-roxo comfortaa btn-baixo">Adicionar <i
                            class="fas fa-plus"></i></button>
            </div>
        </div>
    </form>
    <div class="row mx-auto">
        <table id="example" class="table table-striped exo text-center col-sm-5">
            <thead class="bg-shadow-it bg-table">
            <tr class="">
                <th class="">Unidade de Medida</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
require_once('back/crud/configCRUD.php');
$m = new ConfigCRUD();
$uni_medida = $m->ver_UNM();
foreach ($uni_medida as $v) {
    ?>
                <tr>
                    <?php echo "<td class=''>" . str_replace("-", " ", $v->un_medida) . "</td>" ?>
                    <?php echo "<td><a href=back/response/config_r.php?idunim=" . $v->id_medidas . "><i class='fas fa-ban fa-lg' style='color: red;'></i></a></td>" ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

 Adiconar Categoria
<div class="container mt-3">
    <h3 class="exo titulo-1 mt-5">Adicionar Categoria</h3>
    <hr class="bg-nav">
    <form method="POST" action="back/response/config_r.php">
        <input type="hidden" name="categoria" value="1">
        <div class="form-row">
            <div class="form-group col-sm-4">
                <label for="exampleFormControlSelect1">Categoria</label>
                <input type="text" class="form-control" name="nova_categoria" id="inputEmail4" placeholder=""
                       required="">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn bg-color-roxo comfortaa btn-baixo">Adicionar <i
                            class="fas fa-plus"></i></button>
            </div>
        </div>
    </form>
    <div class="row mx-auto">
        <table id="example" class="table table-striped exo text-center col-sm-5">
            <thead class="bg-shadow-it bg-table">
            <tr class="">
                <th class="">Unidade de Medida</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
require_once('back/crud/configCRUD.php');
$c = new ConfigCRUD();
$categorias = $c->ver_categoria();
foreach ($categorias as $v) {
    ?>
                <tr>
                    <?php echo "<td class=''>" . str_replace("-", " ", $v->categoria_c) . "</td>" ?>
                    <?php echo "<td><a href=back/response/config_r.php?idcategoria=" . $v->id_categoria . "><i class='fas fa-ban fa-lg' style='color: red;'></i></a></td>" ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div> -->

<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
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
</body>

</html>