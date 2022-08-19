			<?php
				$p_nomelogin = $_POST['txtnomelogin'];
				$p_senha = $_POST['pwdsenha'];
				$p_id = $_POST['hidid'];
				
				$url_retorno="?folder=users&file=ff_fmupd_user&ext=php&id=".$p_id;
				$msg ="";
				$imagem = "warning.png";
				
				if($p_nomelogin==""){
					$msg="Preencha o campo Nome De Usuário";
				
				}else if($p_senha==""){
						$msg="Preencha o campo Senha";
					//Entrando em contato com o banco Através de uma sintaxe
					}else{
						$sql_sel_usuarios = "SELECT login FROM usuarios WHERE login = '".addslashes($p_nomelogin)."' AND id<>'".$p_id."'";
						$sql_sel_usuarios_resultado = $conexao->prepare($sql_sel_usuarios);
						$sql_sel_usuarios_resultado->execute();
						if($sql_sel_usuarios_resultado->rowCount() > 0){ //Quantas linhas ele executou no banco
							$msg = "Esse administrador já está cadastrado.";
							//Entrando em contato com o banco Através de uma sintaxe
						}else{
							//Alterando a Senha Para modo Encriptado
							$hash_senha = md5($salt.$p_senha);
							$tabela="usuarios";
							$dados=array(
								'login' => $p_nomelogin,
								'senha' => $hash_senha
							);
							$condicao="id='".$p_id."'";
							$resultado = alterar($tabela, $dados, $condicao);
							
							if($resultado){
								if($_SESSION['id']==$p_id){
									$_SESSION['usuario'] = $p_nomelogin;
								}
								$msg="Alterado com sucesso";
								$imagem="ok.png";
								$url_retorno="?folder=users&file=ff_fmins_user&ext=php";
							}else{
								$msg="Erro ao efetuar a alteração".$conexao->error;
							}
						}
					}
			?>
			<fieldset>
				<legend>Aviso</legend>
				<img src="../../layout/images/<?php echo $imagem;?>">
				<p><?php echo $msg;?></p>
				<a href="<?php echo $url_retorno;?>"><button type="button">Retornar</button></a>
			</fieldset>