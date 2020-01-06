<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
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
        <h3 class="exo titulo-1 mt-5">Relatório de produtos <i class="fas fa-clipboard-check color-icon"></i></h3>
        <hr class="bg-nav">
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="exampleFormControlSelect1">Produto / Material</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="id_produto">
                        <option value=""></option>
                        <?php
                        require_once('back/crud/farmaciaCRUD.php');
                        $estoque = new FarmaciaCRUD();
                        $ver_estoque = $estoque->verEstoque();
                        foreach ($ver_estoque as $v) {
                        ?>
                            <?php echo "<option value=" . $v->id_estoque . ">$v->produto_e</option>" ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="exampleFormControlSelect1">Setor</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="setor">
                        <option></option>
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
                <div class="form-group col-md-2">
                    <label for="inputEmail4" class="exo">Data Inicial</label>
                    <input type="date" class="form-control" name="dataI" id="inputEmail4" placeholder="">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4" class="exo">Data Final</label>
                    <input type="date" class="form-control" name="dataF" id="inputPassword4" placeholder="">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn bg-color-btn comfortaa btn-baixo">Gerar <i class="fas fa-sticky-note"></i></button>
                    </[div>
                </div>
        </form>
    </div>
    <div class="container">
        <?php
        require_once('back/crud/farmaciaCRUD.php');
        $p = new FarmaciaCRUD();
        if (!empty($_POST['id_produto']) and !empty($_POST['setor']) and !empty($_POST['dataI']) and !empty($_POST['dataF'])) {
            $search_prod = $p->pega_nome($_POST['id_produto']);/* Pega o produto no estoque */
            $pega_saida = $p->pega_saida($_POST['id_produto'], $_POST['setor'],$_POST['dataI'],$_POST['dataF']);/* Pega o produto no estoque */
            $produto =  (object) $search_prod;
            $saida =  (object) $pega_saida;
            $quantidade_total = 0;
            foreach ($saida as $a) {
                $quantidade_total += $a->quantidade_s;
            }
            $valor_total = $quantidade_total * $produto->valor_un;

        ?>
            <table class="table table-hover text-center exo animated zoomIn">
                <thead>
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Quantidade Total</th>
                        <th scope="col">Valor Unitário</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Data Inicial</th>
                        <th scope="col">Data Final</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$produto->produto?></td>
                        <td><?=$quantidade_total?></td>
                        <td>R$ <?=$produto->valor_un?></td>
                        <td>R$ <?=$valor_total?></td>
                        <td><?=str_replace("-"," ",$_POST['setor']) ?></td>
                        <td><?=date("d/m/Y", strtotime($_POST['dataI']));?></td>
                        <td><?=date("d/m/Y", strtotime($_POST['dataF']));?></td>
                    </tr>
                </tbody>
            </table>

        <?php
        } elseif (empty($_POST['id_produto']) and !empty($_POST['setor']) and empty($_POST['dataI']) and empty($_POST['dataF'])) {
            // $r->relatorio1($_POST['setor'], true);

        }
        ?>
    </div>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>