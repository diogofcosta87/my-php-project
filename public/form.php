<?php
// Dados de conexão
$servername = "localhost";
$username   = "phpuser";
$password   = "DfC@1408php!";
$dbname     = "formulario_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"] ?? "";
    $idade = $_POST["idade"] ?? "";

    // Validação: verifica se o nome já existe
    $check = $conn->prepare("SELECT id FROM usuarios WHERE nome = ?");
    $check->bind_param("s", $nome);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<h2>Erro: Este nome já está cadastrado!</h2>";
    } else {
        // Previne SQL Injection com prepared statement
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, idade) VALUES (?, ?)");
        $stmt->bind_param("si", $nome, $idade);

        if ($stmt->execute()) {
            echo "<h2>Dados salvos com sucesso!</h2>";
        } else {
            echo "Erro: " . $stmt->error;
        }

        $stmt->close();
    }
    $check->close();
}

// Mostrar formulário
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário com Banco de Dados</title>
</head>
<body>
    <h1>Digite seus dados</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br><br>

        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" required>
        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <br>
    <!-- Link fixo para lista -->
    <a href="listar.php">Ver lista de usuários</a>
</body>
</html>
