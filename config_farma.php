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
    <title>boxhub</title>
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

    <!-- Adiconar Setores ok -->
    <div class="container">
        <h3 class="exo titulo-1 mt-5">Configurações <i class="fas fa-cog color-roxo"></i></h3>
        <hr class="bg-nav">
        <h3 class="exo titulo-1 mt-5">Adicionar Setores</h3>
        <hr class="bg-nav">
        <form method="POST" action="back/response/config_r.php">
            <input type="hidden" name="setor" value="1">
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="exampleFormControlSelect1">Novo Setor</label>
                    <input type="text" class="form-control" name="novo_setor" id="inputEmail4" placeholder="" required="">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn bg-color-roxo comfortaa btn-baixo">Adicionar <i class="fas fa-plus"></i></button>
                </div>
            </div>
        </form>
        <!-- Tabela Setores -->
        <div class="row mx-auto">
            <table id="example" class="table table-striped exo text-center col-sm-4">
                <thead class="bg-shadow-it bg-table">
                    <tr class="">
                        <th class="">Setores</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('back/crud/configCRUD.php');
                    $s = new ConfigCRUD();
                    $setores = $s->ver_setores();
                    foreach ($setores as $v) {
                        ?>
                        <tr>
                            <?php echo "<td class=''>" . str_replace("-", " ", $v->setor_s) . "</td>" ?>
                            <?php echo "<td><a href=back/response/config_r.php?id_setor=" . $v->id_setor . "><i class='fas fa-ban fa-lg' style='color: red;'></i></a></td>" ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Adiconar Marca -->
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
                    <button type="submit" class="btn bg-color-roxo comfortaa btn-baixo">Adicionar <i class="fas fa-plus"></i></button>
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

    <!-- Adiconar Unidade de Medida -->
    <div class="container mt-3">
        <h3 class="exo titulo-1 mt-5">Adicionar Unidade de Medida</h3>
        <hr class="bg-nav">
        <form method="POST" action="back/response/config_r.php">
            <input type="hidden" name="uni_medida" value="1">
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="exampleFormControlSelect1">Unidade de Medida</label>
                    <input type="text" class="form-control" name="nova_uni_medida" id="inputEmail4" placeholder="" required="">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn bg-color-roxo comfortaa btn-baixo">Adicionar <i class="fas fa-plus"></i></button>
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

    <!-- Adiconar Categoria -->
    <div class="container mt-3">
        <h3 class="exo titulo-1 mt-5">Adicionar Categoria</h3>
        <hr class="bg-nav">
        <form method="POST" action="back/response/config_r.php">
            <input type="hidden" name="categoria" value="1">
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="exampleFormControlSelect1">Categoria</label>
                    <input type="text" class="form-control" name="nova_categoria" id="inputEmail4" placeholder="" required="">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn bg-color-roxo comfortaa btn-baixo">Adicionar <i class="fas fa-plus"></i></button>
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