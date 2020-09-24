<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('back/crud/configCRUD.php');
$s = new ConfigCRUD();
switch ($_SESSION['user']) {
    case 'tatiane_a.hvu':
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
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="images/fire.png" />
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include_once "widget/menu.php"?>
            <div class="col-9">
                <div class="">
                    <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- <a class="navbar-brand text-white roboto-condensed" href="#">
                        <i class="fas fa-box-open text-primary"></i>
                    </a> -->
                    <h5 class="text-primary roboto-condensed"><img src="images/stock.png" class="img-fluid" width="40"> Estoque</h5>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado"
                    aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div class="form-inline my-2 my-lg-0">
                        <h6 class="text-black-50 roboto-condensed"><i class="fas fa-user text-primary"></i> <?=$_SESSION['user']?></h6>
                    </div>
                </div>
            </nav>
            <div class=" roboto-condensed p-3">
                <form method="POST" action="back/response/estoque_r.php">
                    <input type="hidden" name="new" value="1">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Produto / Material</label>
                        <div class="col-sm-10">
                          <input type="text" name="produto_e" class="form-control" id="inputEmail3" required="">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Valor Unitário</label>
                    <div class="col-sm-2">
                        <?php if ($_SESSION['user'] == 'compras.hvu') { ?>
                            <input type='text' class='form-control ' name='valor_un' placeholder='R$'>
                            <small>Utilize ponto no lugar da vírgula</small>
                        <?php } else { ?>
                            <input type='text' class='form-control ' name='valor_un' placeholder=''
                            disabled>
                        <?php } ?>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Quantidade</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" name="quantidade_e" id="inputEmail4"
                      placeholder="">
                  </div>

                  <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Estoque Mínimo</label>
                  <div class="col-sm-2">
                      <input type="number" class="form-control" name="estoque_minimo_e" id="inputEmail4"
                      placeholder="">
                  </div>
              </div>              
                        <!--<div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="exampleFormControlSelect1">Categoria</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="categoria_e">
                                    <option value="">Escolher...</option>
                                    <?php
                        /*                                    require_once('back/crud/configCRUD.php');
                                                            $c = new ConfigCRUD();
                                                            $categorias = $c->ver_categoria();
                                                            foreach ($categorias as $c) {
                                                                */ ?>
                                        <?php /*echo "<option value=$c->categoria_c>" . str_replace("-", " ", $c->categoria_c) . "</option>" */ ?>
                                    <?php /*} */ ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleFormControlSelect1">Unidade de medida</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="unidade_e">
                                    <option value="">Escolher...</option>
                                    <?php
                        /*                                    require_once('back/crud/configCRUD.php');
                                                            $un = new ConfigCRUD();
                                                            $uni_medida = $un->ver_UNM();
                                                            foreach ($uni_medida as $un) {
                                                                */ ?>
                                        <?php /*echo "<option value=$un->un_medida>" . str_replace("-", " ", $un->un_medida) . "</option>" */ ?>
                                    <?php /*} */ ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleFormControlSelect1">Marca</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="marca_e">
                                    <option value="">Escolher...</option>
                                    <?php
                        /*                                    require_once('back/crud/configCRUD.php');
                                                            $m = new ConfigCRUD();
                                                            $marca = $m->ver_marcas();
                                                            foreach ($marca as $m) {
                                                                */ ?>
                                        <?php /*echo "<option value=$m->marca_m>" . str_replace("-", " ", $m->marca_m) . "</option>" */ ?>
                                    <?php /*} */ ?>
                                </select>
                            </div>
                        </div>-->
                        <button type="submit" class="btn bg-primary shadow col-sm-2 exo mt-1 text-white">Novo Produto <i
                            class="fas fa-plus ml-2"></i></button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="container mt-5 ">
                    <table id="example" class="table table-sm text-center roboto-condensed">
                        <thead class="bg-shadow-it bg-nav">
                            <tr class="text-light ">
                                <th class="">Código</th>
                                <th class="">Produto / Material</th>
                                <th class="">Quantidade</th>
                                <th class="">Estoque Mínimo</th>
                                <th class="">Valor Unitário</th>
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
                                    <td><?= $v->id_estoque ?></td>
                                    <?php echo "<td><a class='text-secondary' style='text-decoration: none' href=e_estoque_farma.php?idp=" . $v->id_estoque . ">$v->produto_e</td>"; ?>
                                    <td><?= $v->quantidade_e ?></td>
                                    <td><?= $v->estoque_minimo_e ?></td>

                                    <td><?= ($permissao == 'disabled') ? '*****' : 'R$' . $v->valor_un_e ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br><br><br><br>
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