<?php
$servername = "db";
$username = "user";
$password = "userpassword";
$dbname = "user_db";

// Conexão com o banco
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Buscar usuários
$sql = "SELECT id, nome, email FROM users ORDER BY id DESC";
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
            margin: 40px;
        }
        table {
            border-collapse: collapse;
            width: 60%;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Usuários Cadastrados</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row["id"]) ?></td>
                    <td><?= htmlspecialchars($row["nome"]) ?></td>
                    <td><?= htmlspecialchars($row["email"]) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Nenhum usuário cadastrado ainda.</p>
    <?php endif; ?>
    <a href="listar.php">Ver usuários cadastrados</a>

    <a href="index.php">← Voltar ao cadastro</a>
</body>
</html>

<?php
$conn->close();
?>
