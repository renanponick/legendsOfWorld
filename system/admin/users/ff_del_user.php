			<?php
				$g_id = $_GET['id'];
				$msg="";
				$imagem="warning.png";
				$sql_sel_usuarios = "SELECT login FROM usuarios WHERE permissao='0'";
				$sql_sel_usuarios_resultado=$conexao->prepare($sql_sel_usuarios);
				$sql_sel_usuarios_resultado->execute();
				$sql_sel_verifica = $sql_sel_usuarios_resultado->rowCount();
				if($sql_sel_verifica==1){
							$msg="Não é possivel realizar essa operação. Pois não há administradores cadastrado no sistema.";
					}else{
						$tabela = "usuarios";
						$condicao = "id = '".$g_id."'";
						
						$resultado = deletar($tabela, $condicao);
						if($resultado){
							if($g_id==$_SESSION['id']){
								header("Location: ../../security/authentication/ff_logout_authentication.php");
							}else{
								$msg = "Excluido com Sucesso";
								$imagem = "ok.png";
							}
						}else{
								$msg="Erro ao efetuar a exclusão.".$conexao->error;
							}
						}
			?>
			<fieldset>
				<legend>Aviso</legend>
				<img src="../../layout/images/<?php echo $imagem;?>">
				<p><?php echo $msg;?></p>
				<a href="?folder=users&file=ff_fmins_user&ext=php"><button type="button">Retornar</button></a>
			</fieldset>