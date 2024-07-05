<!DOCTYPE html>
<html lang="en">
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
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="data_nascimento">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
                <a href="index.php" class="btn btn-primary text-white">Voltar para o Início</a>
                <?php 
                    if (mysqli_query($conn, $sql)) {
                        mensagem("$nome cadastrado com sucesso!", 'success');
                    } else {
                        mensagem("$nome NAO foi cadastrado.", 'danger');
                    }  
                ?>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>