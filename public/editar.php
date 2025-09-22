<?php
$servername = "localhost";
$username   = "phpuser";
$password   = "DfC@1408php!";
$dbname     = "formulario_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id    = $_POST["id"];
    $nome  = $_POST["nome"];
    $idade = $_POST["idade"];
    $sql = "UPDATE usuarios SET nome=?, idade=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $nome, $idade, $id);
    $stmt->execute();
    header("Location: listar.php");
    exit();
} else {
    $id = $_GET["id"];
    $sql = "SELECT nome, idade FROM usuarios WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $idade);
    $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>"><br>
        Idade: <input type="number" name="idade" value="<?php echo htmlspecialchars($idade); ?>"><br>
        <input type="submit" value="Salvar">
    </form>
    <a href="listar.php">Voltar</a>
</body>
</html>
<?php $conn->close(); ?>