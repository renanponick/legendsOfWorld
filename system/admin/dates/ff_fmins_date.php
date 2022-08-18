	<fieldset>
		<legend>Cadastro de Data</legend>
		<form name="frmcaddata" method="post" action="?folder=dates&file=ff_ins_date&ext=php" onsubmit="return verificar_data()">
			<table>
				<tr>
					<td width="40%">Data:</td>
					<td><input type="text" name="txtdata" placeholder="Dia/Mês/Ano" maxlength="10" required></td>
				</tr>
				<tr>
					<td width="40%">Descrição</td>
					<td><textarea name="txadescricao_data" required></textarea></td>
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
	// Entrando em contato com o BD através de uma sintaxe
	$sql_sel_datas="SELECT id, dia, descricao FROM datas";
	$sql_sel_datas_resultado=$conexao->query($sql_sel_datas);
	?>
	<h4>Datas Registradas</h4>
	<table border="1" width="550">
		<thead>
			<tr>
				<th width="10%">ID</th>
				<th width="30%">Data</th>
				<th width="40%">Descrição</th>
				<th width="10%">Editar</th>
				<th width="10%">Excluir</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($sql_sel_datas_resultado->num_rows == 0){
			?>
				<tr>
					<td colspan='5'>Não possui nenhum registro</td>
				</tr>
			<?php
			}else{
			//Enquanto conseguir extrair um arrei de resultados e enviar para a variavel dados
				while($sql_sel_datas_dados = $sql_sel_datas_resultado->fetch_array()){
					//transformando pra fomato br
					$data = implode('/', array_reverse(explode('-', $sql_sel_datas_dados['dia']))); 
					// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
					// $data = implode('/', array_reverse(array(2014, 12, 15));
					// $data = implode('/', array(15, 12, 2014); 
					// $data = 15/12/2014;
			?>
				<tr>
					<td><?php echo $sql_sel_datas_dados['id'];?></td>
					<td><?php echo $data;?></td>
					<td><?php echo htmlentities($sql_sel_datas_dados['descricao'], ENT_QUOTES);?></td>
					<td align="center"><a href="?folder=dates&file=ff_fmupd_date&ext=php&id=<?php echo $sql_sel_datas_dados['id'];?>" title="Editar registro"><img src="../../layout/images/edit.png"></a></td>
					<td align="center" ><a onclick="return excluir('a data <?php echo htmlentities($data, ENT_QUOTES);?>')" href="?folder=dates&file=ff_del_date&ext=php&id=<?php echo $sql_sel_datas_dados['id']?>" title="Excluir registro"><img src="../../layout/images/delete.png"></a></td>
				</tr>
			<?php }
			}?>
		</tbody>
	</table>