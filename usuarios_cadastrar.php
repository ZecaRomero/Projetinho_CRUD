<?php
require 'inc/conexao.php';
require 'inc/verificar.php';
require 'inc/menu.php';
require 'inc/topo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $status = $_POST['status']; // <-- Novo campo

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $status]);
}
?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Usuários</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="index.php"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Usuário</li>
                    </ol>
                </nav>
            </div>
        </div>

        <h6 class="mb-0 text-uppercase">Cadastrar Novo Usuário</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="usuarios_cadastrar.php">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="usuarios_listar.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'inc/rodape.php'; ?>
