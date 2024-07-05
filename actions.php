<?php
    session_start();

    include "conexao.php";

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "INSERT INTO `pessoas`(`nome`, `endereco`, `telefone`, `email`, `data_nascimento`) VALUES ('$nome', '$endereco', '$telefone', '$email', '$data_nascimento')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['alerta'] = "$nome cadastrado com sucesso!";
        $alerta_cadastro = 'success';
    } else {
        $_SESSION['alerta'] = "$nome NÃO foi cadastrado.";
        $alerta_cadastro = 'danger';
    }
    
    header('Location: cadastrar.php');
    exit;


    $conn->close();
?>
