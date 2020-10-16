<div class="col-2 roboto-condensed shadow">
    <div class="text-center">
        <a href="../../index.php">
            <img src="../../images/logo-fire.png" class="img-fluid" width="300">
        </a>
    </div>
    <ul class="list-group list-group-flush">
        <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? '../notaf/n_nota_fiscal.php' : '' ?>"
           class="<?= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?> text-menu-color-2">
            <li class="list-group-item border-0">
                <i class="fas fa-cart-arrow-down"></i> Entrada
            </li>
        </a>
        <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? '../compra/n_ordemcompra.php' : '' ?>"
           class="<?= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?> text-menu-color-2">
            <li class="list-group-item border-0">
                <i class=" fas fa-shopping-bag"></i> Compras
            </li>
        </a>
        <a href="../estoque/nv_estoque.php" class="text-menu-color-2">
            <li class="list-group-item border-0"><i class="fas fa-clinic-medical"></i> Farmácia</li>
        </a>
        <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? '../estoque/nv_prod_diversos.php' : '' ?>"
           class="text-menu-color-2 <?= ($_SESSION['user'] == 'compras.hvu') ? '' : 'isDisabled' ?>">
            <li class="list-group-item border-0"><i class="fas fa-boxes"></i> Produtos Diversos</li>
        </a>

        <a href="<?= ($_SESSION['user'] == 'farma.hvu') ? '../saidasetor/s_data_setor.php' : '' ?>"
           class="<?= ($_SESSION['user'] == 'farma.hvu') ? '' : 'isDisabled' ?> text-menu-color-2">
            <li class="list-group-item border-0">
                <i class="fas fa-external-link-alt"></i> Saída
            </li>
        </a>

        <a href="<?= ($_SESSION['user'] == 'farma.hvu' or $_SESSION['user'] == 'compras.hvu') ? '../relatorio/n_relatorio.php' : '' ?>"
           class="<?= ($_SESSION['user'] == 'farma.hvu' or $_SESSION['user'] == 'compras.hvu') ? '' : 'isDisabled' ?> text-menu-color-2">
            <li class="list-group-item border-0 <?= ($_SESSION['user'] == 'farma.hvu' or $_SESSION['user'] == 'compras.hvu') ? '' : 'isDisabled' ?>">
                <i class=" fas fa-file-pdf"></i> Relatórios
            </li>
        </a>
        <a href="../notificacao/notificacao.php" class="text-menu-color-2">
            <li class="list-group-item border-0">
                <i class=" fas fa-bell"></i>
                Notificações
                <span class="float-right">
            <i class="fas fa-exclamation-triangle text-primary"></i>
        </span>
            </li>
        </a>
        <a href="<?= ($_SESSION['user'] == 'farma.hvu') ? '../setores/n_setores.php' : '' ?>"
           class="<?= ($_SESSION['user'] != 'farma.hvu') ? 'isDisabled' : '' ?> text-menu-color-2">
            <li class="list-group-item border-0 <?= ($_SESSION['user'] != 'farma.hvu') ? 'isDisabled' : '' ?>">
                <i class="fas fa-project-diagram"></i> Setores
            </li>
        </a>
        <a href="<?= ($_SESSION['user'] == 'compras.hvu') ? '../fornecedores/fornecedores.php' : '' ?>"
           class="<?= ($_SESSION['user'] != 'compras.hvu') ? 'isDisabled' : '' ?> text-menu-color-2">
            <li class="list-group-item border-0">
                <i class="fas fa-users"></i> Fornecedores
            </li>
        </a>
        <a href="../../back/response/user/destroy_sessao.php" class="text-menu-color-2">
            <li class="list-group-item border-0">
                <i class="fas fa-power-off"></i> Sair
            </li>
        </a>
    </ul>
</div>