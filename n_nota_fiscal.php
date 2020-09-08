<?php
session_start();
if ($_SESSION['user'] == NULL || $_SESSION['password'] == NULL) {
    header("location: login.php");
} elseif ($_SESSION['user'] != 'compras.hvu') {
    header("location: index.php");
}
require_once('back/crud/configCRUD.php');
$s = new ConfigCRUD();
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
        <?php include_once "widget/menu.php" ?>
        <div class="col-9">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                    <a class="navbar-brand text-white roboto-condensed" href="#"><i class="fas fa-box-open"></i>
                        Cadastro NF
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


                        </div>
                    </div>
                </nav>
                <div class="mt-5">
                    <div class="container">
                        <form method="POST" action="back/response/nota_fiscal_r.php">
                            <div class="form-row">
                                <input type="hidden" name="tipo" value="new">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4" class="roboto-condensed">Número da NF</label>
                                    <input type="text" class="form-control" name="numero_nf" id="inputEmail4"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="roboto-condensed">Data de Emissão</label>
                                    <input type="date" class="form-control" name="datae_nf" id="inputEmail4"
                                           placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="roboto-condensed">Data de Lançamento</label>
                                    <input type="date" class="form-control" name="datal_nf" id="inputPassword4"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="inputEmail4" class="roboto-condensed">Fornecedor</label>
                                    <input type="text" class="form-control" name="fornecedor_nf" id="inputEmail4"
                                           placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="col-auto">
                                        <label for="inputEmail4" class="roboto-condensed">Valor</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-primary text-light roboto-condensed">
                                                    R$
                                                </div>

                                            </div>
                                            <input type="text" class="form-control" name="valor_nf" id=""
                                                   placeholder="">
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Utilize ponto no lugar da
                                            vírgula.</small>
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="exampleFormControlTextarea1" class="roboto-condensed">Observação</label>
                                    <textarea class="form-control" name="obs_nf" id="exampleFormControlTextarea1"
                                              rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" required="" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label roboto-condensed" for="exampleCheck1">Confirmo que
                                    revisei os dados
                                    inseridos</label>
                            </div>
                            <button type="submit" class="btn bg-primary col-sm-2 roboto-condensed text-white shadow ">
                                Gerar NF <i
                                        class="fas fa-plus ml-2"></i>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <table id="example" class="table table-striped roboto-condensed text-center">
                    <thead class="bg-primary text-white">
                    <tr class="">
                        <th class="">NF</th>
                        <th class="">Fornecedor</th>
                        <th class="">Data de Emissão</th>
                        <th class="">Data Lançamento</th>
                        <th class="">Valor</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="text-black-50">
                    <?php
                    require_once('back/crud/farmaciaCRUD.php');
                    $view_nf = new FarmaciaCRUD();
                    $allnf = $view_nf->index();
                    foreach ($allnf as $v) {
                        ?>
                        <tr>
                            <?php echo "<td class=''><a class='text-primary' href=n_produtos_nota_fiscal.php?idnf=" . $v->id_nf . ">" . $v->numero_nf . "</a></td>" ?>
                            <td><?= $v->fornecedor ?></td>
                            <td><?= $v->data_emissao ?></td>
                            <td><?= $v->data_lancamento ?></td>
                            <td>R$ <?= $v->valor_nf ?></td>
                            <?php echo "<td><a href=e_entrada_farma.php?idnf=" . $v->id_nf . "><i class='fas fa-pen fa-1x color-icon-nf text-black-50'></i></a></td>" ?>
                            <?php echo "<td><a href=back/response/d_nf_r.php?idnf=" . $v->id_nf . "><i class='fas fa-trash-alt fa-1x text-secondary'></i></a></td>" ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
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