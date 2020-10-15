<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('../../back/controllers/configCRUD.php');
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
                    <h5 class="text-primary roboto-condensed"><img src="../../images/document.png" class="img-fluid"
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
                        require_once('../../back/controllers/NotaFController.php');
                        $new_nf = new NotaFController();
                        $ver_nf = $new_nf->verNF($_GET['idnf']);
                        foreach ($ver_nf as $v) {
                            ?>
                            <form method="POST" action="../../back/response/notaf/nota_fiscal_r.php">
                                <input type="hidden" name="tipo" value="edit">
                                <input type="hidden" name="idnf" value="<?= $_GET['idnf'] ?>">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4" class="exo">Número NE/NF</label>
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
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4" class="exo">Fornecedor</label>
                                        <select class="form-control" name="fornecedor_nf">
                                            <option value="<?= $v->fornecedor ?>"><?= $v->fornecedor ?></option>
                                            <?php
                                            require_once('../../back/controllers/FornecedorController.php');
                                            $f = new FornecedorController();
                                            $fornecedores = $f->verFornecedores();
                                            foreach ($fornecedores as $listf) {
                                                ?>
                                                <option value="<?= $listf->nome_fornecedor ?>"><?= $listf->nome_fornecedor ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4" class="exo">Valor total dos produtos R$</label>
                                        <input type="text" class="form-control" value="<?= $v->valor_nf ?>"
                                               name="valor_nf" id=""
                                               placeholder="">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="exo">Desconto</label>
                                        <input type="text" class="form-control" value="<?= $v->desconto ?>"
                                               name="desconto" id=""
                                               placeholder="">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="exo">Frete R$</label>
                                        <input type="text" class="form-control"
                                               name="frete" value="<?= $v->frete ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="exo">Valor Total R$</label>
                                        <input type="text" class="form-control"
                                               name="valor_total" value="<?= $v->valor_total ?>">
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label for="exampleFormControlTextarea1">Observação</label>
                                        <textarea class="form-control" name="obs_nf" id="exampleFormControlTextarea1"
                                                  rows="3"><?= $v->obs_nf ?></textarea>
                                    </div>
                                </div>
                                <div class="form-inline mt-3">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="radio" class="form-check-input" <?=($v->nota_entrega == 0) ? 'checked': ''?> name="info_ne" value="0" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Nota Fiscal</label>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="radio" class="form-check-input" <?=($v->nota_entrega == 1) ? 'checked': ''?> name="info_ne" value="1" id="exampleCheck2">
                                        <label class="form-check-label" for="exampleCheck2">Nota de Entrega</label>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn bg-primary text-white col-sm-2 roboto-condensed mt-1">
                                    Alterar <i class="fas fa-pen"></i>
                                </button>
                                <a href="n_vencimento_parcelas.php?idnf=<?= $_GET['idnf'] ?>"
                                <button class="btn btn-outline-secondary float-right text-black-50">Vencimentos
                                    <i class="fas fa-calendar-week"></i>
                                </button>
                                </a>
                                <hr>
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
<script src="../../node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
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