<?php
session_start();
$conn = new mysqli("localhost", "root", "", "cardapio_online");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$sql = "SELECT * FROM itens_cardapio WHERE ativo = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardapio</title>
</head>
<body>
    <h1>Cardapio</h1>

   <?php if ($result->num_rows > 0): ?>
       <?php while($item = $result->fetch_assoc()): ?>

        <hr>
        <h2><?php echo htmlspecialchars($item['nome']); ?></h2>
        <p><strong>Descrição</strong> <?php echo nl2br(htmlspecialchars($item['descricao'])); ?></p>
        <p><strong>Preço:</strong> R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
            <p><strong>Categoria:</strong> <?php echo htmlspecialchars($item['categoria']); ?></p>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhum item disponível no cardápio.</p>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
