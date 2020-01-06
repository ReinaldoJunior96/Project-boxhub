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
        <h3 class="exo titulo-1 mt-5">CADASTRO DE PRODUTO <i class="fas fa-box color-icon"></i>
            <button type="button" class="btn bg-color-btn float-right exo" data-toggle="modal" data-target="#modalExemplo">
                <?php
                require_once('back/crud/farmaciaCRUD.php');
                $f = new FarmaciaCRUD();
                $alert = $f->contar_notificacao();
                ?>
                <i class="fas fa-bell text-white"></i> &nbsp<span class="badge badge-light"><?= $alert ?></span>
            </button>
        </h3>

        <hr class="bg-nav mt-4">
        <form method="POST" action="back/response/estoque_r.php">
            <input type="hidden" name="new" value="1">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="exo">Produto</label>
                    <input type="text" class="form-control" name="produto_e" id="inputEmail4" placeholder="">
                </div>
                <div class="col-md-2">
                    <label for="inputEmail4" class="exo">Valor</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-color-btn text-light exo">R$</div>
                        </div>
                        <input type="text" class="form-control" name="valor_un" id="" onkeyup="SubstituiVirgulaPorPonto(this)" placeholder="">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputEmail4" class="exo">Quantidade</label>
                    <input type="text" class="form-control" name="quantidade_e" id="inputEmail4" placeholder="">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputEmail4" class="exo">Estoque Mínimo</label>
                    <input type="text" class="form-control" name="estoque_minimo_e" id="inputEmail4" placeholder="">
                </div>
            </div>
            <div class="form-row">                
                <div class="form-group col-sm-4">
                    <label for="exampleFormControlSelect1">Categoria</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="categoria_e">
                        <option value="">Escolher...</option>
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
                <div class="form-group col-sm-4">
                    <label for="exampleFormControlSelect1">Unidade de medida</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="unidade_e">
                        <option value="">Escolher...</option>
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
                <div class="form-group col-sm-4">
                    <label for="exampleFormControlSelect1">Marca</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="marca_e">
                        <option value="">Escolher...</option>
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
            <button type="submit" class="btn bg-color-btn col-sm-2 exo mt-1">Novo Produto <i class="fas fa-plus ml-2"></i></button>
        </form>
    </div>
    <div class="container mt-5">
        <table id="example" class="table table-sm xo text-center">
            <thead class="bg-shadow-it bg-table">
                <tr class="text-light">
                    <th class="">Cod.</th>
                    <th class="">Produto / Meterial</th>
                    <th class="">Quantidade</th>
                    <th class="">Valor (UN)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('back/crud/farmaciaCRUD.php');
                $view_estoque = new FarmaciaCRUD();
                $all_estoque = $view_estoque->verEstoque();
                foreach ($all_estoque as $v) {
                ?>
                    <tr>
                        <td><?= $v->id_estoque ?></td>
                        <?php echo "<td><a class='link' href=e_estoque_farma.php?idp=" . $v->id_estoque . ">$v->produto_e</td>"; ?>
                        <td><?= $v->quantidade_e ?></td>
                        <td>R$ <?= $v->valor_un_e ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <img src="images/avatar.jpg" class="rounded-circle float-left mt-3" width="45" height="40" alt="...">
                <p class="exo ml-4 mt-3">Olá, tudo bem? eu sou o Reginaldo, tenho aqui alguns avisos para você &#128516;<p>
                    <!-- <h5 class="modal-title exo titulo-notificacao" id="exampleModalLabel"><i class="fas fa-bell"></i> Avisos</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    require_once('back/crud/farmaciaCRUD.php');
                    $c = new FarmaciaCRUD();
                    $notificacoes = $c->ver_notificacoes();
                    foreach ($notificacoes as $c) {
                    ?>
                        <div class="shadow-lg p-1 mb-1 rounded exo notificacao align-self-center">
                            
                            <img src="images/avatar.jpg" class="rounded-circle float-left mt-3 mr-3 ml-2" width="45" height="40" alt="...">
                            <p class="exo align-self-center mt-3">
                                O seu produto/material <strong class="font-weight-bold"><?=$c->produto_e?></strong> está com quantitativo baixo, que repor ?</p>
                        </div>
                    <?php } ?>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar mudanças</button>
                </div> -->
            </div>
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