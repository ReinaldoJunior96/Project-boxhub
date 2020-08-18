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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
        <a class="navbar-brand" href="index.php">
            <img src="images/icon-box.png" class="" width="37" height="32" alt="">
        </a>
        <!-- <a class="navbar-brand exo text-white" href="index.php">Hospital Veterinário</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>        
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
    <div class="container mt-5">
        <?php
        require_once('back/crud/farmaciaCRUD.php');
        $dados_nf = new FarmaciaCRUD();
        $nf = $dados_nf->findID($_GET['idnf']);
        foreach ($nf as $v) {
            ?>
            <h3 class="exo titulo-1 mt-5">CADASTRAR PRODUTOS NF <i class="fas fa-boxes color-icon"></i> -
                <?= $v->numero_nf ?></h3>
                <hr class="bg-nav">
                <h6 class="exo">Fornecedor: <?= $v->fornecedor ?> - Valor: R$ <?= $v->valor_nf ?> - Data de Emissão:
                    <?= date("d/m/Y", strtotime($v->data_emissao)) ?> - Data de Lançamento:
                    <?= date("d/m/Y", strtotime($v->data_lancamento)) ?></h6>
                <?php } ?>
            </div>
            <div class="container mt-5">
                <div class="text-right">
                    <?php echo "<a href='v_nota_fiscal.php?idnf=" . $_GET['idnf'] . "' target='_blank'> <h5 class='exo'>NF <i class='fas fa-eye'></i> </h5></a>  " ?>
                </div>
                <table id="example" class="table table-sm exo text-center ">
                    <thead class="bg-table">
                        <tr class="text-light">
                            <th class="">Prod / Material</th>
                            <th class="">Quantidade</th>
                            <th class="">Lote</th>
                            <th class="">Validade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('back/crud/farmaciaCRUD.php');
                        $produtos = new FarmaciaCRUD();
                        $ver_produtos = $produtos->verEstoque();
                        foreach ($ver_produtos as $v) {
                            ?>
                            <tr>
                                <form method="POST" action="back/response/n_produtos_nfr.php">
                                    <td><?= $v->produto_e ?></td>
                                    <input type="hidden" name="nf" value="<?= $_GET['idnf'] ?>">
                                    <input type="hidden" name="prod_id" value="<?= $v->id_estoque ?>">
                                    <td><input type="number" class="form-control" name="quantidade_pnf" id="inputPassword4" placeholder=""></td>
                                    <td><input type="text" class="form-control" name="lote_pnf" id="inputPassword4" placeholder="">
                                    </td>
                                    <td><input type="date" class="form-control" name="validade_pnf" id="inputPassword4" placeholder=""></td>
                                    <td><button type="submit" class="btn border-0 bg-color-btn mt-1"><i class="fas fa-plus text-white"></i></td>
                                    </form>
                                    <!-- <td><button type="submit" class="btn btn-success"><i class="fas fa-plus-square"></i></button></td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br><br>
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
                                "sLengthMenu": "_MENU_ <r class='exo azul-mateus'>resultados por página</r>",
                                "sLoadingRecords": "Carregando...",
                                "sProcessing": "Processando...",
                                "sZeroRecords": "Nenhum registro encontrado",
                                "sSearch": "<r class='exo azul-mateus'>Buscar</r>",
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
            </body>

            </html>