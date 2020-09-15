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
    <title>Box Hub</title>
    <!-- <link rel="icon" class="rounded" href="images/icon-box.png" type="image/x-icon" /> -->
</head>
<body class="bg-nav">
<div class="container-fluid">
    <div class="d-flex justify-content-center mt-5">
        <div class="shadow p-3 mb-5 bg-white rounded col-4">
            <div class="text-center">
                <img src="images/logo-login.png" class="img-fluid mt-2" width="250" alt="Imagem responsiva">
            </div>
            <form method="post" action="back/response/sessao.php">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="roboto-condensed text-black-50">Usuário</label>
                    <input type="text" name="user" class="form-control input-background"  id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="roboto-condensed text-black-50">Senha</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="">
                </div>
                <button type="submit" class="btn btn-secondary col-3 roboto-condensed shadow">Entrar</button>
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