<?php
	$permissao=1;
	include "../../security/authentication/ff_session_authentication.php";
	include "../../security/authentication/ff_permission_authentication.php";
	include "../../security/database/ff_connection_database.php";	
	//incluindo a pg de funções para BD
	include "../../addons/php/ff_dboperations_php.php";
	include "../../addons/php/ff_validations_php.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="author" content="renan ponick">
		<meta name="description" content="area restrita dos usuarios clientes">
		<meta charset="utf-8">
		<title>Festival dos Festivais</title>
		<link rel="stylesheet" href="../../layout/css/ff_layout_backend_css.css">
		<link rel="stylesheet" href="../../layout/css/ff_layout_client_css.css">
		<link rel="icon" type="image/png" href="../../layout/images/logo.png">
		<script type="text/javascript" src="../../addons/js/ff_validations_js.js"></script>
	</head>
	<body>
		<header>
			<img src="../../layout/images/logo_festival.png">
			<nav id='topbar'>
				<ul>
					<a href="?folder=reservation&file=ff_fmins_reservation&ext=php"><li><span class='icon ticket' ></span>Reserva de Ingressos</li></a>
					<a href="?folder=reservation&file=ff_view_reservation&ext=php"><li><span class='icon reservedticket' ></span>Ingressos reservados</li></a>
					<a href="?folder=profile&file=ff_view_profile&ext=php"><li><span class='icon profile' ></span>Seu Perfil</li></a>
				</ul>
			</nav>
			<a href="../../security/authentication/ff_logout_authentication.php"><span class='exit' title='Sair'></span></a>
		</header>
		<div id="content">
			<?php
			if((isset($_GET['folder']))&&(isset($_GET['file']))&&(isset($_GET['ext']))){
				if(!include $_GET['folder']."/".$_GET['file'].".".$_GET['ext']){
					$g_msg = "Página não encontrada!";
				}
			}else{
				if(isset($_GET['msg'])){
					$g_msg = $_GET['msg'];
				}else{
					$g_msg="Bem vindo ".$_SESSION['usuario'];		
				}
				include "ff_initial_client.php";
			}
			?>
		</div>
		<footer>
			&copy; Copyright 2014 Renan Ponick. Todos os direitos reservados.
		</footer>
	</body>
</html>