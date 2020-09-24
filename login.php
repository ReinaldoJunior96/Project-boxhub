<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Meu CSS -->
    <title class="roboto-condensed">Firebox</title>
    <link rel="icon" type="imagem/png" href="images/fire.png" />
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>
<body class="bg-nav">
<div class="container-fluid">
    <div class="d-flex justify-content-center mt-5">
        <div class="shadow p-4 mb-5 bg-white rounded mt-5 col-4">
            <div class="text-center">
                <img src="images/img-login.png" class="img-fluid" width="400" alt="Imagem responsiva">
            </div>
            <form method="post" action="back/response/sessao.php">
                <div class="form-group row">
                    <label for="inputPassword" class="col-1 col-form-label"><i class="fas fa-user text-secondary"></i></label>
                    <div class="col-sm-11">
                        <input type="text" name="user" class="form-control roboto-condensed" id="inputPassword" placeholder="Usuário">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-1 col-form-label"><i class="fas fa-key text-secondary"></i></label>
                    <div class="col-sm-11">
                        <input type="password" name="password" class="form-control roboto-condensed" id="inputPassword" placeholder="Senha">
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary col-3 roboto-condensed shadow text-white">Entrar</button>
            </form>

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