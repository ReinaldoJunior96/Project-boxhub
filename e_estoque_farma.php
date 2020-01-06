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
    <div class="container mt-3">
        <h3 class="exo titulo-1 mt-5">EDITAR PRODUTO <i class="fas fa-pen color-icon"></i></h3>
        <hr class="bg-nav">
        <?php
        require_once 'back/crud/farmaciaCRUD.php';
        $p = new FarmaciaCRUD();
        $produtos = $p->estoqueID($_GET['idp']);
        foreach ($produtos as $v) {
            ?>
            <form method="POST" action="back/response/estoque_r.php">
                <input type="hidden" name="edit" value="1">
                <input type="hidden" name="id" value="<?= $_GET['idp'] ?>">
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="inputEmail4" class="exo">Produto</label>
                        <input type="text" class="form-control" value="<?= $v->produto_e ?>" name="produto_e" id="inputEmail4" placeholder="">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4" class="exo">Valor (UN)</label>
                        <input type="text" class="form-control" value="<?= $v->valor_un_e ?>" name="valor_un" id="inputPassword4" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4" class="exo">Quantidade</label>
                        <input type="text" class="form-control" value="<?= $v->quantidade_e ?>" name="quantidade_e" id="inputEmail4" placeholder="">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="exampleFormControlSelect1">Categoria</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="categoria_e" required="">
                            <?php echo "<option value='$v->categoria_e'>$v->categoria_e</option>"; ?>
                            <?php
                                require_once('back/crud/configCRUD.php');
                                $c = new ConfigCRUD();
                                $categorias = $c->ver_categoria();
                                foreach ($categorias as $c) {
                                    ?>
                                <?php echo "<option value=$c->categoria_c>" . str_replace("-", " ", $c->categoria_c) . "</option>" ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="exampleFormControlSelect1">Unidade de medida</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="unidade_e" required="">
                            <?php echo "<option value='$v->unidade_e'>$v->unidade_e</option>"; ?>
                            <?php
                                require_once('back/crud/configCRUD.php');
                                $un = new ConfigCRUD();
                                $uni_medida = $un->ver_UNM();
                                foreach ($uni_medida as $un) {
                                    ?>
                                <?php echo "<option value=$un->un_medida>" . str_replace("-", " ", $un->un_medida) . "</option>" ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="exampleFormControlSelect1">Marca</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="marca_e" required="">
                            <?php echo "<option value='$v->marca_e'>$v->marca_e</option>"; ?>
                            <?php
                                require_once('back/crud/configCRUD.php');
                                $m = new ConfigCRUD();
                                $marca = $m->ver_marcas();
                                foreach ($marca as $m) {
                                    ?>
                                <?php echo "<option value=$m->marca_m>" . str_replace("-", " ", $m->marca_m) . "</option>" ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">

                </div>
                <button type="submit" class="btn bg-color-btn col-sm-2 exo mt-1">Alterar <i class="far fa-edit ml-2"></i>
            </form>
        <?php } ?>
    </div>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
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