<?php
$server = "localhost";
$user = "root";
$pass = "root";
$bd = "gerenciamento_usuarios";

// Conectando ao banco de dados usando mysqli
$conn = mysqli_connect($server, $user, $pass, $bd);

// Verificando a conexão
if ($conn) {
    // echo "Conectado!";
} else {
    echo "Erro na conexão: " . mysqli_connect_error();
}

function mensagem($texto, $tipo){
    echo "<div class='alert alert-$tipo' role='alert'>$texto</div>";
}

?>
