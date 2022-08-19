	<fieldset>
		<legend>Cadastro de Administrador</legend>
		<form name="frmcadadmin" method="post" action="ff_main_admin.php?folder=users&file=ff_ins_user&ext=php" onsubmit="return verificar_administrador()">
			<table>
				<tr>
					<td width="40%">Nome:</td>
					<td><input type="text" name="txtnomelogin" maxlength="30" required></td>
				</tr>
				<tr>
					<td width="40%">Senha:</td>
					<td><input type="password" name="pwdsenha" maxlength="20" required></td>
				</tr>
				<tr id="mensagemObrigatoria">
					<td colspan="2" align="center">Todos os campos são obrigatórios</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>
	<?php
		$sql_sel_usuarios = "SELECT id, login FROM usuarios WHERE permissao = '0'";
		$sql_sel_usuarios_resultado = $conexao->prepare($sql_sel_usuarios);
		$sql_sel_usuarios_resultado->execute();
	?>
	<h4>Administradores Registrados</h4>
	<table border="1" width="550">
		<thead>
			<tr>
				<th width="60%">Usuário</th>
				<th width="10%">Editar</th>
				<th width="10%">Excluir</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($sql_sel_usuarios_resultado->rowCount() == 0){
			?>
				<tr>
					<td colspan='3'>Não possui nenhum registro.</td>
				</tr>
			<?php
				}else{
				//FETCH_ARRAY(extrai) transforma em array pega o nome da coluna do banco e transforma em uma chave
				//num_rows é o número de resultados encontrados. --- numero registros daquela consulta
				//fetch_array puxa um Dado do BD
					while ($sql_sel_usuarios_dados = $sql_sel_usuarios_resultado->fetch()){ 
			?>
						<tr>
							<td> <?php echo $sql_sel_usuarios_dados['login']; ?> </td>
							<td align="center"><a href="?folder=users&file=ff_fmupd_user&ext=php&id=<?php echo $sql_sel_usuarios_dados['id'];?>" title="Editar registro"><img src="../../layout/images/edit.png"></a></td>
							<td align="center"><a onclick="return excluir('o administrador <?php echo htmlentities($sql_sel_usuarios_dados['login'], ENT_QUOTES); ?>')" href="?folder=users&file=ff_del_user&ext=php&id=<?php echo $sql_sel_usuarios_dados['id'];?>" title="Excluir registro"><img src="../../layout/images/delete.png"></a></td>
						</tr>
					<?php }
				} ?>
		</tbody>
	</table>