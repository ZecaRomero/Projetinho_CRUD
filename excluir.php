<?php
require 'inc/conexao.php';
require 'inc/verificar.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    try {
        // Verificar se não é o último usuário
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios");
        $total_usuarios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        if ($total_usuarios <= 1) {
            $_SESSION['mensagem'] = '<div class="alert alert-danger">Não é possível excluir o último usuário!</div>';
        } else {
            // Excluir o usuário
            $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->execute([$id]);
            
            if ($stmt->rowCount() > 0) {
                $_SESSION['mensagem'] = '<div class="alert alert-success">Usuário excluído com sucesso!</div>';
            } else {
                $_SESSION['mensagem'] = '<div class="alert alert-warning">Usuário não encontrado!</div>';
            }
        }
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = '<div class="alert alert-danger">Erro ao excluir: ' . $e->getMessage() . '</div>';
    }
}

header("Location: usuarios_listar.php");
exit;