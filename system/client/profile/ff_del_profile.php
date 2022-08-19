			<h2> Aviso </h2>
			<?php
				$imagem="alert_icon.png";
				$url_retorno="?folder=profile&file=ff_view_profile&ext=php";
				$sql_sel_reservas="SELECT reservas.clientes_id, 
												usuarios.id, 
												clientes.usuarios_id,
												clientes.id
												FROM reservas
											INNER JOIN clientes ON (reservas.clientes_id = clientes.id)
											INNER JOIN usuarios ON (clientes.usuarios_id = usuarios.id) 
											WHERE usuarios.id='".$_SESSION['id']."'";
				$sql_sel_reservas_resultado=$conexao->prepare($sql_sel_reservas);
				$sql_sel_reservas_resultado->execute();
				if($sql_sel_reservas_resultado->rowCount() > 0){
					$msg="<br>Não é possivel Deletar esta conta<br>MOTIVO<br>Ingressos foram reservados<br>SOLUÇÃO<br>Canselar todas as reservas.";
				}else{
					
					$tabela="clientes";
					$condicao="usuarios_id='".$_SESSION['id']."'";
					$resultado = deletar($tabela, $condicao);
					
					if(!$resultado){
						$msg="Erro ao efetuar a exclusão na tabela CLIENTES !!!".$conexao->error;
					}else{
						$tabela="usuarios";
						$condicao="id='".$_SESSION['id']."'";
						$resultado = deletar($tabela, $condicao);
						if(!$resultado){
							$msg="Erro ao efetuar a exclusão na tabela USUARIOS !!!".$conexao->error;
							}else{
								header("Location: ../../security/authentication/ff_logout_authentication.php");
						}
					}
				}
			?>				
			<div id='mensagem'>
				<h1><img src="../../layout/images/<?php echo $imagem; ?>" height='60px' width='60px'> <?php echo $msg; ?></h1>
				<a href="<?php  echo $url_retorno;?>""><button type="button">Retornar</button></a>
			</div>