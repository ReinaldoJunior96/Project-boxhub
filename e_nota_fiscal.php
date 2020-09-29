<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('back/controllers/configCRUD.php');
$s = new ConfigCRUD();
switch ($_SESSION['user']) {
    case 'farma.hvu':
        $permissao = 'isDisabled';
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
        <?php include_once "componentes/menu.php" ?>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- <a class="navbar-brand text-white roboto-condensed" href="#">
                        <i class="fas fa-box-open text-primary"></i>
                    </a> -->
                    <h5 class="text-primary roboto-condensed"><img src="images/document.png" class="img-fluid"
                                                                   width="40">
                        Alterar</h5>
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
                <div class="roboto-condensed">
                    <div class="container mt-3">
                        <?php
                        require_once('back/controllers/bhCRUD.php');
                        $new_nf = new BhCRUD();
                        $ver_nf = $new_nf->findID($_GET['idnf']);
                        foreach ($ver_nf as $v) {
                            ?>
                            <form method="POST" action="back/response/nota_fiscal_r.php">
                                <input type="hidden" name="tipo" value="edit">
                                <input type="hidden" name="idnf" value="<?= $_GET['idnf'] ?>">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4" class="exo">Número da NF</label>
                                        <input type="text" class="form-control" value="<?= $v->numero_nf ?>"
                                               name="numero_nf" id="inputEmail4" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4" class="exo">Data de Emissão</label>
                                        <input type="date" class="form-control" value="<?= $v->data_emissao ?>"
                                               name="datae_nf" id="inputEmail4" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4" class="exo">Data de Lançamento</label>
                                        <input type="date" class="form-control" value="<?= $v->data_lancamento ?>"
                                               name="datal_nf" id="inputPassword4" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputEmail4" class="exo">Fornecedor</label>
                                        <input type="text" class="form-control" value="<?= $v->fornecedor ?>"
                                               name="fornecedor_nf" id="inputEmail4" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4" class="exo">Valor (R$)</label>
                                        <input type="text" class="form-control" value="<?= $v->valor_nf ?>"
                                               name="valor_nf" id="" onkeyup="SubstituiVirgulaPorPonto(this)"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label for="exampleFormControlTextarea1">Observação</label>
                                        <textarea class="form-control" name="obs_nf" id="exampleFormControlTextarea1"
                                                  rows="3"><?= $v->obs_nf ?></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn bg-primary text-white col-sm-2 roboto-condensed mt-1">Alterar <i
                                            class="fas fa-pen"></i>
                            </form>
                        <?php } ?>
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
<script type='text/javascript'>
    (function () {
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