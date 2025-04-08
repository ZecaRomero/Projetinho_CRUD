<?php
require 'inc/conexao.php';
require 'inc/verificar.php';
require 'inc/menu.php';
require 'inc/topo.php';

// Consultar todos os usuários no banco de dados
$stmt = $pdo->prepare("SELECT id, nome, email, telefone, data_cadastro, status FROM usuarios");

$stmt->execute();

// Obter todos os resultados como um array associativo
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Usuários</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listando Usuários</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="usuarios_cadastrar.php">
                        <button type="button" class="btn btn-primary">Cadastrar</button>
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Listagem</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-Mail</th>
                            <th>Telefone</th>
                            <th>Data de Cadastro</th>
                            <th>Status</th>
                            <th>Funções</th>
                        </tr>
                        </thead>
                        <tbody>
    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?= htmlspecialchars($usuario['id']) ?></td>
        <td><?= htmlspecialchars($usuario['nome']) ?></td>
        <td><?= htmlspecialchars($usuario['email']) ?></td>
        <td><?= htmlspecialchars($usuario['telefone']) ?></td>
        <td><?= htmlspecialchars($usuario['data_cadastro']) ?></td>
        <td><?= htmlspecialchars($usuario['status']) ?></td>
        <td>
            <div class="d-flex gap-2">
                <a href="editar.php?id=<?= $usuario['id'] ?>" 
                   class="btn btn-warning btn-sm">
                   <i class='bx bx-edit'></i> Editar
                </a>
                <a href="excluir.php?id=<?= $usuario['id'] ?>" 
                   class="btn btn-danger btn-sm" 
                   onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                   <i class='bx bx-trash'></i> Excluir
                </a>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>

<?php require 'inc/rodape.php'; ?>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
