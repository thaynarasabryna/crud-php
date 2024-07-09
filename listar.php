<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pesquisar</title>
</head>
<body>
    <?php
        $pesquisa = $_POST['busca'] ?? '';
        include "conexao.php";

        $sql = "SELECT * FROM pessoas WHERE nome LIKE '%$pesquisa%'";
        $dados = mysqli_query($conn, $sql);
    ?>

    

    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <h1>Pesquisar</h1>
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline d-flex" action="listar.php" method="POST">
                        <input class="form-control mr-sm-2" type="search" placeholder="Nome" aria-label="Search" name="busca" autofocus>
                        <button class="btn btn-outline-success my-2 my-sm-0 m-2" type="submit">Pesquisar</button>
                    </form>
                </nav>
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Data de Nascimento</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($linha = mysqli_fetch_assoc($dados)) {
                            $cod_pessoa = $linha['cod_pessoa'];
                            $nome = $linha['nome'];
                            $endereco = $linha['endereco'];
                            $telefone = $linha['telefone'];
                            $email = $linha['email'];
                            $data_nascimento = $linha['data_nascimento'];
                            
                            echo "<tr>
                                    <th scope='row'>$nome</th>
                                    <td>$endereco</td>
                                    <td>$telefone</td>
                                    <td>$email</td>
                                    <td>$data_nascimento</td>
                                </tr>";
                        }
                    ?>
                        
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-primary text-white">Voltar para o Início</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html> 