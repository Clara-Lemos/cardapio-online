<?php
session_start();
$conn = new mysqli("localhost", "root", "", "cardapio_online");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];

    $stmt = $conn->prepare("SELECT * FROM clientes WHERE telefone = ?");
    $stmt->bind_param("s", $telefone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Este telefone já está cadastrado!'); window.location.href='cadastro.php';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO clientes (nome, telefone) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $telefone);

        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='cardapio.php';</script>";
        } else {
            echo "Erro: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente</title>
</head>
<body>
    <h1>Cadastro</h1>
    <form action="cadastro.php" method="POST">
        <div>
            <label for="nome">Nome</label><br>
            <input type="text" id="nome" name="nome" placeholder="Seu nome" required>
        </div>
        <br>
        <div>
            <label for="telefone">Telefone</label><br>
            <input type="text" id="telefone" name="telefone" placeholder="Seu telefone" required>
        </div>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
