<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css" />
    <!-- Meu CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Hospital Veterinário</title>
    <script type="text/javascript">
        function SubstituiVirgulaPorPonto(campo) {
            campo.value = campo.value.replace(/,/gi, ".");
        }
    </script>
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
        <h3 class="exo titulo-1 mt-5">EDITAR NOTA FISCAL <i class="fas fa-file-alt color-icon"></i></h3>
        <hr class="bg-nav">
        <?php
        require_once('back/crud/farmaciaCRUD.php');
        $new_nf = new FarmaciaCRUD();
        $ver_nf = $new_nf->findID($_GET['idnf']);
        foreach ($ver_nf as $v) {
            ?>
            <form method="POST" action="back/response/nota_fiscal_r.php">
                <input type="hidden" name="tipo" value="edit">
                <input type="hidden" name="idnf" value="<?= $_GET['idnf'] ?>">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4" class="exo">Número da NF</label>
                        <input type="text" class="form-control" value="<?= $v->numero_nf ?>" name="numero_nf" id="inputEmail4" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4" class="exo">Data de Emissão</label>
                        <input type="date" class="form-control" value="<?= $v->data_emissao ?>" name="datae_nf" id="inputEmail4" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4" class="exo">Data de Lançamento</label>
                        <input type="date" class="form-control" value="<?= $v->data_lancamento ?>" name="datal_nf" id="inputPassword4" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputEmail4" class="exo">Fornecedor</label>
                        <input type="text" class="form-control" value="<?= $v->fornecedor ?>" name="fornecedor_nf" id="inputEmail4" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4" class="exo">Valor (R$)</label>
                        <input type="text" class="form-control" value="<?= $v->valor_nf ?>" name="valor_nf" id="" onkeyup="SubstituiVirgulaPorPonto(this)" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="exampleFormControlTextarea1">Observação</label>
                        <textarea class="form-control" name="obs_nf" id="exampleFormControlTextarea1" rows="3"><?= $v->obs_nf ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn bg-color-btn col-sm-2 comfortaa mt-1">Editar NF <i class="fas fa-pen"></i>
            </form>
    </div>
<?php } ?>
<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
<script type='text/javascript'>
    (function() {
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