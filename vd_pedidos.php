<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css" />
    <!-- Meu CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Hospital Veterinário</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
        <a class="navbar-brand" href="index.php">
            <img src="images/icon-box.png" width="37" height="32" alt="">
        </a>
        <!-- <a class="navbar-brand exo text-white" href="index.php">Hospital Veterinário</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">


        </div>
        <form class="form-inline">
            <ul class="nav justify-content-end">
                <li class="nav-item active">
                    <a class="nav-link exo text-nav text-white" href="n_nota_fiscal.php"> Entrada <i class="fas fa-cart-arrow-down"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle exo text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Saída <i class="fas fa-arrow-up"></i>
                    </a>
                    <div class="dropdown-menu bg-drop exo border-0 drop-position " aria-labelledby="navbarDropdown">
                        <?php
                        require_once('back/crud/configCRUD.php');
                        $s = new ConfigCRUD();
                        $setores = $s->ver_setores();
                        foreach ($setores as $v) {
                        ?>
                            <?php echo "<a class='dropdown-item font-weight-light' href='n_saida_setor.php?setor=" . $v->id_setor . "&nomesetor=" . str_replace("-", " ", $v->setor_s) . "'>" . str_replace("-", " ", $v->setor_s) . "</a>" ?>
                        <?php } ?>

                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link exo text-white" href="nv_estoque.php">Estoque <i class="fas fa-box-open"></i></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link exo text-white" href="n_relatorio.php">Relatórios <i class="fas fa-file-alt"></i></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link exo text-white" href="vd_pedidos.php">Pedidos <i class="fas fa-ticket-alt"></i></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link exo text-white" href="config_farma.php">Configurações <i class="fas fa-cog"></i></a>
                </li>
            </ul>
        </form>
    </nav>
    <div class="container">        
        <div class="row d-flex justify-content-center">
            <img src="images/construct.png" class="img-fluid col-sm-8" alt="Imagem responsiva">
        </div>
        <div class="row text-center mt-4">
            <h3 class="comfortaa col-sm-12">Estamos trabalhando para você</h3>
        </div>
    </div>
    <!-- <div class="container">
        <h3 class='exo titulo-1 mt-5'>Pedidos pendentes <i class="fas fa-ticket-alt mt-2 color-icon"></i><a href='vd_historico_saida.php' class='link-basico float-right'>Histórico de pedidos <i class='fas fa-history '></i></a></h3>
        <hr class='bg-nav'>
    </div> -->
    <div class="container mt-5 ">

        <!-- <table id="example" class="table table-sm exo text-center">
                <thead class="bg-shadow-it bg-table">
                    <tr class="text-light">
                        <th class="">Cod.</th>
                        <th class="">Item</th>
                        <th class="">Quantidade</th>
                        <th class="">Setor</th>
                        <th class="">Data</th>
                        <th class="">Solicitante</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('back/crud/farmaciaCRUD.php');
                    $view_pedidos = new FarmaciaCRUD();
                    $pedidos = $view_pedidos->v_pedidos();
                    foreach ($pedidos as $v) {
                    ?>
                        <tr>
                            <td><?= $v->id_req ?></td>
                            <td><?= $v->produto_e ?></td>
                            <td><?= $v->qtde_req ?></td>
                            <td><?= $v->setor_req ?></td>
                            <td><?= date("d/m/Y H:i:s", strtotime($v->data_req)) ?></td>
                            <td><?= $v->solicitante_req ?></td>
                            <td> <?php echo "<a href=back/response/pedidos_r.php?id=" . $v->id_req . "&p=aceitar&ide=" . $v->item_req . " class='badge badge-success'><i class='fas fa-check-square'></i></a></td>"; ?>
                            <td> <?php echo "<a href=back/response/pedidos_r.php?id=" . $v->id_req . "&p=cancelar class='badge badge-danger'><i class='fas fa-minus-square'></i></a></td>"; ?>
                        </tr>

                    <?php } ?>
                </tbody>
            </table> -->
    </div>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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