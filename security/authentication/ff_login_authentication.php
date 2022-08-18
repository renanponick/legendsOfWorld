				<div id="mensagemfinal">
						<?php
							$p_nome = $_POST['txtnomelogin'];
							$p_senha = $_POST['pwdsenha'];
							if($p_nome==""){
								echo "Preencha o campo Nome!";
							}else if($p_senha==""){
									echo "Preencha o campo Senha!";
								}else{
									//Alterando a Senha Para modo Encriptado
									$hash_senha = md5($salt.$p_senha);
									
									$sql_sel_autenticacao="SELECT login, senha, id, permissao FROM usuarios WHERE login='".addslashes($p_nome)."' AND senha='".$hash_senha."'";
									$sql_sel_autenticacao_resultado=$conexao->query($sql_sel_autenticacao);
									if($sql_sel_autenticacao_resultado->num_rows > 0){
										$sql_sel_autenticacao_dados = $sql_sel_autenticacao_resultado->fetch_array();
										// Iniciando sessão 
										session_start();
										$_SESSION['usuario'] = $p_nome;
										$_SESSION['permissao'] = $sql_sel_autenticacao_dados['permissao'];
										$_SESSION['id'] = $sql_sel_autenticacao_dados['id'];
										$_SESSION['idSessao'] = session_id();
										// Verificando permissao
										if($_SESSION['permissao'] == '0'){
											header("Location: system/admin/ff_main_admin.php");
										}else if($_SESSION['permissao'] == '1'){
												header("Location: system/client/ff_main_client.php");
											}else{
												echo "Permissão não confere.";
											}
									}else{
										echo "Dados incorretos, favor verificar Nome de Login e Senha";
										echo "<br><br>Se ainda não possui uma conta <a href='?folder=system/guest/client&file=ff_fmins_client&ext=html'>cadastre-se aqui</a>";
									}
								}
						?>
						<br>
						<br>
					<a href="index.php">Voltar</a>
				</div>