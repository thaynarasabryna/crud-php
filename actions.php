<?php
    include "conexao.php";

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "INSERT INTO `pessoas`(`nome`, `endereco`, `telefone`, `email`, `data_nascimento`) VALUES ('$nome', '$endereco', '$telefone', '$email', '$data_nascimento')";

    echo '<pre>';
    print_r();
    die;

    if (mysqli_query($conn, $sql)) {
        header('Location: cadastrar.php');
        mensagem("$nome cadastrado com sucesso!", 'success');
    } else {
        mensagem("$nome NAO foi cadastrado.", 'danger');
    }  
?>