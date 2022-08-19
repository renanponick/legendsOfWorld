	<?php
		//Recebendo Variaveis
		$g_id = $_GET['id'];
		//Entrando em contato com o banco Através de uma sintaxe
		$sql_sel_patrocinadores= "SELECT nome, url_logo FROM patrocinadores WHERE id='".$g_id."'";
		$sql_sel_patrocinadores_resultado = $conexao->prepare($sql_sel_patrocinadores);
		if($sql_sel_patrocinadores_resultado -> num_rows == 0){ ?>
		<fieldset>
			<legend>Aviso</legend>
			<br>Patrocinador Inexistente<br><br>
			<a href="?folder=sponsors&file=ff_fmins_sponsor&ext=php"><button type="button">Retornar</button></a>
			<br>
		</fieldset>
	<?php
	}else{
		$sql_sel_patrocinadores_dados = $sql_sel_patrocinadores_resultado->fetch();
	?>
		<!-- Mensagem final -->
		<fieldset>
			<legend>Alteração de Patrocinador</legend>
			<form name="frmcadpatroc" method="post" action="?folder=sponsors&file=ff_upd_sponsor&ext=php" onsubmit="return verificar_patrocinio()">
				<table>
					<input type="hidden" name="hidid" value="<?php echo $g_id;?>">
					<tr>
						<td width="40%">Nome:</td>
						<td><input type="text" name="txtnome_patroc" value="<?php echo htmlentities($sql_sel_patrocinadores_dados['nome'], ENT_QUOTES); ?>" maxlength="10" required></td>
					</tr>
					<tr>
						<td width="40%">URL da Imagem:</td>
						<td><input type="text" name="txturl_patroc" value="<?php echo htmlentities($sql_sel_patrocinadores_dados['url_logo'], ENT_QUOTES); ?>" required></td>
					</tr>
					<tr id="mensagemObrigatoria">
						<td colspan="2" align="center">Todos os campos são obrigatórios</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<a href="?folder=sponsors&file=ff_fmins_sponsor&ext=php"><button type="button">Retornar</button></a>
							<button type="submit">Salvar</button>
						</td>
					</tr>
				</table>
			</form>
		</fieldset>
<?php } ?>