<?php 
require 'inc/conexao.php';
require 'inc/verificar.php';
require 'inc/menu.php';
require 'inc/topo.php';

$stmt = $pdo->prepare("SELECT COUNT(*) AS total_usuarios FROM usuarios");
$stmt->execute();
$result = $stmt->fetch();
?>


		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                   <div class="col">
					 <div class="card radius-10 border-start border-0 border-3 border-info">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<p class="mb-0 text-secondary">Total de Usuários</p>
									<h4 class="my-1 text-info"><?php echo $result['total_usuarios']; ?></h4>
								</div>
								<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
								</div>
							</div>
						</div>
					 </div>
				   </div>
				</div><!--end row-->
			</div>
		</div>
		<!--end page wrapper -->

<?php 
require 'inc/rodape.php';
?>