<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: ../user/login.php");
}
require_once('../../back/controllers/configCRUD.php');
$s = new ConfigCRUD();
switch ($_SESSION['user']) {
    case 'farma.hvu':
        $permissao = 'disabled';
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
    <link rel="stylesheet" type="text/css" href="../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css"/>
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
        <div class="col-10">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <?php
                    require_once('../../back/controllers/NotaFController.php');
                    $dados_nf = new NotaFController();
                    $nf = $dados_nf->verNF($_GET['idnf']);
                    foreach ($nf as $v) { ?>
                        <img src="../../images/document.png" class="img-fluid"
                             width="40">
                        <h5 class="text-primary roboto-condensed ml-2 mt-1"> <?= ($v->nota_entrega == 1) ? 'NE ' : 'Nota Fiscal' ?>
                            - <?= $v->numero_nf ?> <a href="e_nota_fiscal.php?idnf=<?= $_GET['idnf'] ?>"><i
                                    class='fas fa-pen fa-1x color-icon-nf text-black-50'></i></a></h5>
                    <?php } ?>

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
                <div class="mt-1 roboto-condensed text-black-50">
                    <?php
                    require_once('../../back/controllers/NotaFController.php');
                    $n = new NotaFController();
                    $attNota = $n->verificarNota($_GET['idnf']);
                    if ($attNota >= 1) {
                        $text = "Existe uma ordem de compra associada a esta NF";
                        $class = "";
                        $link = "../../back/response/compra/import_from_ordem.php?idnf=" . $_GET['idnf'];
                    } else {
                        $text = "A ordem já foi importada";
                        $class = "isDisabled";
                        $link = "#";
                    }
                    ?>
                    <?php
                    foreach ($nf as $v) {
                        ?>
                        <h6><i class="fas fa-user-tag text-black-50"></i> Fornecedor: <?= $v->fornecedor ?></h6>

                        <h6><span class="fas fa-calendar-alt text-black-50"></span> Data de
                            Emissão: <?= date("d/m/Y", strtotime($v->data_emissao)) ?></h6>
                        <h6><span class="far fa-calendar-alt text-black-50 "></span> Data de
                            Lançamento: <?= date("d/m/Y", strtotime($v->data_lancamento)) ?></h6>
                        <h6><i class="fas fa-dollar-sign text-black-50"></i> Valor:
                            R$ <?= $v->valor_nf ?></h6>

                    <?php } ?>
                    <hr class="bg-primary">
                </div>
                <form method="POST" action="../../back/response/notaf/lotes_r.php">
                    <input type='hidden' class='form-control ' name='idnf' value="<?=$_GET['idnf']?>" placeholder=''>
                    <div class="form-group row">
                        <label for="inputEmail3"
                               class="col-sm-1 col-form-label">Produto</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="prod_nf" required>
                                <option selected></option>
                                <?php
                                require_once('../../back/controllers/NotaFController.php');
                                $produtos = new NotaFController();
                                $ver_produtos = $produtos->verProdNF($_GET['idnf']);
                                foreach ($ver_produtos as $v):?>
                                    <option value="<?=$v->id_estoque?>"><?= $v->produto_e ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Lote</label>
                        <div class="col-sm-3">
                            <input type='text' class='form-control ' name='lote_prod_nf' placeholder=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Validade</label>
                        <div class="col-sm-3">
                            <input type='date' class='form-control ' name='validade_prof_nf' placeholder=''>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-primary shadow col-sm-2 exo mt-1 text-white">Adicionar <i
                            class="fas fa-plus ml-2"></i></button>
                </form>
            </div>
            <div class="mt-4 col-12 text-center">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Validade</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once '../../back/controllers/NotaFController.php';
                    $nfProd = new NotaFController();
                    $nfLotes = $nfProd->buscarLote($_GET['idnf']);

                    foreach ($nfLotes as $prodLotes):
                        $data = date_create($prodLotes->validade);
                        ?>
                        <tr>
                            <td><?=$prodLotes->produto_e?></td>
                            <td> <?=$prodLotes->lote?></td>
                            <td> <?= date_format($data, "d/m/Y") ?></td>
                            <td>
                                <a href="../../back/response/notaf/d_lotes.php?idl=<?=$prodLotes->id_nf_lote?>">
                                    <span class="badge badge-pill far fa-window-close text-danger float-right"> </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="../../node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ <r class='varela-round azul-mateus'>resultados por página</r>",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "<r class='varela-round azul-mateus'>Buscar</r>",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });
</script>
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