<?php
// Recebendo dados \\
	$g_id = $_GET['id'];
//Variavel auxiliar
	$select='';
//Criando sintaxe para entrar em contato com o BD\\
	$sql_sel_ingressos="SELECT * FROM ingressosdisponiveis WHERE id='".$g_id."'";
	$sql_sel_ingressos_resultado=$conexao->query($sql_sel_ingressos);
	if($sql_sel_ingressos_resultado -> num_rows == 0){ ?>
		<fieldset>
			<legend>Aviso</legend>
			<br>Ingressos Disponiveis Inexistentes<br><br>
			<a href="?folder=tickets&file=ff_fmins_ticket&ext=php"><button type="button">Retornar</button></a>
			<br>
		</fieldset>
	<?php
	}else{
	$sql_sel_ingressos_dados=$sql_sel_ingressos_resultado->fetch_array();
//Sintaxe pra Select do dia	
	$sql_sel_datas="SELECT dia, id FROM datas ORDER BY dia ASC";
	$sql_sel_datas_resultado=$conexao->query($sql_sel_datas);
	?>
		<fieldset>
			<legend>Alteração de Ingresso</legend>
			<form name="frmcadingr" method="post" action="?folder=tickets&file=ff_upd_ticket&ext=php" onsubmit="return verificar_ingresso()">
				<input type="hidden" name="hidid" value="<?php echo $g_id;?>">
				<table>
					<tr>
						<td width="40%">Data do Evento:</td>
						<td>
							<select name="seldata_ingresso">
								<option value="" required>Escolha...</option>
								<?php
								//Enquanto conseguir extrair um arrei de resultados e enviar para a variavel dados
									while($sql_sel_datas_dados = $sql_sel_datas_resultado->fetch_array()){
										if(($sql_sel_datas_dados['id'])==($sql_sel_ingressos_dados['datas_id'])){
											$select='selected';
										}else{
											$select='';
										}
										$data = implode('/', array_reverse(explode('-', $sql_sel_datas_dados['dia']))); 
										// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
										// $data = implode('/', array_reverse(array(2014, 12, 15));
										// $data = implode('/', array(15, 12, 2014); 
										// $data = 15/12/2014;

										//transformando pra fomato br
											// local da separação de array, o que irá separar
											$data = explode('-', $sql_sel_datas_dados['dia']);
											$data = $data[2]."/".$data[1]."/".$data[0]; 
								?>
									<option <?php echo $select;?> value="<?php echo $sql_sel_datas_dados['id'];?>"><?php echo $data;?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="40%">Qtde. Normais:</td>
						<td><input required type="text" name="txtquant_normais" maxlength="10" value="<?php echo $sql_sel_ingressos_dados['qtde_normal']; ?>"></td>
					</tr>
					<tr>
						<td width="40%">Valor - Normais:</td>
						<td><input required type="text" name="txtvalor_normais" maxlength="6" placeHolder="Máximo: 999,99" value="<?php echo $sql_sel_ingressos_dados['valor_normal']; ?>"></td>
					</tr>
					<tr>
						<td width="40%">Qtde. - VIPs:</td>
						<td><input required type="text" name="txtquant_vips" maxlength="10" value="<?php echo $sql_sel_ingressos_dados['qtde_vip']; ?>"></td>
					</tr>
					<tr>
						<td width="40%">Valor - VIPs:</td>
						<td><input required type="text" name="txtvalor_vips" maxlength="6" placeHolder="Máximo: 999,99" value="<?php echo $sql_sel_ingressos_dados['valor_vip']; ?>"></td>
					</tr> 
					<tr id="mensagemObrigatoria">
						<td colspan="2" align="center">Todos os campos são obrigatórios</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<a href="?folder=tickets&file=ff_fmins_ticket&ext=php"><button type="button">Retornar</button></a>
						<button type="submit">Salvar</button></td>
					</tr>
				</table>
			</form>
		</fieldset>
<?php }?>