<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <h1>Cadastro</h1>
                <form action="actions.php" method="post">
                    <div class="form-group mb-3">
                        <label class="mb-2" for="nome">Nome completo</label>
                        <input type="text" class="form-control" if="nome" name="nome">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="nome">Endereço</label>
                        <input type="text" class="form-control" if="cep" name="cep">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="nome">Telefone</label>
                        <input type="text" class="form-control" if="telefone" name="telefone">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="nome">Email</label>
                        <input type="email" class="form-control" if="email" name="email">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="nome">Data de Nascimento</label>
                        <input type="date" class="form-control" if="data_nascimento" name="data_nascimento">
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
                <a href="index.php" class="btn btn-primary text-white">Voltar para o Início</a>

                <div class="alert alert-<?php echo $alerta_cadastro; ?>" role="alert" id="alerta">
                    <?php echo $_SESSION['alerta']; ?>
                </div>
                <?php unset($_SESSION['alerta']); ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html> 
