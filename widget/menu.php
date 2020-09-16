<html>

<head>
</head>

<body>
    <div class="col-3 roboto-condensed">
        <div class="shadow p-2">
            <div class="text-center">
                <img src="images/man.png" class="img-fluid mt-2" width="100" alt="Imagem responsiva">
                <h5 class="roboto-condensed text-black-50">Bem vindo(a), <?= $_SESSION['user'] ?></h5>
            </div>
            <ul class="list-group mt-2">
                <li class="list-group-item border-0 text-center active">
                     Menu
                </li>
                <li class="list-group-item border-0">
                    <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? 'n_nota_fiscal.php' : '#' ?>"
                        class="border-top-0 border-right-0 border-left-0 text-menu-color-2  <?= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?>">
                        <i class="fas fa-cart-arrow-down"></i> Entrada</a>
                </li>

                <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                    <a href="<?= ($_SESSION['user'] == 'compras.hvu' or $_SESSION['user'] == 'farma.hvu') ? 'nv_estoque.php' : '#' ?>"
                        class="border-top-0 border-right-0 border-left-0 border-top-0 text-menu-color-2"><i
                            class="fas fa-box-open"></i> Estoque</a>
                </li>
                <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                    <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? 'n_ordemcompra.php' : '' ?>"
                        class="border-top-0 border-right-0 border-left-0 border-top-0 text-menu-color-2 <?= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?>"">
                        <i class=" fas fa-shopping-bag"></i> Compras</a>
                </li>


                <!-- Botão dropright padrão -->
                <div class="dropright">
                    <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 "
                        data-toggle="dropdown">
                        <a href="#" class="border-top-0 border-right-0 border-left-0 text-menu-color-2"><i
                                class="fas fa-external-link-alt <?= ($_SESSION['user'] == 'farma.hvu') ? '' : 'isDisabled' ?>"></i>
                            Saída</a>
                    </li>

                    <div class="dropdown-menu border-0 shadow">
                        <ul class="list-group border-0">
                            <?php
                            $setores = $s->ver_setores();
                            foreach ($setores as $v) {
                            ?>
                            <li class="list-group-item list-group-item-action border-0 text-menu-color-2"><a
                                    href="<?= ($_SESSION['user'] == 'farma.hvu') ? 'n_saida_setor.php?setor=' . $v->id_setor . '&nomesetor=' . str_replace("-", " ", $v->setor_s) : '' ?>         "
                                    class="<?= ($_SESSION['user'] == 'farma.hvu') ? '' : 'isDisabled' ?>">
                                    <?= str_replace("-", " ", $v->setor_s) ?>
                                </a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 "><a
                        href="<?= ($_SESSION['user'] == 'compras.hvu' or $_SESSION['user'] == 'farma.hvu') ? 'n_relatorio.php' : '#' ?>"
                        class="border-top-0 border-right-0 border-left-0 text-menu-color-2" "><i class=" fas
                        fa-file-pdf"></i> Relatórios</a></li>
                <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                    <a href="<?= ($_SESSION['user'] == 'compras.hvu' or $_SESSION['user'] == 'farma.hvu') ? 'notificacao.php' : '' ?>"
                        class="border-top-0 border-right-0 border-left-0 text-menu-color-2 " "><i class=" fas
                        fa-bell"></i> Notificações <span class="float-right"><i
                                class="fas fa-exclamation-triangle text-primary"></i></span></a>
                </li>

                <!--<li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                <a href="vd_pedidos.php"
                   class="border-top-0 border-right-0 border-left-0 text-menu-color-2"><i
                            class="fas fa-ticket-alt"></i> Solicitação</a>

            </li>-->
                <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                    <a href="<?= ($_SESSION['user'] == 'farma.hvu') ? 'config_farma.php' : '' ?>"
                        class="text-menu-color-2 <?= ($_SESSION['user'] == 'farma.hvu') ? '' : 'isDisabled' ?>">
                        <i class="fas fa-cog"></i> Configurações</a>
                </li>

                <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">
                    <a href="back/response/destroy_sessao.php" class="text-menu-color-2"><i
                            class="fas fa-power-off"></i> Sair</a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>