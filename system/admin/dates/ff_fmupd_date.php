<?php
	//Recebendo Variaveis
	$g_id = $_GET['id'];
	//Entrando em contato com o banco Através de uma sintaxe
	$sql_sel_datas="SELECT dia, descricao FROM datas WHERE id='".$g_id."'";
	//Executando Sintaxe
	$sql_sel_datas_resultado = $conexao->prepare($sql_sel_datas);
	if($sql_sel_datas_resultado -> num_rows == 0){ ?>
		<fieldset>
			<legend>Aviso</legend>
			<br>Data Inexistente<br><br>
			<a href="?folder=dates&file=ff_fmins_date&ext=php"><button type="button">Retornar</button></a>
			<br>
		</fieldset>
<?php
	}else{
		$sql_sel_datas_dados = $sql_sel_datas_resultado->fetch();
		//transformando pra fomato br
		$data = implode('/', array_reverse(explode('-', $sql_sel_datas_dados['dia']))); 
					// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
					// $data = implode('/', array_reverse(array(2014, 12, 15));
					// $data = implode('/', array(15, 12, 2014); 
					// $data = 15/12/2014;
?>
		<!-- Mensagem final -->
		<fieldset>
			<legend>Alteração de Data</legend>
			<form name="frmcaddata" method="post" action="?folder=dates&file=ff_upd_data&ext=php" onsubmit="return verificar_data()">
				<table>
					<tr>
						<input type="hidden" name="hidid" value="<?php echo $g_id;?>">
						<td width="40%">Data:</td>
						<td><input type="text" name="txtdata" maxlength="10" value="<?php echo $data;?>" required></td>
					</tr>
					<tr>
						<td width="40%">Descrição</td>
						<td><textarea name="txadescricao_data" required><?php echo htmlentities($sql_sel_datas_dados['descricao'], ENT_QUOTES);?></textarea></td>
					</tr>
					<tr id="mensagemObrigatoria">
						<td colspan="2" align="center">Todos os campos são obrigatórios</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<a href="?folder=dates&file=ff_fmins_date&ext=php"><button type="button">Retornar</button></a>
							<button type="submit">Salvar</button>
						</td>
					</tr>
				</table>
			</form>
		</fieldset>
<?php } ?>