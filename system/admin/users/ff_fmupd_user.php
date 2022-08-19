<?php
	$g_id = $_GET['id'];
	//Entrando em contato com o banco Através de uma sintaxe
	$sql_sel_usuarios="SELECT login FROM usuarios WHERE id='".$g_id."'";
	$sql_sel_usuarios_resultado=$conexao->prepare($sql_sel_usuarios);
	$sql_sel_usuarios_resultado->execute();
	if($sql_sel_usuarios_resultado -> num_rows == 0){ ?>
		<fieldset>
			<legend>Aviso</legend>
			<br>Administrador Inexistente<br><br>
			<a href="?folder=users&file=ff_fmins_user&ext=php"><button type="button">Retornar</button></a>
			<br>
		</fieldset>
	<?php
	}else{
		$sql_sel_usuarios_dados = $sql_sel_usuarios_resultado->fetch();
	?>
		<fieldset>
			<legend>Alteração de Administrador</legend>
			<form name="frmcadadmin" method="post" action="?folder=users&file=ff_upd_user&ext=php" onsubmit="return verificar_administrador()">
				<table>
					<input type="hidden" name="hidid" value="<?php echo $g_id;?>">
					<tr>
						<td width="40%">Nome:</td>
						<td><input required type="text" name="txtnomelogin" maxlength="30" value="<?php echo htmlentities($sql_sel_usuarios_dados['login'], ENT_QUOTES); ?>"></td>
					</tr>
					<tr>
						<td width="40%">Senha:</td>
						<td><input required type="password" name="pwdsenha" maxlength="20"></td>
					</tr>
					<tr id="mensagemObrigatoria">
						<td colspan="2" align="center">Todos os campos são obrigatórios</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<a href="?folder=users&file=ff_fmins_user&ext=php"><button type="button">Retornar</button></a>
							<button type="submit">Salvar</button>
						</td>
					</tr>
				</table>
			</form>
		</fieldset>
<?php } ?>