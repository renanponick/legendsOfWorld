	<fieldset>
	<?php
		$sql_sel_datas = "SELECT id, dia FROM datas ORDER BY dia ASC";
		$sql_sel_datas_resultado = $conexao->query($sql_sel_datas);
	?>
		<legend>Cadastro de Ingresso</legend>
		<form name="frmcadingr" method="post" action="?folder=tickets&file=ff_ins_ticket&ext=php" onsubmit="return verificar_ingresso()">
			<table>
				<tr>
					<td width="40%">Data do Evento:</td>
					<td>
						<select name="seldata_ingresso" required>
							<option value="">Escolha...</option>
							<?php
							//Enquanto conseguir extrair um arrei de resultados e enviar para a variavel dados
								while($sql_sel_datas_dados = $sql_sel_datas_resultado->fetch_array()){
								//transformando pra fomato br
								// local da separação de array, o que irá separar
								$data = implode('/', array_reverse(explode('-', $sql_sel_datas_dados['dia'])));
							?>
								<option value="<?php echo $sql_sel_datas_dados['id'];?>"><?php echo $data;?></option>
							<?php
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="40%">Qtde. Normais:</td>
					<td><input type="text" name="txtquant_normais" maxlength="10" required></td>
				</tr>
				<tr>
					<td width="40%">Valor - Normais:</td>
					<td><input type="text" name="txtvalor_normais" maxlength="6" required placeHolder="Máximo: 999,99" ></td>
				</tr>
				<tr>
					<td width="40%">Qtde. - VIPs:</td>
					<td><input type="text" name="txtquant_vips" maxlength="10" required></td>
				</tr>
				<tr>
					<td width="40%">Valor - VIPs:</td>
					<td><input type="text" name="txtvalor_vips" maxlength="6" required placeHolder="Máximo: 999,99"></td>
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
	<h4>Ingressos Registrados</h4>
	<table border="1" width="800">
		<thead>
			<tr>
				<th width="20%">Data</th>
				<th width="20%">Qtde. Normais</th>
				<th width="15%">Valor Normais</th>
				<th width="20%">Qtde. VIPs</th>
				<th width="15%">Valor VIPs</th>
				<th width="5%">Editar</th>
				<th width="5%">Excluir</th>
			</tr>
		</thead>
		<?php
		//Criando Sintaxe
		$sql_sel_ingressos = "SELECT ingressosdisponiveis.*,
									 datas.dia
							FROM ingressosdisponiveis
							INNER JOIN datas ON (datas.id = ingressosdisponiveis.datas_id)";
			$sql_sel_ingressos_resultado=$conexao->query($sql_sel_ingressos);
		?>
		<tbody>
			<?php 
				if($sql_sel_ingressos_resultado->num_rows == 0){
			?>
			<tr>
				<td colspan='7'>Não possui nenhum registro.</td>
			</tr>
			<?php 	
				}else{
					while($sql_sel_ingressos_dados=$sql_sel_ingressos_resultado->fetch_array()){
				//transformando pra fomato br
					// local da separação de array, o que irá separar
					$data = implode('/', array_reverse(explode('-', $sql_sel_ingressos_dados['dia']))); 
					// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
					// $data = implode('/', array_reverse(array(2014, 12, 15));
					// $data = implode('/', array(15, 12, 2014); 
					// $data = 15/12/2014;
			?>
			<tr>
				<td><?php echo $data; ?></td>
				<td><?php echo $sql_sel_ingressos_dados['qtde_normal'];?></td>
				<td>R$ <?php echo number_format($sql_sel_ingressos_dados['valor_normal'],2,',','.');?></td>
				<td><?php echo $sql_sel_ingressos_dados['qtde_vip'];?></td>
				<td>R$ <?php echo number_format($sql_sel_ingressos_dados['valor_vip'],2,',','.');?></td>
				<td align="center"><a href="?folder=tickets&file=ff_fmupd_ticket&ext=php&id=<?php echo $sql_sel_ingressos_dados['id'];?>" title="Editar registro"><img src="../../layout/images/edit.png"></a></td>
				<td align="center"><a onclick="return excluir('o registro de reserva de ingressos do dia <?php echo htmlentities($data, ENT_QUOTES); ?>')" href="?folder=tickets&file=ff_del_ticket&ext=php&id=<?php echo $sql_sel_ingressos_dados['id'];?>" title="Excluir registro"><img src="../../layout/images/delete.png"></a></td>
			</tr>
			<?php
				}
			}?>
		</tbody>
	</table>