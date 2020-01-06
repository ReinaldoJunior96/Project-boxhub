
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Meu CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Hospital Veterinário</title>
</head>

<body>
    <div class="d-flex justify-content-center mt-5">
        <div class="shadow-lg p-3 mb-5 bg-white rounded col-sm-4 p-3">
            <img src="../images/logo.png" class="rounded mx-auto d-block col-sm-8" alt="...">
            <form method="POST" action="itens_req.php">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="comfortaa ">Usuário <i class="fas fa-user"></i></label>
                    <input type="text" name="solicitante" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Não compartilhe sua identificação, ela é sua responsabilidade.</small>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend ">
                        <label class="input-group-text bg-color-roxo comfortaa" for="inputGroupSelect01">Setor</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="setor">
                        <option selected></option>
                        <?php
                        require_once '../crud/requisicao_crud.php';
                        $s = new RequisicaoCRUD();
                        $setores = $s->ver_setores();
                        foreach($setores as $v){
                        ?>
                            <option value="<?=$v->setor_s?>"><?=str_replace("-", " ", $v->setor_s)?></option>
                        <?php } ?>
                        
                    </select>
                </div>
                <div class=" d-flex justify-content-center">
                    <button type="submit" class="btn bg-color-roxo comfortaa">Solicitar <i class="fas fa-hand-paper"></i></button>
                </div>

            </form>
        </div>
    </div>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "",
                    "sInfoEmpty": "",
                    "sInfoFiltered": "",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "<r class='search'>Buscar</r>",
                    "oPaginate": {
                        "sNext": "",
                        "sPrevious": "",
                        "sFirst": "",
                        "sLast": ""
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