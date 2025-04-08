<?php
session_start();
require 'inc/conexao.php'; // Arquivo de conexão com o banco

$senha_errada = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    
    // Verifica se os campos estão vazios
    if (empty($email) || empty($senha)) {
        $senha_errada = "<div class='alert alert-danger'>Preencha todos os campos!</div>";
    } else {
        try {
            // Buscar usuário no banco
            $stmt = $pdo->prepare("SELECT id, email, senha FROM usuarios WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar se o usuário existe e a senha está correta
            if ($user && password_verify($senha, $user['senha'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                header("Location: principal.php");
				die();
                exit;
            } else {
                $senha_errada = "<div class='alert alert-danger'>E-mail ou senha inválidos!</div>";
            }
        } catch (PDOException $e) {
            die("Erro no banco: " . $e->getMessage());
        }
    }
}
?>



<!doctype html>
<html lang="pt-BR">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>Jornada do Programador</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="assets/images/logo-img.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Login</h3>		

										
									</div>
									
									<div class="login-separater text-center mb-4"> <span>Entre com seu Login e Senha</span>
										<hr/>
									</div>
									<div class="form-body">
									<form name="Login" id="Login" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">

									<?php 
if (!empty($senha_errada)) {
    echo $senha_errada;
}
?>


											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Coloque seu E-mail:</label>
												<input type="email" class="form-control" id="email" 
												name="email"
												placeholder="Informe seu e-mail de acesso">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Coloque sua senha:</label>
												<div class="input-group" id="show_hide_password">
												<input type="password" class="form-control border-end-0" id="senha" name="senha" placeholder="Informe sua senha"><a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											
											
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>ENTRAR </button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>