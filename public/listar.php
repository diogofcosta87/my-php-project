<?php
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

// Buscar registros
$sql = "SELECT id, nome, idade FROM usuarios";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Usuários Cadastrados</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Ações</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Exibe cada registro
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["idade"]) . "</td>";
                echo "<td>
                        <a href='editar.php?id=" . urlencode($row["id"]) . "'>Editar</a> | 
                        <a href='excluir.php?id=" . urlencode($row["id"]) . "' onclick=\"return confirm('Tem certeza que deseja excluir?');\">Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum usuário cadastrado</td></tr>";
        }
        ?>
    </table>
    <a href="form.php">Voltar para o cadastro.</a>    
</body>
</html>
<?php
$conn->close();
?>
