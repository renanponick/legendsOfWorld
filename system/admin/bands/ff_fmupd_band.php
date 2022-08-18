	<?php
	// Recebendo dados \\
		$g_id = $_GET['id'];
	//Variavel auxiliar
		$select = '';
	//Criando sintaxe para entrar em contato com o BD\\
		$sql_sel_bandas="SELECT * FROM bandas WHERE id='".$g_id."'";
		$sql_sel_bandas_resultado=$conexao->query($sql_sel_bandas);
		if($sql_sel_bandas_resultado -> num_rows == 0){
			?>
			<fieldset>
				<legend>Aviso</legend>
				<br>Banda Inexistente<br><br>
				<a href="?folder=bands&file=ff_fmins_band&ext=php"><button type="button">Retornar</button></a>
			</fieldset>
			<?php
		}else{
		$sql_sel_bandas_dados=$sql_sel_bandas_resultado->fetch_array();
			//Sintaxe pra Select do dia
				$sql_sel_datas="SELECT dia, id FROM datas ORDER BY dia ASC";
				$sql_sel_datas_resultado=$conexao->query($sql_sel_datas);
			?>
			<fieldset>
				<legend>Alteração de Bandas</legend>
				<form name="frmcadband" method="post" action="?folder=bands&file=ff_upd_band&ext=php" onsubmit="return verificar_banda()">
					<input type="hidden" name="hidid" value="<?php echo $g_id;?>"></td>
					<table>
						<tr>
							<td width="40%">Data do Evento:</td>
							<td>	
								<select name="seldata_banda">
									<?php
									//Enquanto conseguir extrair um arrei de resultados e enviar para a variavel dados
										while($sql_sel_datas_dados = $sql_sel_datas_resultado->fetch_array()){
											//transformando pra fomato br
											$data = implode('/', array_reverse(explode('-', $sql_sel_datas_dados['dia']))); 
											// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
											// $data = implode('/', array_reverse(array(2014, 12, 15));
											// $data = implode('/', array(15, 12, 2014); 
											// $data = 15/12/2014;
											//Verifica se o Id da Data confere com o Id estrangeiro da banda, 
											//se for o mesmo então a variavel select recebe selected para poder indicar no option q é a principal.
											//isso será verificado em todo loop, pois, precisa conferir cada DATA com o ID estrangeiro
											if(($sql_sel_datas_dados['id'])==($sql_sel_bandas_dados['datas_id'])){
												$select="selected";
											}else{
												$select='';
											}
									?>	
										<option <?php echo $select;?> value="<?php echo $sql_sel_datas_dados['id']; ?>"><?php echo $data;?></option><?php
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="40%">Nome:</td>
							<td><input type="text" name="txtnome_banda" value="<?php echo htmlentities($sql_sel_bandas_dados['nome'], ENT_QUOTES) ;?>" maxlength="21" required></td>
						</tr>
						<tr>
							<td width="40%">Descrição</td>
							<td><textarea name="txadescricao_banda" required><?php echo htmlentities($sql_sel_bandas_dados['descricao'], ENT_QUOTES);?></textarea></td>
						</tr>
						<tr>
							<td width="40%">URL da Imagem:</td>
							<td><input type="text" name="txturl_banda" value="<?php echo htmlentities($sql_sel_bandas_dados['url_imagem'], ENT_QUOTES);?>" required></td>
						</tr>
						<tr id="mensagemObrigatoria">
							<td colspan="2" align="center">Todos os campos são obrigatórios</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<a href="?folder=bands&file=ff_fmins_band&ext=php"><button type="button">Retornar</button></a>
								<button type="submit">Salvar</button>
							</td>
						</tr>
					</table>
				</form>
			</fieldset>
			<?php 
		} ?>