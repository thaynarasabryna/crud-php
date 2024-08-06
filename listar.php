<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="./js/script.js"></script>
    <title>Pesquisar</title>
</head>
<body>

    <?php
        include "conexao.php";
        
        session_start();

        $mensagem = $_SESSION['mensagem'];
        $mensagem_tipo = $_SESSION['mensagem_tipo'];
        unset($_SESSION['mensagem']);
        unset($_SESSION['mensagem_tipo']);

        if (!$conn) {
            die("Falha na conexão: " . mysqli_connect_error());
        }

        if (isset($_POST['busca'])) {
            $pesquisa = $_POST['busca'];
        } else {
            $pesquisa = '';
        }

        $sql = "SELECT
                    p.id,
                    p.nome, 
                    p.email, 
                    p.cpf, 
                    p.data_nascimento,
                    e.cep,
                    e.logradouro,
                    e.numero,
                    e.complemento,
                    e.bairro,
                    e.cidade,
                    e.uf
                FROM pessoas p 
                LEFT JOIN enderecos e ON p.id = e.id_pessoas
                WHERE nome LIKE '%$pesquisa%'";

        $dados = mysqli_query($conn, $sql);
    ?>
    <div class="container-fluid mt-5">
        <div class="card shadow-sm mb-4 col-lg-12">
            <div class="card-header bg-primary text-uppercase text-white text-center">Pesquisar Registros</div>
            <div class="card-body">
                <nav class="navbar navbar-light bg-light mb-3">
                    <form class="form-inline d-flex w-10" action="pesquisa.php" method="POST">
                        <input class="form-control mr-sm-2 w-75" type="search" placeholder="Pesquisar" aria-label="Pesquisar" name="busca" autofocus>
                        <button class="btn btn-outline-success my-2 my-sm-0 m-2" type="submit">Pesquisar</button>
                    </form>
                </nav>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="small">Nome</th>
                            <th scope="col" class="small">Email</th>
                            <th scope="col" class="small">CPF</th>
                            <th scope="col" class="small">Data de Nascimento</th>
                            <th scope="col" class="small">CEP</th>
                            <th scope="col" class="small">Logradouro</th>
                            <th scope="col" class="small">Número</th>
                            <th scope="col" class="small">Complemento</th>
                            <th scope="col" class="small">Bairro</th>
                            <th scope="col" class="small">Cidade</th>
                            <th scope="col" class="small">UF</th>
                            <th scope="col" class="small">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if (mysqli_num_rows($dados) > 0) {
                            while ($linha = mysqli_fetch_assoc($dados)) { ?>
                                <tr>
                                    <th scope="row" class="small"><?php echo $linha['nome']?></th>
                                    <td scope="row" class="small"><?php echo $linha['email']?></td>
                                    <td scope="row" class="small"><?php echo $linha['cpf']?></td>
                                    <td scope="row" class="small"><?php echo mostraData($linha['data_nascimento'])?></td>
                                    <td scope="row" class="small"><?php echo $linha['cep']?></td>
                                    <td scope="row" class="small"><?php echo $linha['logradouro']?></td>
                                    <td scope="row" class="small"><?php echo $linha['numero']?></td>
                                    <td scope="row" class="small"><?php echo $linha['complemento']?></td>
                                    <td scope="row" class="small"><?php echo $linha['bairro']?></td>
                                    <td scope="row" class="small"><?php echo $linha['cidade']?></td>
                                    <td scope="row" class="small"><?php echo $linha['uf']?></td>

                                    <td width="150px">
                                        <form action="actions.php" method="POST">
                                            <input type="submit" class="btn btn-primary btn-sm me-1" value="Editar">    
                                            <a href="#" class="btn btn-danger btn-sm" onclick="carregaModal(<?php echo $linha['id']; ?>, '<?php echo $linha['nome']; ?>')">Excluir</a>
                                            <input type="hidden" name="id" value="<?php echo $linha['id']?>">
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan='12' class='text-center'>
                                    <?php echo "Nenhum registro encontrado"; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="index.php" class="btn btn-primary text-white mb-4">Voltar para o Início</a>
    </div>
    <?php if ($mensagem): ?>
        <div class="alert alert-<?php echo $mensagem_tipo; ?> alert-dismissible fade show w-50 m-3" role="alert">
            <?php echo $mensagem; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div id="modalContainer"></div>
</body>
</html>
