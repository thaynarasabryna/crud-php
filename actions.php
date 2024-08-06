<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<?php
    include "conexao.php";
    session_start();

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // INSERIR DADOS NOS CAMPOS PARA EDITAR
        $sql = "SELECT p.id, p.nome, p.email, p.cpf, p.data_nascimento, e.cep, e.logradouro, e.numero, e.complemento, e.bairro, e.cidade, e.uf 
                FROM pessoas p 
                LEFT JOIN enderecos e ON p.id = e.id_pessoas 
                WHERE p.id = {$_POST['id']}";
        $dados = mysqli_query($conn, $sql);
        $linha = mysqli_fetch_assoc($dados);
        if (!empty($linha)) {
            $_SESSION['dados'] = $linha;
            header('Location: cadastro.php');
            exit();
        }
    } elseif (isset($_POST['id_edit']) && !empty($_POST['id_edit'])) {
        mysqli_begin_transaction($conn);
        
        // ALTERAR PESSOAS
        $sql_pessoas_update =  "UPDATE pessoas SET 
                                    nome = '{$_POST['data']['pessoas']['nome']}', 
                                    email = '{$_POST['data']['pessoas']['email']}',
                                    cpf = '{$_POST['data']['pessoas']['cpf']}',
                                    data_nascimento = '{$_POST['data']['pessoas']['data_nascimento']}'
                                WHERE id = {$_POST['id_edit']}";

        if (!mysqli_query($conn, $sql_pessoas_update)) {
            throw new Exception("Erro ao alterar pessoa: " . mysqli_error($conn));
        }
        
        // ALTERAR ENDEREÇOS
        $sql_endereco_update = "UPDATE enderecos SET
                                    cep = '{$_POST['data']['enderecos']['cep']}',
                                    logradouro = '{$_POST['data']['enderecos']['logradouro']}',
                                    numero = '{$_POST['data']['enderecos']['numero']}',
                                    complemento = '{$_POST['data']['enderecos']['complemento']}',
                                    bairro = '{$_POST['data']['enderecos']['bairro']}',
                                    cidade = '{$_POST['data']['enderecos']['cidade']}',
                                    uf = '{$_POST['data']['enderecos']['uf']}'
                                WHERE id_pessoas = {$_POST['id_edit']}";

        if (!mysqli_query($conn, $sql_endereco_update)) {
            throw new Exception("Erro ao alterar endereço: " . mysqli_error($conn));
        }
        $_SESSION['mensagem'] = "{$_POST['data']['pessoas']['nome']} alterado com sucesso!";
        $_SESSION['mensagem_tipo'] = 'success';
        mysqli_commit($conn);
    } elseif (isset($_POST['id_excluir']) && !empty($_POST['id_excluir'])) {
        // SELECIONAR PESSOA PARA EXCLUIR
        $sql_select_delete = "SELECT nome FROM pessoas WHERE id = {$_POST['id_excluir']}";
        $result = mysqli_query($conn, $sql_select_delete);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nome_pessoa = $row['nome'];

            // EXCLUIR PESSOA
            $sql_delete = "DELETE FROM pessoas WHERE id = {$_POST['id_excluir']}";

            if (mysqli_query($conn, $sql_delete)) {
                $_SESSION['mensagem'] = "$nome_pessoa excluído(a) com sucesso!";
                $_SESSION['mensagem_tipo'] = 'success';
            } else {
                $_SESSION['mensagem'] = "Erro ao excluir: " . mysqli_error($conn);
                $_SESSION['mensagem_tipo'] = 'danger';
            }
        }
    } else {
        mysqli_begin_transaction($conn);
        
        // INSERIR DADOS PESSOAS
        $sql_pessoas_insert = "INSERT INTO pessoas (
            nome,
            email,
            cpf,
            data_nascimento)
        VALUES (
            '{$_POST['data']['pessoas']['nome']}',
            '{$_POST['data']['pessoas']['email']}',
            '{$_POST['data']['pessoas']['cpf']}',
            '{$_POST['data']['pessoas']['data_nascimento']}'
        )";

        if (!mysqli_query($conn, $sql_pessoas_insert)) {
            throw new Exception("Erro ao cadastrar pessoa: " . mysqli_error($conn));
        }

        // PEGAR ID DA TABELA PESSOAS
        $id_pessoas = mysqli_insert_id($conn);

        // INSERIR DADOS ENDEREÇOS
        $sql_endereco_insert = "INSERT INTO enderecos (
            id_pessoas,
            cep,
            logradouro,
            numero,
            complemento,
            bairro,
            cidade,
            uf)
        VALUES (
            $id_pessoas,
            '{$_POST['data']['enderecos']['cep']}',
            '{$_POST['data']['enderecos']['logradouro']}',
            '{$_POST['data']['enderecos']['numero']}',
            '{$_POST['data']['enderecos']['complemento']}',
            '{$_POST['data']['enderecos']['bairro']}',
            '{$_POST['data']['enderecos']['cidade']}',
            '{$_POST['data']['enderecos']['uf']}'
        )";

        if (!mysqli_query($conn, $sql_endereco_insert)) {
            throw new Exception("Erro ao cadastrar endereço: " . mysqli_error($conn));
        }
        $_SESSION['mensagem'] = "{$_POST['data']['pessoas']['nome']} cadastrado com sucesso!";
        $_SESSION['mensagem_tipo'] = 'success';
        mysqli_commit($conn);

    }
    
    header('Location: '. (!empty($_POST['id_edit']) || !empty($_POST['id_excluir']) ? "listar.php" : "cadastro.php"));
    exit;

    $conn->close();
?>
