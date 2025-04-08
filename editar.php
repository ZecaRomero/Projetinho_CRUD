<?php
require 'inc/conexao.php';
require 'inc/verificar.php';
require 'inc/menu.php';
require 'inc/topo.php';

// Verifica se o ID foi passado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do usuário não especificado.";
    exit;
}

$id = $_GET['id'];

// Buscar os dados do usuário
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

// Atualiza o usuário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $status = $_POST['status']; // Novo campo

    try {
        $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, telefone = ?, status = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $telefone, $status, $id]);
        echo "<div class='alert alert-success'>Usuário atualizado com sucesso!</div>";
        // Atualiza os dados para refletir no formulário
        $usuario['nome'] = $nome;
        $usuario['email'] = $email;
        $usuario['telefone'] = $telefone;
        $usuario['status'] = $status;
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao atualizar: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Editar Usuário</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($usuario['telefone']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Ativo" <?= $usuario['status'] === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="Inativo" <?= $usuario['status'] === 'Inativo' ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="usuarios_listar.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'inc/rodape.php'; ?>
