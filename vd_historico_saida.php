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
        <form method="post" action="">
            <div class="form-group mt-5">
                <label for="exampleFormControlSelect1" class="exo">Qual setor você deseja?</label>
                <select class="form-control" id="exampleFormControlSelect1" onChange="this.form.submit()" name="filtro">
                    <option selected></option>
                    <option value="">Todos os setores</option>
                    <?php
                    require_once('back/crud/configCRUD.php');
                    $s = new ConfigCRUD();
                    $setores = $s->ver_setores();
                    foreach ($setores as $v) {
                        ?>
                        <option value="<?= $v->setor_s ?>"><?= str_replace("-", " ", $v->setor_s) ?></option>
                    <?php } ?>
                </select>
            </div>
        </form>
        <hr class='bg-nav'>
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
                        <td><?= str_replace("-", " ", $v->setor_s)  ?></td>
                        <td><?= date("d/m/Y H:i:s", strtotime($v->data_s)); ?></td>
                        <?php echo "<td><a href=back/response/d_saida_r.php?idsaida=" . $v->id_saida . "&prod=" . $v->item_s . "&qtde=" . $v->quantidade_s . "><i class='fas fa-ban fa-lg' style='color: red;'></i></a></td>" ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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