<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: ../user/login.php");
}
require_once('../../back/controllers/configCRUD.php');
$s = new ConfigCRUD();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="../../css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="../../images/fire.png"/>
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include_once "../componentes/menu.php" ?>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- <a class="navbar-brand text-white roboto-condensed" href="#">
                        <i class="fas fa-box-open text-primary"></i>
                    </a> -->
                    <h5 class="text-primary roboto-condensed"><img src="../../images/report.png" class="img-fluid" width="40">
                        Relatório</h5>
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
                <div class="mt-2 roboto-condensed">
                    <form method="POST" action="">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Produto / Material</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="exampleFormControlSelect1" name="id_produto">
                                    <option value=""></option>
                                    <?php
                                    require_once('../../back/controllers/EstoqueController.php');
                                    $estoque = new EstoqueController();
                                    $ver_estoque = $estoque->verEstoque();
                                    foreach ($ver_estoque as $v) {
                                        ?>
                                        <?php echo "<option value=" . $v->id_estoque . ">$v->produto_e</option>" ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-1 col-form-label text-right">Setor</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="exampleFormControlSelect1" name="setor">
                                    <option></option>
                                    <?php
                                    require_once('../../back/controllers/configCRUD.php');
                                    $s = new ConfigCRUD();
                                    $setores = $s->ver_setores();
                                    foreach ($setores as $v) {
                                        ?>
                                        <option value="<?= $v->setor_s ?>"><?= str_replace("-", " ", $v->setor_s) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Data Inicial</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="dataI" id="inputEmail4" placeholder="">
                            </div>
                            <label for="inputEmail3" class="col-sm-1 col-form-label text-right">Data Final</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="dataF" id="inputPassword4" placeholder="">
                            </div>
                        </div>
                        <button type="submit" class="btn bg-secondary text-white  col-2">Gerar
                            <i class="fas fa-sticky-note"></i></button>
                    </form>
                    <div class="container mt-2 roboto-condensed">
                        <?php
                        require_once('../../back/controllers/EstoqueController.php');
                        $p = new EstoqueController();
                        if (!empty($_POST['id_produto']) and !empty($_POST['setor']) and !empty($_POST['dataI']) and !empty($_POST['dataF'])) {
                            $search_prod = $p->pega_nome($_POST['id_produto']);/* Pega o produto no estoque */
                            $pega_saida = $p->pega_saida($_POST['id_produto'], $_POST['setor'], $_POST['dataI'], $_POST['dataF']);/* Pega o produto no estoque */
                            $produto = (object)$search_prod;
                            $saida = (object)$pega_saida;
                            $quantidade_total = 0;
                            foreach ($saida as $a) {
                                $quantidade_total += $a->quantidade_s;
                            }
                            @$valor_total = @$quantidade_total * @$produto->valor_un;

                            ?>
                            <table class="table table-hover text-center animated zoomIn">
                                <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade Total</th>
                                    <th scope="col">Setor</th>
                                    <th scope="col">Data Inicial</th>
                                    <th scope="col">Data Final</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $produto->produto ?></td>
                                    <td><?= $quantidade_total ?></td>
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
<script src="../../node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>