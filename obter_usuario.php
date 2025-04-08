<?php
require 'inc/conexao.php';
require 'inc/verificar.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        echo '
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="avatar-profile mb-4">
                    <span class="avatar-initial rounded-circle bg-primary text-white" style="width: 120px; height: 120px; font-size: 48px; line-height: 120px;">
                        '.strtoupper(substr($usuario['nome'], 0, 1)).'
                    </span>
                </div>
                <h4 class="mb-1">'.htmlspecialchars($usuario['nome']).'</h4>
                <span class="badge '.($usuario['ativo'] ? 'bg-success' : 'bg-secondary').' mb-3">
                    '.($usuario['ativo'] ? 'Ativo' : 'Inativo').'
                </span>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fad fa-info-circle me-2"></i>Informações Básicas</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <strong>ID:</strong> '.htmlspecialchars($usuario['id']).'
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>E-Mail:</strong> '.htmlspecialchars($usuario['email']).'
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Cadastrado em:</strong> '.date('d/m/Y H:i', strtotime($usuario['data_cadastro'])).'
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Último acesso:</strong> '.($usuario['ultimo_acesso'] ? date('d/m/Y H:i', strtotime($usuario['ultimo_acesso'])) : 'Nunca acessou').'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        exit;
    }
}

echo '<div class="alert alert-danger"><i class="fad fa-exclamation-triangle me-2"></i>Usuário não encontrado</div>';
?>