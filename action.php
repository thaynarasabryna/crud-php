<?php
    include "conexao.php";

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "INSERT INTO `pessoas`(`nome`, `endereco`, `telefone`, `email`, `data_nascimento`) VALUES ('$nome', '$endereco', '$telefone', '$email', '$data_nascimento')";

    if (mysqli_query($conn, $sql)) {
        mensagem("$nome cadastrado com sucesso!", 'success');
    } else {
        mensagem("$nome NAO foi cadastrado.", 'danger');
    }  
?>
<a href="index.php" class="btn btn-primary">Voltar</a>