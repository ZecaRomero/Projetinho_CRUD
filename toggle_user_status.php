<?php
require 'inc/conexao.php';
require 'inc/verificar.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
    
    if ($id !== false && $status !== false) {
        $stmt = $pdo->prepare("UPDATE usuarios SET ativo = ? WHERE id = ?");
        if ($stmt->execute([$status, $id])) {
            echo json_encode(['success' => true]);
            exit;
        }
    }
}

echo json_encode(['success' => false]);
?>