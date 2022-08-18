<?php
	//pois so o usurario com permição 0 pode entrar aqui.
	$permissao=0;
	//incluindo autenticação
	include "../../security/authentication/ff_session_authentication.php";
	include "../../security/authentication/ff_permission_authentication.php";
	//incluindo a Conexao com o Banco
	include "../../security/database/ff_connection_database.php";
	//incluindo a pg de funções para BD
	include "../../addons/php/ff_dboperations_php.php";
	include "../../addons/php/ff_validations_php.php";
	include "../../addons/php/ff_messagerepository_php.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="author" content="escola sistemica">
		<meta name="description" content="area restrita dos usuarios administradores">
		<meta charset="utf-8">
		<title>Administração - Legends Of World</title>
		<link rel="stylesheet" href="../../layout/css/ff_layout_backend_css.css">
		<link rel="icon" type="image/png" href="../../layout/images/logo.png" />
		<script type="text/javascript" src="../../addons/js/ff_validations_js.js"></script>
	</head>
	<body>
		<header>
			<img src="../../layout/images/logo_festival.png">
			<h3>Administração - Legends Of World</h3>
			<a href="../../security/authentication/ff_logout_authentication.php" title="Sair do sistema"><button type="button" class="btnlogout">Sair</button></a>
			<h4>Olá, <a href="ff_main_admin.php" title="Editar seus dados"><?php echo $_SESSION['usuario'];?></a></h4>
		</header>
		<div id="sidebar">
			<nav>
				<h4>Gestão de Conteúdo</h4>
				<ul>		
					<a href="?folder=dates&file=ff_fmins_date&ext=php"><li>Registro de Data</li></a>
					<a href="?folder=bands&file=ff_fmins_band&ext=php"><li>Registro de Banda</li></a>
					<a href="?folder=tickets&file=ff_fmins_ticket&ext=php"><li>Registro de Ingressos Disponíveis por Dia</li></a>
					<a href="?folder=sponsors&file=ff_fmins_sponsor&ext=php"><li>Registro de Patrocinador</li></a>
				</ul>
				<h4>Gestão de Negócio</h4>
				<ul>
					<a href="?folder=users&file=ff_fmins_user&ext=php"><li>Registro de Administrador</li></a>
					<a href="?folder=reservations&file=ff_view_reservation&ext=php"><li>Declinar Reservas</li></a>
					<a href="?folder=reports&file=ff_viewreservation_report&ext=php"><li>Relatório de Ingressos Reservados</li></a>
					<a href="?folder=reports&file=ff_viewfinancial_report&ext=php"><li>Relatório Financeiro</li></a>
					<a href="?folder=reports&file=ff_viewcancelation_report&ext=php"><li>Estatística de Cancelamento</li></a>
				</ul>
			</nav>
		</div>
		<div id="content">
				<?php
					//isset verifica se uma variavel existe, se ela tem valor
					// folder = Pasta.
					// file = arquivo para abrir.
					// ext = extenção do arquivo.
					// esse if verificara se a pagina estará setada
					if((isset($_GET['folder']))&&(isset($_GET['file']))&&(isset($_GET['ext']))){	 // Verifica se As Variaveis GET's estão vazias caso realizar alguma ação
						if(!include $_GET['folder']."/".$_GET['file'].".".$_GET['ext']){			// Verifica se nào conseguiu incluir
							echo "Página não encontrada!";											//Exibe a mensagem que não encontrou o arquivo q seria incluido
						}
					}else{
						if(isset($_GET['msg'])){
							$g_msg = $_GET['msg'];
						}else{
							$g_msg="Bem vindo ".$_SESSION['usuario'];		
						}
						include "ff_initial_admin.php";								// joga pra principal exibindo uma mensagem programada
					}
					
				?>
				
		</div>
		<footer>
			&copy; Copyright 2015 Renan Ponick. Todos os direitos reservados.
		</footer>
	</body>
</html>