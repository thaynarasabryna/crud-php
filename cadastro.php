<?php 
    session_start();
    $dados = $_SESSION['dados'];
    unset($_SESSION['dados']);

    $mensagem = $_SESSION['mensagem'];
    $mensagem_tipo = $_SESSION['mensagem_tipo'];
    unset($_SESSION['mensagem']);
    unset($_SESSION['mensagem_tipo']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6-beta.14/dist/inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="./js/script.js"></script>
    <title><?php echo !empty($dados) ? "Editar" : "Cadastro"; ?></title>
</head>
<body>
    <div class="container mt-5">
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-uppercase text-white text-center"><?php echo !empty($dados) ? "Alteração de Cadastro" : "Registrar Conta"; ?></div>
            <div class="card-body">
                <form action="actions.php" method="POST">
                    <!-- Dados Pessoais -->
                    <div class="card mb-3">
                        <div class="card-header text-center text-uppercase text-primary bg-primary text-white">Dados Pessoais</div>

                        <div class="card-body">
                            <div class="row g-1 mb-2"> <!-- 1° linha -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" name="data[pessoas][nome]" id="nome" placeholder="Seu nome" value="<?php echo !empty($dados) ? $dados['nome'] : ''; ?>" required>
                                    <label for="nome">Seu nome</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="email" class="form-control" name="data[pessoas][email]" id="email" placeholder="Seu email" value="<?php echo !empty($dados) ? $dados['email'] : ''; ?>">
                                    <label for="email">Seu email</label>
                                </div>
                            </div>

                            <div class="row g-1 mb-2"> <!-- 2° linha -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control cpf" name="data[pessoas][cpf]" id="cpf" placeholder="CPF" value="<?php echo !empty($dados) ? $dados['cpf'] : ''; ?>">
                                    <label for="cpf">CPF</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="date" class="form-control" name="data[pessoas][data_nascimento]" id="data_nascimento" placeholder="Data de Nascimento" value="<?php echo !empty($dados) ? $dados['data_nascimento'] : ''; ?>">
                                    <label for="data_nascimento">Data de Nascimento</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Endereço -->
                    <div class="card mb-3">
                        <div class="card-header text-center text-uppercase text-primary bg-primary text-white">Endereço</div>

                        <div class="card-body">
                            <div class="row g-1 mb-2"> <!-- 3° linha -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control cep" name="data[enderecos][cep]" id="cep" placeholder="CEP" value="<?php echo !empty($dados) ? $dados['cep'] : ''; ?>" onblur="pesquisacep(this.value);">
                                    <label for="cep">CEP</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" name="data[enderecos][logradouro]" id="logradouro" placeholder="Logradouro" value="<?php echo !empty($dados) ? $dados['logradouro'] : ''; ?>">
                                    <label for="logradouro">Logradouro</label>
                                </div>
                            </div>

                            <div class="row g-1 mb-2"> <!-- 4° linha -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" name="data[enderecos][numero]" id="numero" placeholder="Número" value="<?php echo !empty($dados) ? $dados['numero'] : ''; ?>">
                                    <label for="numero">Número</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" name="data[enderecos][complemento]" id="complemento" placeholder="Complemento" value="<?php echo !empty($dados) ? $dados['complemento'] : ''; ?>">
                                    <label for="complemento">Complemento</label>
                                </div>
                            </div>

                            <div class="row g-1 mb-2"> <!-- 5° linha -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" name="data[enderecos][bairro]" id="bairro" placeholder="Bairro" value="<?php echo !empty($dados) ? $dados['bairro'] : ''; ?>">
                                    <label for="bairro">Bairro</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" name="data[enderecos][cidade]" id="cidade" placeholder="Cidade" value="<?php echo !empty($dados) ? $dados['cidade'] : ''; ?>">
                                    <label for="cidade">Cidade</label>
                                </div>
                            </div>

                            <div class="row g-1 mb-2"> <!-- 6° linha -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" name="data[enderecos][uf]" id="uf" placeholder="UF" value="<?php echo !empty($dados) ? $dados['uf'] : ''; ?>">
                                    <label for="uf">UF</label>
                                </div>
                            </div>

                        </div>
                       
                    </div>
                    <div>
                        <input type="hidden" name="<?php echo !empty($dados) ? "id_edit" : "id"; ?>" value="<?php echo !empty($dados) ? $dados['id'] : ''; ?>">
                        <input type="submit" class="btn btn-success" value="<?php echo !empty($dados) ? "Salvar Alterações" : "Cadastrar"; ?>">
                        <a href="<?php echo !empty($dados) ? "listar.php" : "index.php"; ?>" class="btn btn-primary text-white"><?php echo !empty($dados) ? "Voltar" : "Voltar para o Início"; ?></a>
                    </div>
                </form>
            </div>
        </div>
        <?php if ($mensagem): ?>
            <div class="alert alert-<?php echo $mensagem_tipo; ?> alert-dismissible fade show w-50 m-3" role="alert">
                <?php echo $mensagem; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
