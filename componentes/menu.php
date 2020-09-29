<div class="col-2 roboto-condensed shadow">
    <div class="text-center">
        <a href="index.php">
            <img src="images/img-login.png" class="img-fluid" width="300">
        </a>
    </div>
    <ul class="list-group list-group-flush">
        <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? 'n_nota_fiscal.php' : '' ?>"
           class="<?= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?> text-menu-color-2">
            <li class="list-group-item border-0">
                <i class="fas fa-cart-arrow-down"></i> Entrada
            </li>
        </a>
        <a href="nv_estoque.php" class="text-menu-color-2">
            <li class="list-group-item border-0"><i class="fas fa-box-open"></i> Estoque</li>
        </a>
        <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? 'n_ordemcompra.php' : '' ?>"
           class="text-menu-color-2 <?= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?>">
            <li class="list-group-item border-0">
                <i class=" fas fa-shopping-bag"></i> Compras
            </li>
        </a>
        <div class="dropright">
            <li class="list-group-item border-0"
                data-toggle="dropdown">
                <a href="#" class="border-top-0 border-right-0 border-left-0 text-menu-color-2"><i
                            class="fas fa-external-link-alt <?= ($_SESSION['user'] == 'farma.hvu' or $_SESSION['user'] == 'tatiane_a.hvu') ? '' : 'isDisabled' ?>"></i>
                    Saída</a>
            </li>
            <?php if ($_SESSION['user'] == 'farma.hvu'){ ?>
            <div class="dropdown-menu border-0 shadow">
                <ul class="list-group border-0">
                    <?php
                    include './back/controllers/setoresController.php';
                    $s = new SetorController();
                    $setores = $s->verSetores();
                    foreach ($setores as $v) {
                        ?>
                        <li class="list-group-item list-group-item-action border-0 text-menu-color-2"><a
                                    href="<?= ($_SESSION['user'] == 'farma.hvu' or $_SESSION['user'] == 'tatiane_a.hvu') ? 'n_saida_setor.php?setor=' . $v->id_setor . '&nomesetor=' . str_replace("-", " ", $v->setor_s) : '' ?>         "
                                    class="<?= ($_SESSION['user'] == 'farma.hvu' or $_SESSION['user'] == 'tatiane_a.hvu') ? '' : 'isDisabled' ?>">
                                <?= str_replace("-", " ", $v->setor_s) ?>
                            </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>
        <a href="<?= ($_SESSION['user'] == 'farma.hvu') ? 'n_relatorio.php' : '' ?>"
           class="<?= ($_SESSION['user'] != 'farma.hvu') ? 'isDisabled' : '' ?> text-menu-color-2">
            <li class="list-group-item border-0 <?= ($_SESSION['user'] != 'farma.hvu') ? 'isDisabled' : '' ?>">
                <i class=" fas fa-file-pdf"></i> Relatórios
            </li>
        </a>
        <a href="notificacao.php" class="text-menu-color-2">
            <li class="list-group-item border-0">
                <i class=" fas fa-bell"></i>
                Notificações
                <span class="float-right">
                    <i class="fas fa-exclamation-triangle text-primary"></i>
                </span>
            </li>
        </a>
        <a href="<?= ($_SESSION['user'] == 'farma.hvu') ? 'n_setores.php' : '' ?>"
           class="<?=($_SESSION['user'] != 'farma.hvu') ? 'isDisabled' : '' ?> text-menu-color-2">
            <li class="list-group-item border-0 <?=($_SESSION['user'] != 'farma.hvu') ? 'isDisabled' : '' ?>">
                <i class="fas fa-project-diagram"></i> Setores
            </li>
        </a>
        <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? 'fornecedores.php' : '' ?>"
           class="<?= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?> text-menu-color-2">
            <li class="list-group-item border-0">
                <i class="fas fa-users"></i> Fornecedores
            </li>
        </a>
        <a href="back/response/destroy_sessao.php" class="text-menu-color-2">
            <li class="list-group-item border-0">
                <i class="fas fa-power-off"></i> Sair
            </li>
        </a>

    </ul>


    <ul class="list-group list-group-flush mt-2">
        <!--        <li class="list-group-item">-->
        <!--            <a href="--><? //= ($_SESSION['user'] == 'compras.hvu') ? 'n_nota_fiscal.php' : '#' ?><!--"-->
        <!--               class="border-top-0 border-right-0 border-left-0 text-menu-color-2  -->
        <? //= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?><!--">-->
        <!--                <i class="fas fa-cart-arrow-down"></i> Entrada</a>-->
        <!--        </li>-->

        <!--        <li class="list-group-item">-->
        <!--            <a href="--><? //= ($_SESSION['user'] == 'compras.hvu' or
        //                $_SESSION['user'] == 'farma.hvu' or
        //                $_SESSION['user'] == 'tatiane_a.hvu') ? 'nv_estoque.php' : '#' ?><!--"-->
        <!--               class="border-top-0 border-right-0 border-left-0 border-top-0 text-menu-color-2"><i-->
        <!--                        class="fas fa-box-open"></i> Estoque</a>-->
        <!--        </li>-->
        <!--        <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">-->
        <!--            <a href="--><? //= ($_SESSION['user'] == 'compras.hvu') ? 'n_ordemcompra.php' : '' ?><!--"-->
        <!--               class="border-top-0 border-right-0 border-left-0 border-top-0 text-menu-color-2 -->
        <? //= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?><!--"">-->
        <!--            <i class=" fas fa-shopping-bag"></i> Compras</a>-->
        <!--        </li>-->
        <!-- Botão dropright padrão -->
        <!--        <div class="dropright">-->
        <!--            <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 "-->
        <!--                data-toggle="dropdown">-->
        <!--                <a href="#" class="border-top-0 border-right-0 border-left-0 text-menu-color-2"><i-->
        <!--                            class="fas fa-external-link-alt -->
        <? //= ($_SESSION['user'] == 'farma.hvu' or $_SESSION['user'] == 'tatiane_a.hvu') ? '' : 'isDisabled' ?><!--"></i>-->
        <!--                    Saída</a>-->
        <!--            </li>-->
        <!--            <div class="dropdown-menu border-0 shadow">-->
        <!--                <ul class="list-group border-0">-->
        <!--                    --><?php
        //                    include './back/controllers/setoresController.php';
        //                    $s = new SetorController();
        //                    $setores = $s->verSetores();
        //                    foreach ($setores as $v) {
        //                        ?>
        <!--                    --><?php //} ?>
        <!--                </ul>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 "><a-->
        <!--                    href="-->
        <? //= ($_SESSION['user'] == 'compras.hvu' or $_SESSION['user'] == 'farma.hvu') ? 'n_relatorio.php' : '#' ?><!--"-->
        <!--                    class="border-top-0 border-right-0 border-left-0 text-menu-color-2" "><i class=" fas-->
        <!--                            fa-file-pdf"></i> Relatórios</a></li>-->
        <!--        <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">-->
        <!--            <a href="-->
        <? //= ($_SESSION['user'] == 'compras.hvu' or $_SESSION['user'] == 'farma.hvu' or $_SESSION['user'] == 'tatiane_a.hvu') ? 'notificacao.php' : '' ?><!--"-->
        <!--               class="border-top-0 border-right-0 border-left-0 text-menu-color-2 " "><i class=" fas-->
        <!--                                    fa-bell"></i> Notificações <span class="float-right"><i-->
        <!--                        class="fas fa-exclamation-triangle text-primary"></i></span></a>-->
        <!--        </li>-->
        <!--        <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">-->
        <!--            <a href="--><? //= ($_SESSION['user'] == 'farma.hvu') ? 'setores.php' : '' ?><!--"-->
        <!--               class="text-menu-color-2 -->
        <? //= ($_SESSION['user'] == 'farma.hvu') ? '' : 'isDisabled' ?><!--">-->
        <!--                <i class="fas fa-project-diagram"></i> Setores</a>-->
        <!--        </li>-->
        <!--        <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">-->
        <!--            <a href="--><? //= ($_SESSION['user'] == 'compras.hvu') ? 'fornecedores.php' : '' ?><!--"-->
        <!--               class="text-menu-color-2 -->
        <? //= ($_SESSION['user'] == 'compras.hvu') ? '' : 'isDisabled' ?><!--">-->
        <!--                <i class="fas fa-users"></i> Fornecedores</a>-->
        <!--        </li>-->
        <!---->
        <!--        <li class="list-group-item border-top border-right-0 border-left-0 border-bottom-0 ">-->
        <!---->
        <!--        </li><a href="back/response/destroy_sessao.php" class="text-menu-color-2"><i-->
        <!--                    class="fas fa-power-off"></i> Sair</a>-->
    </ul>
</div>