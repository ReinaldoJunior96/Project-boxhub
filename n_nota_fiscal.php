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
    <title>boxhub</title>
    <script type="text/javascript">
        function SubstituiVirgulaPorPonto(campo) {
            campo.value = campo.value.replace(/,/gi, ".");
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-nav ">
        <a class="navbar-brand" href="index.php">
            <img src="images/icon-box.png" width="37" height="32" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado"></div>
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
        <h3 class="exo titulo-1 mt-5">CADASTRO DE NOTA FISCAL <i class="fas fa-file-alt color-icon"></i></h3>
        <hr class="bg-nav">
        <form method="POST" action="back/response/nota_fiscal_r.php">
            <div class="form-row">
                <input type="hidden" name="tipo" value="new">
                <div class="form-group col-md-12">
                    <label for="inputEmail4" class="exo">Número da NF</label>
                    <input type="text" class="form-control" name="numero_nf" id="inputEmail4" placeholder="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="exo">Data de Emissão</label>
                    <input type="date" class="form-control" name="datae_nf" id="inputEmail4" placeholder="">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="exo">Data de Lançamento</label>
                    <input type="date" class="form-control" name="datal_nf" id="inputPassword4" placeholder="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputEmail4" class="exo">Fornecedor</label>
                    <input type="text" class="form-control" name="fornecedor_nf" id="inputEmail4" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <div class="col-auto">
                        <label for="inputEmail4" class="exo">Valor</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-color-btn text-light exo">R$</div>
                            </div>
                            <input type="text" class="form-control" name="valor_nf" id="" onkeyup="SubstituiVirgulaPorPonto(this)" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="exampleFormControlTextarea1" class="exo">Observação</label>
                    <textarea class="form-control" name="obs_nf" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" required="" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label exo" for="exampleCheck1">Confirmo que revisei os dados inseridos</label>
            </div>
            <button type="submit" class="btn bg-color-btn col-sm-2 exo mt-1">Gerar NF <i class="fas fa-plus ml-2"></i>
            </form>
        </div>
        <div class="container mt-5">
            <table id="example" class="table table-striped exo text-center">
                <thead class="bg-shadow-it bg-table">
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
                <tbody>
                    <?php
                    require_once('back/crud/farmaciaCRUD.php');
                    $view_nf = new FarmaciaCRUD();
                    $allnf = $view_nf->index();
                    foreach ($allnf as $v) {
                        ?>
                        <tr>
                            <?php echo "<td class=''><a class='link' href=n_produtos_nota_fiscal.php?idnf=" . $v->id_nf . ">" . $v->numero_nf . "</a></td>" ?>
                            <td><?= $v->fornecedor ?></td>
                            <td><?= $v->data_emissao ?></td>
                            <td><?= $v->data_lancamento ?></td>
                            <td>R$ <?= $v->valor_nf ?></td>
                            <?php echo "<td><a href=e_entrada_farma.php?idnf=" . $v->id_nf . "><i class='fas fa-pen-square fa-lg color-icon-nf'></i></a></td>" ?>
                            <?php echo "<td><a href=back/response/d_nf_r.php?idnf=" . $v->id_nf . "><i class='fas fa-window-close fa-1x' style='color: red;'></i></a></td>" ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
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