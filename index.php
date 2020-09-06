<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
}
require_once('back/crud/configCRUD.php');
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title>Box Hub</title>
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="shadow p-3">
                <div class="text-center">
                    <img src="images/box.png" class="img-fluid mt-2" width="100" alt="Imagem responsiva">
                    <h4 class="roboto-condensed text-black-50">Box Hub</h4>
                </div>
                <ul class="list-group mt-5">
                    <li class="list-group-item border-0">
                        <a href="n_nota_fiscal.php"
                           class="border-top-0 border-right-0 border-left-0 text-menu-color-2 >">
                            <i class="fas fa-cart-arrow-down"></i> Entrada</a>
                    </li>
                    <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                        <a href="nv_estoque.php"
                           class="border-top-0 border-right-0 border-left-0 border-top-0 text-menu-color-2"><i
                                    class="fas fa-box-open"></i> Estoque</a></li>


                    <!-- Botão dropright padrão -->
                    <div class="dropright">
                        <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 "  data-toggle="dropdown">
                            <a href="#" class="border-top-0 border-right-0 border-left-0 text-menu-color-2"><i
                                        class="fas fa-external-link-alt"></i> Saída</a></li>

                        <div class="dropdown-menu border-0 shadow">
                            <ul class="list-group border-0">
                                <?php
                                $setores = $s->ver_setores();
                                foreach ($setores as $v) {
                                    ?>
                                   <li class="list-group-item list-group-item-action border-0 text-menu-color-2"><a href="n_saida_setor.php?setor=<?= $v->id_setor ?>&nomesetor=<?= str_replace("-", " ", $v->setor_s) ?>"
                                       class="">
                                        <?= str_replace("-", " ", $v->setor_s) ?>
                                    </a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 "><a
                                href="n_relatorio.php"
                                class="border-top-0 border-right-0 border-left-0 text-menu-color-2" <?= $permissao ?>
                        "><i class="fas fa-file-pdf"></i> Relatórios</a></li>
                    <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                        <a href="n_relatorio.php"
                           class="border-top-0 border-right-0 border-left-0 text-menu-color-2 " <?= $permissao ?>
                        "><i class="fas fa-bell"></i> Notificações <span class="float-right"><i
                                    class="fas fa-exclamation-triangle text-primary"></i></span></a>
                    </li>

                    <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                        <a href="vd_pedidos.php"
                           class="border-top-0 border-right-0 border-left-0 text-menu-color-2"><i
                                    class="fas fa-ticket-alt"></i> Solicitação</a>

                    </li>
                    <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                        <a href="config_farma.php"
                           class="text-menu-color-2" <?= $permissao ?>
                        "><i
                                class="fas fa-cog"></i> Configurações</a>
                    </li>

                    <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                        <a href="back/response/destroy_sessao.php"
                           class="text-menu-color-2"><i
                                    class="fas fa-power-off"></i> Sair</a>
                    </li>


                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                    <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado"
                            aria-expanded="false" aria-label="Alterna navegação">
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
                <div class="text-center mt-5">
                    <img src="images/index-image.png" width="600" class="img-fluid" alt="Imagem responsiva">
                    <br><br><br><br><br><br><br><br><br>
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