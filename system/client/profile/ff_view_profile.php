		<h2> Perfil </h2>
		<?php
			$sql_sel_clientes="SELECT * FROM clientes WHERE usuarios_id='".$_SESSION['id']."'";
			$sql_sel_clientes_resultado=$conexao->prepare($sql_sel_clientes);
			if(!$sql_sel_clientes_resultado){
				$msg="Erro".$conexao->error;
			?>	<h1><img src="../../layout/images/alert_icon.png" height='60px' width='60px'> <?php echo $msg; ?></h1><?php
			}else{
				while($sql_sel_clientes_dados=$sql_sel_clientes_resultado->fetch()){
					if($sql_sel_clientes_dados['tipo_doc']=="1"){
						$documento="CPF:";
					}else if($sql_sel_clientes_dados['tipo_doc']=="2"){
							$documento="RG:";
						}else{
							$documento="Passaporte:";
						}
			//transformando pra fomato br
				$data = implode('/', array_reverse(explode('-', $sql_sel_clientes_dados['nascimento']))); 
				// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
				// $data = implode('/', array_reverse(array(2014, 12, 15));
				// $data = implode('/', array(15, 12, 2014); 
				// $data = 15/12/2014;
		?>
			<fieldset>
				<table>
					<tr>
						<th colspan="2">Pessoal
							<a href="?folder=profile&file=ff_fmupdpersonal_profile&ext=php"><img src="../../layout/images/edit.png" title="Editar Informações Pessoais" height="15px" width="15px" style="float:right"/></a>
						</th>
					</tr>
					<tr>
						<td>Nome: </td>
						<td><?php echo htmlentities($sql_sel_clientes_dados['nome'], ENT_QUOTES);?></td>
					</tr>
					<tr>
						<td>Data de Nascimento: </td>
						<td><?php echo $data;?></td>
					</tr>
					<tr>
						<td><?php echo $documento;?></td>
						<td><?php echo htmlentities($sql_sel_clientes_dados['num_doc'], ENT_QUOTES);?></td>
					</tr>
					<tr>
						<td>Telefone: </td>
						<td><?php echo htmlentities($sql_sel_clientes_dados['telefone'], ENT_QUOTES);?></td>
					</tr>
					<tr>
						<td>E-mail: </td>
						<td><?php echo htmlentities($sql_sel_clientes_dados['email'], ENT_QUOTES);?></td>
					</tr>
					<tr>
						<th colspan="2">Acesso
							<a href="?folder=profile&file=ff_fmupdaccess_profile&ext=php"><img src="../../layout/images/edit.png" title="Editar Acesso" height="15px" width="15px" style="float:right"/></a>
						</th>
					</tr>
					<tr>
						<td>Usuário: </td>
						<td><?php echo $_SESSION['usuario']?></td>
					</tr>
				</table>
				<a onclick="return excluir('sua conta')" href='?folder=profile&file=ff_del_profile&ext=php'>Excluir Usuario<img src="../../layout/images/delete.png" title="Excluir usuário" height="20px" width="20px"/></a>
			</fieldset>
		<?php }
		}?>