<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: ../user/login.php");
}
require_once('../../back/controllers/configCRUD.php');
require_once('../../back/controllers/EstoqueController.php');
$s = new ConfigCRUD();
$f = new EstoqueController();
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
                    <h5 class="text-primary roboto-condensed"><img src="../../images/mail.png" class="img-fluid"
                                                                   width="40">
                        Notificações</h5>
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
                <div class="text-center mt-2">
                    <?php
                    $produtos = $f->ver_notificacoes();
                    foreach ($produtos as $valores) {
                        if($valores->quantidade_e<= $valores->estoque_minimo_e){
                        ?>
                        <div class="shadow p-2 mb-2 bg-white rounded col-12">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../../images/boy.png" width="50" class="rounded float-left" alt="...">
                                </div>
                                <div class="col-10 text-left">
                                    <p>Olá, o produto / material <strong><?= $valores->produto_e ?></strong> já está em
                                        seu estoque mínimo!</p>

                                </div>

                            </div>

                        </div>
                    <?php }} ?>
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