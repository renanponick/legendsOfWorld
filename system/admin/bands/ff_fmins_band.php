	<fieldset>
	<?php
		//ORDE(R)na BY(de forma) ASCendente
		$sql_sel_datas = "SELECT id, dia FROM datas ORDER BY dia ASC";
		$sql_sel_datas_resultado = $conexao->query($sql_sel_datas);
	?>
		<legend>Cadastro de Banda</legend>
		<form name="frmcadband" method="post" action="?folder=bands&file=ff_ins_band&ext=php" onsubmit="return verificar_banda()">
			<table>
				<tr>
					<td width="40%">Data do Evento:</td>
					<td>
						<select name="seldata_banda" required>
							<option value="">Escolha...</option>
							<?php
							//Enquanto conseguir extrair um arrei de resultados e enviar para a variavel dados
								while($sql_sel_datas_dados = $sql_sel_datas_resultado->fetch_array()){
							//transformando pra fomato br
							$data = implode('/', array_reverse(explode('-', $sql_sel_datas_dados['dia']))); 
								// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
								// $data = implode('/', array_reverse(array(2014, 12, 15));
								// $data = implode('/', array(15, 12, 2014); 
								// $data = 15/12/2014;
							?>	
							<option value="<?php echo $sql_sel_datas_dados['id']; ?>"><?php echo $data; ?></option><?php
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="40%">Nome:</td>
					<td><input type="text" name="txtnome_banda" maxlength="21" required></td>
				</tr>
				<tr>
					<td width="40%">Descrição</td>
					<td><textarea name="txadescricao_banda" required></textarea></td>
				</tr>
				<tr>
					<td width="40%">URL da Imagem:</td>
					<td><input type="text" name="txturl_banda" required></td>
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
	<h4>Bandas Registradas</h4>
	<table border="1" width="650">
		<thead>
			<tr>
				<th width="10%">ID</th>
				<th width="25%">Data</th>
				<th width="40%">Banda</th>
				<th width="10%">Editar</th>
				<th width="10%">Excluir</th>
			</tr>
		</thead>
		<?php 
			$sql_sel_bandas = "SELECT bandas.*,
									 datas.dia
							FROM bandas
							INNER JOIN datas ON (datas.id = bandas.datas_id)";
			$sql_sel_bandas_resultado=$conexao->query($sql_sel_bandas);
		?>
		<tbody>
			<?php
				if($sql_sel_bandas_resultado->num_rows == 0){
			?>
				<tr>
					<td colspan='5'>Não possui nenhum registro.</td>
				</tr>
			<?php 
			}else{
				while($sql_sel_bandas_dados=$sql_sel_bandas_resultado->fetch_array()){
					//transformando pra fomato br
					$data = implode('/', array_reverse(explode('-', $sql_sel_bandas_dados['dia']))); 
					// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
					// $data = implode('/', array_reverse(array(2014, 12, 15));
					// $data = implode('/', array(15, 12, 2014); 
					// $data = 15/12/2014;
			?>
			<tr>
				<td><?php echo $sql_sel_bandas_dados['id']; ?></td>
				<td><?php echo $data; ?></td>
				<td><?php echo htmlentities($sql_sel_bandas_dados['nome'], ENT_QUOTES);?></td>
				<td align="center"><a href="?folder=bands&file=ff_fmupd_band&ext=php&id=<?php echo $sql_sel_bandas_dados['id'];?>" title="Editar registro"><img src="../../layout/images/edit.png"></a></td>
				<td align="center"><a onclick="return excluir('a banda <?php echo htmlentities($sql_sel_bandas_dados['nome'], ENT_QUOTES); ?>')" href="?folder=bands&file=ff_del_band&ext=php&id=<?php echo $sql_sel_bandas_dados['id'];?>" title="Excluir registro"><img src="../../layout/images/delete.png"></a></td>
			</tr>
			<?php
				}
			}?>
		</tbody>
	</table>