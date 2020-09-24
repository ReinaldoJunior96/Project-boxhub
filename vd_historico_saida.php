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
                    <h5 class="text-primary roboto-condensed"><img src="images/history.png" class="img-fluid" width="40">
                        Histórico</h5>
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
                <div class="">
                    <div class="container">
                        <form method="post" action="">

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Qual setor você
                                    deseja?</label>
                                <div class="col-sm-9">
                                    <select class="form-control col-5" id="exampleFormControlSelect1"
                                            onChange="this.form.submit()" name="filtro">
                                        <option selected></option>
                                        <option class="roboto-condensed" value="">Todos os setores</option>
                                        <?php
                                        require_once('back/crud/configCRUD.php');
                                        $s = new ConfigCRUD();
                                        $setores = $s->ver_setores();
                                        foreach ($setores as $v) {
                                            ?>
                                            <option class="roboto-condensed"
                                                    value="<?= $v->setor_s ?>"><?= str_replace("-", " ", $v->setor_s) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="">
                        <table id="example" class="table table-sm roboto-condensed">
                            <thead class="bg-shadow-it bg-nav">
                            <tr class="text-light text-center">
                                <th class="">Produto / Meterial</th>
                                <th class="">Quantidade</th>
                                <th class="">Setor</th>
                                <th class="">Data / Hora</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once('back/crud/bhCRUD.php');
                            $view_historico = new BhCRUD();
                            // $historico = $view_historico->historico_saida();
                            if (empty($_POST['filtro'])) {
                                $historico = $view_historico->historico_saida();
                            } elseif (!empty($_POST['filtro'])) {
                                $historico = $view_historico->filtro_historico($_POST['filtro']);
                            }
                            foreach ($historico as $v) {
                                ?>
                                <tr class="text-center">
                                    <td><?= $v->produto_e ?></td>
                                    <td><?= $v->quantidade_s ?></td>
                                    <td><?= str_replace("-", " ", $v->setor_s) ?></td>
                                    <td><?= date("d/m/Y H:i:s", strtotime($v->data_s)); ?></td>
                                    <?php echo "<td><a href=back/response/d_saida_r.php?idsaida=" . $v->id_saida . "&prod=" . $v->item_s . "&qtde=" . $v->quantidade_s . "><i class='fas fa-ban fa-lg' style='color: red;'></i></a></td>" ?>
                                </tr>
                            <?php } ?>
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
<!-- <script type='text/javascript'>
    (function() {
        if (window.localStorage) {
            if (!localStorage.getItem('firstLoad')) {
                localStorage['firstLoad'] = true;
                window.location.reload();
            } else
                localStorage.removeItem('firstLoad');
        }
    })();
</script> -->
</body>

</html>