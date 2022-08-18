	<?php
// .-. Recebendo dados .-. \\
			$p_nomelogin = $_POST ['txtnomelogin'];
			$p_senha = $_POST ['pwdsenha'];
// .-. Analizando dados recebidos(completos).-. \\
			$msg ="";
			$imagem = "warning.png";
			if ($p_nomelogin == ""){
				$msg = "Preencha o campo Nome!";
			}else if ($p_senha == ""){
					$msg = "Preencha o campo Senha!";
				}else{
					$sql_sel_usuarios = "SELECT login FROM usuarios WHERE login = '".addslashes($p_nomelogin)."'";
					$sql_sel_usuarios_resultado = $conexao->query($sql_sel_usuarios);
					if($sql_sel_usuarios_resultado->num_rows > 0){ //Quantas linhas ele executou no banco
						$msg = "Esse nome já está cadastrado.";
					}else{
					//Alterando a Senha Para modo Encriptado
						$hash_senha = md5($salt.$p_senha);
					// Atribuindo valores para utilizar na sintaxe.
						$tabela="usuarios";
						//campos = keys    -    valores = valor
						$dados= array(
							//keys => valor
							'login' => $p_nomelogin ,
							'senha' => $hash_senha ,
							'permissao' => "0"
						);
						$resultado = adicionar($tabela, $dados);
						if($resultado){
							$msg = "Cadastrado com Sucesso";
							$imagem="ok.png";
						}else{
							$msg="Erro ao efetuar o cadastro.".$conexao->error;
						}
					}
				}
			// Fim \\
			?>
			<!-- Mensagem final -->
			<fieldset>
				<legend>Aviso</legend>
				<img src="../../layout/images/<?php echo $imagem;?>">
					<p><?php echo $msg;?></p>
				
					<a href="?folder=users&file=ff_fmins_user&ext=php">
				
				<button type="button">Retornar</button></a>
			</fieldset>
			<!-- Fim -->