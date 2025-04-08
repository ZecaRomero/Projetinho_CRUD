<?php
require 'inc/conexao.php';
require 'inc/verificar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
    
    if ($id && ($status === 0 || $status === 1)) {
        $stmt = $pdo->prepare("UPDATE usuarios SET ativo = ? WHERE id = ?");
        if ($stmt->execute([$status, $id])) {
            echo json_encode(['success' => true]);
            exit;
        }
    }
}

echo json_encode(['success' => false]);
?>