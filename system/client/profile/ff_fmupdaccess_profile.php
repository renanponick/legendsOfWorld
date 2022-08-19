			<h2> Alterar Perfil de Acesso </h2>
		<?php
			$sql_sel_usuarios="SELECT login FROM usuarios WHERE id='".$_SESSION['id']."'";
			$sql_sel_usuarios_resultado=$conexao->prepare($sql_sel_usuarios);
			$sql_sel_usuarios_resultado->execute();
			if(!$sql_sel_usuarios_resultado){
				$msg="Erro".$conexao->error;
			?><h1><img src="../../layout/images/alert_icon.png" height='60px' width='60px'> <?php echo $msg; ?></h1><?php
			}else{
				$sql_sel_usuarios_dados=$sql_sel_usuarios_resultado->fetch();
		?>
			<fieldset>
				<table>
					<form name="frmalteracao" action="?folder=profile&file=ff_updaccess_profile&ext=php"  onsubmit="return verifica_acesso()" method="post">
						<tr>
							<td>Nome: </td>
							<td><input type="text" name="txtnome" maxlength="30" value="<?php echo htmlentities($sql_sel_usuarios_dados['login'], ENT_QUOTES);?>" readonly></td>
						</tr>
						<tr>
							<td>Senha:</td>
							<td><input required type="password" name="pwdsenha" maxlength="20" value=""></td>
						</tr>
						<tr id="mensagemObrigatoria">
							<td colspan="2" align="center">Todos os campos são obrigatórios</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<a href="?folder=profile&file=ff_view_profile&ext=php"><button type="button" >Retornar</button></a>
								<button type="submit">Enviar</button>
							</td>
						</tr>
					</form>
				</table>
			</fieldset>
		<?php }?>