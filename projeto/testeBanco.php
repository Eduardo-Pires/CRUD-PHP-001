<?php
require "pgConnection.php";
$pdo = postgresConnect();

try {
    $stmt = $pdo->prepare("INSERT INTO test (nome) VALUES (:nome)");

    $nomes = ["João", "Maria", "Pedro", "Ana"];

    foreach ($nomes as $nome) {
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
    }

    echo "Dados inseridos com sucesso!";
} catch (Exception $e) {
    echo "Ocorreu um erro ao inserir os dados: " . $e->getMessage();
}
?>
