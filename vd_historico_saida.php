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
        <div class="col-3">
            <div class="shadow p-3">
                <?php

                ?>
                <div class="text-center">
                    <img src="images/box.png" class="img-fluid mt-2" width="100" alt="Imagem responsiva">
                </div>
                <ul class="list-group mt-5">
                    <a href="n_nota_fiscal.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 <?= $permissao ?>"><i
                                class="fas fa-cart-arrow-down"></i> Entrada</a>
                    <a href="nv_estoque.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0"><i
                                class="fas fa-box-open"></i> Estoque</a>
                    <!-- Botão dropright padrão -->
                    <div class="dropright">
                        <a href="#"
                           class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0"
                           data-toggle="dropdown"><i class="fas fa-external-link-alt"></i> Saída</a>
                        <div class="dropdown-menu">
                            <ul class="list-group border-0">
                                <?php
                                $setores = $s->ver_setores();
                                foreach ($setores as $v) {
                                    ?>
                                    <a href="n_saida_setor.php?setor=<?= $v->id_setor ?>&nomesetor=<?= str_replace("-", " ", $v->setor_s) ?>"
                                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0">
                                        <?= str_replace("-", " ", $v->setor_s) ?>
                                    </a>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <a href="n_relatorio.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 <?= $permissao ?>">Relatórios</a>
                    <a href="vd_pedidos.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 >"><i
                                class="fas fa-ticket-alt"></i> Solicitação</a>
                    <a href="config_farma.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 <?= $permissao ?>"><i
                                class="fas fa-cog"></i> Configurações</a>
                    <a href="back/response/destroy_sessao.php"
                       class="list-group-item list-group-item-action border-top-0 border-right-0 border-left-0 ">Sair</a>
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                    <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i> Box Hub
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
                            <a href="#" class="badge badge-secondary"><i class="fas fa-bell text-white"></i> <span
                                        class="badge text-white">5</span></a>
                        </div>
                    </div>
                </nav>
                <div class="mt-5">
                    <div class="container">
                        <form method="post" action="">
                            <div class="form-group mt-5">
                                <label for="exampleFormControlSelect1" class="roboto-condensed">Qual setor você
                                    deseja?</label>
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
                        </form>
                    </div>
                    <div class="container text-center justify-content-center">
                        <table id="example" class="table table-sm comfortaa">
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
                            require_once('back/crud/farmaciaCRUD.php');
                            $view_historico = new FarmaciaCRUD();
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