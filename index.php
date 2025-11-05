<?php
$servername = "db"; // Nome do serviço no docker-compose
$username = "user";
$password = "userpassword";
$dbname = "user_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Inserir dados no banco (com proteção contra SQL injection)
    $stmt = $conn->prepare("INSERT INTO users (nome, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $email);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Novo registro criado com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Erro: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"] {
            width: 250px;
            padding: 8px;
            margin: 5px 0;
        }
        input[type="submit"], button {
            padding: 8px 15px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover, input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    
    <form action="" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>

    <!-- Botão para listar usuários -->
    <form action="listar.php" method="get">
        <button type="submit">Ver usuários cadastrados</button>
    </form>
</body>
</html>
