<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('back/crud/configCRUD.php');
$s = new ConfigCRUD();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css" />
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="images/fire.png" />
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include_once "widget/menu.php" ?>
            <div class="col-9">
                <div class="">
                    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                        <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
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
                    <div class="mt-5 roboto-condensed">
                        <form method="POST" action="">
                            <div class="form-row">
                                <div class="form-group col-sm-4">
                                    <label for="exampleFormControlSelect1">Produto / Material</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="id_produto">
                                        <option value=""></option>
                                        <?php
                                        require_once('back/crud/bhCRUD.php');
                                        $estoque = new BhCRUD();
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
                                    <button type="submit" class="btn bg-primary text-white btn-baixo">Gerar <i class="fas fa-sticky-note"></i></button>
                                    </[div>
                                </div>
                        </form>
                        <div class="container">
                            <?php
                            require_once('back/crud/bhCRUD.php');
                            $p = new BhCRUD();
                            if (!empty($_POST['id_produto']) and !empty($_POST['setor']) and !empty($_POST['dataI']) and !empty($_POST['dataF'])) {
                                $search_prod = $p->pega_nome($_POST['id_produto']);/* Pega o produto no estoque */
                                $pega_saida = $p->pega_saida($_POST['id_produto'], $_POST['setor'], $_POST['dataI'], $_POST['dataF']);/* Pega o produto no estoque */
                                $produto =  (object) $search_prod;
                                $saida =  (object) $pega_saida;
                                $quantidade_total = 0;
                                foreach ($saida as $a) {
                                    $quantidade_total += $a->quantidade_s;
                                }
                                @$valor_total = @$quantidade_total * @$produto->valor_un;

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
                                            <td><?= $produto->produto ?></td>
                                            <td><?= $quantidade_total ?></td>
                                            <td>R$ <?= $produto->valor_un ?></td>
                                            <td>R$ <?= $valor_total ?></td>
                                            <td><?= str_replace("-", " ", $_POST['setor']) ?></td>
                                            <td><?= date("d/m/Y", strtotime($_POST['dataI'])); ?></td>
                                            <td><?= date("d/m/Y", strtotime($_POST['dataF'])); ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                            <?php
                            } elseif (empty($_POST['id_produto']) and !empty($_POST['setor']) and empty($_POST['dataI']) and empty($_POST['dataF'])) {
                                // $r->relatorio1($_POST['setor'], true);

                            }
                            ?>
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
</body>

</html>