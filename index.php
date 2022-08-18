<?php
	session_start();
	include "security/database/ff_connection_database.php"; 
	include "addons/php/ff_dboperations_php.php";
	include "addons/php/ff_validations_php.php";
	include "addons/php/ff_messagerepository_php.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Legends of World - Home</title>
		<script type="text/javascript" src="addons/js/ff_validations_js.js"></script>
		
		<meta name="author" content="Renan Ponick"/>
		<meta type="keywords" content="festival, musica, festa, bandas, melhor"/>
		<meta type="description" content="Essa página conterá informações sobre o festival" />
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="layout/css/ff_frontend_css.css">
		<link rel="icon" type="image/png" href="layout/images/logo.png" />
	</head>
	<body>
		<div id="global">
			<header>
				<div id="titulo">Legends of World</div>
				<div id="menu">
					<nav>
						<ul>
							<a href="index.php" >
								<li>Home</li>
							</a>
							<a href="?folder=system/guest/pages&file=ff_info_pages&ext=html">
								<li>Informações</li>
							</a>
							<a href="?folder=system/guest/pages&file=ff_lineup_pages&ext=php">	
								<li>Atrações</li>
							</a>
							<a href="?folder=system/guest/pages&file=ff_schedule_pages&ext=php">
								<li>Programação</li>
							</a>
							<a href="?folder=system/guest/client&file=ff_fmins_client&ext=html">
								<li>Cadastro</li>
							</a>
						</ul>
					</nav>
				</div>
			</header>
			<div id="barra_lateral">
				<div id="img_titulo"> 
					<img src="layout/images/logo_festival.png"/> 
				</div>
				<form name="frmautenticacao" action="?folder=security/authentication&file=ff_login_authentication&ext=php" method="post" onsubmit="return verifica_login()">
					<div id="logar">
						<div class="ajustar_lateral">
							Nome</br>
						</div>
						<div class="ajustar_lateral"> 
							<input name="txtnomelogin" maxlength="30" type="text" size="13" required placeHolder="Nome">
						</div>
						
						<div class="ajustar_lateral">
							Senha</br>
						</div>
						<div class="ajustar_lateral">
							<input name="pwdsenha" type="password" maxlength="32" required size="13" placeHolder="Senha">
						</div>
						<div class="ajustar_lateral">
							<button type="submit" name="btnenviar">Entrar</button>
						</div>
					</div>
				</form>
				<div class="redes_sociais ajustar_centro">
					<div>Conecte-se:</div>
					<a href="http://www.google.com.br" >
						<img src="layout/images/icone_facebook.png" title="Vai pro google" class="icones_laterais">
					</a>
					<a href="http://www.google.com.br" >
						<img src="layout/images/icone_instagram.png" title="Vai pro google" class="icones_laterais">
					</a>
					<a href="http://www.google.com.br" >
						<img src="layout/images/icone_twiter.png" title="Vai pro google" class="icones_laterais">
					</a>
				</div>
				
			</div>
				<div id="conteudo">
					<?php
						if((isset($_GET['folder']))&&(isset($_GET['file']))&&(isset($_GET['ext']))){ // Verifica se As Variaveis GET's estão vazias caso realizar alguma ação
							if(!include $_GET['folder']."/".$_GET['file'].".".$_GET['ext']){		 // Verifica se nào conseguiu incluir
								echo "<center>Página não encontrada!</center>";						//Exibe a mensagem que não encontrou o arquivo q seria incluido
							}
						}else{
							include "system/guest/pages/ff_initial_pages.html";						// joga pra principal
						}
					?>
				</div>
			<footer>
				<div class="divisao_patrocinio">
					<?php
					$sql_sel_patrocinio="SELECT url_logo, nome FROM patrocinadores"; 
					$sql_sel_patrocinio_resultado=$conexao->query($sql_sel_patrocinio);
					if($sql_sel_patrocinio_resultado->num_rows==0){
						?>
							<div>Espaço para Patrocinio.</div>
						<?php
					}else{
						while($sql_sel_patrocinio_dados=$sql_sel_patrocinio_resultado->fetch_array()){
					?>
							<div class="patrocinadores">
								<img src="<?php echo $sql_sel_patrocinio_dados['url_logo'];?>" title="<?php echo $sql_sel_patrocinio_dados['nome'];?>" width="55px" height="55px" />
							</div>
					<?php
						}
					}
					?>
				</div>
				<div>
					&copy;Direitos Autorais - Renan Ponick
				</div>
			</footer>
			<?php $conexao->close();?>
		</div>
	</body>
</html>