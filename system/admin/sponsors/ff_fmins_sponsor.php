	<fieldset>
		<legend>Cadastro de Patrocinador</legend>
		<form name="frmcadpatroc" method="post" action="?folder=sponsors&file=ff_ins_sponsor&ext=php" onsubmit="return verificar_patrocinio()">
			<table>
				<tr>
					<td width="40%">Nome:</td>
					<td><input type="text" name="txtnome_patroc" maxlength="10" required></td>
				</tr>
				<tr>
					<td width="40%">URL da Imagem:</td>
					<td><input type="text" name="txturl_patroc" required></td>
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
	//Entrando em contato com o banco Através de uma sintaxe
	$sql_sel_patrocinadores = "SELECT id, nome FROM patrocinadores";
	$sql_sel_patrocinadores_resultado = $conexao->query($sql_sel_patrocinadores);
	?>
	<h4>Patrocinadores Registrados</h4>
	<table border="1" width="550">
		<thead>
			<tr>
				<th width="10%">ID</th>
				<th width="50%">Nome</th>
				<th width="10%">Editar</th>
				<th width="10%">Excluir</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//Verifica quantas vezes encontrou o que foi solicitado
				if($sql_sel_patrocinadores_resultado->num_rows == 0){
			?>
				<tr>
					<td colspan='4'>Não existe nenhum registro.</td>
				</tr>
			<?php
				}else{
				//Enquanto conseguir extrair um arrei de resultados e enviar para a variavel dados
					while ($sql_sel_patrocinadores_dados = $sql_sel_patrocinadores_resultado->fetch_array()){
			?>
						<tr>
							<td><?php echo $sql_sel_patrocinadores_dados['id']; ?></td>
							<td><?php echo htmlentities($sql_sel_patrocinadores_dados['nome'], ENT_QUOTES); ?></td>
							<td align="center"><a href="?folder=sponsors&file=ff_fmupd_sponsor&ext=php&id=<?php echo $sql_sel_patrocinadores_dados['id']?>" title="Editar registro"><img src="../../layout/images/edit.png"></a></td>
							<td align="center"><a onclick="return excluir('o patrocinador <?php echo htmlentities($sql_sel_patrocinadores_dados['nome'], ENT_QUOTES); ?>')" href="?folder=sponsors&file=ff_del_sponsor&ext=php&id=<?php echo $sql_sel_patrocinadores_dados['id']?>" title="Excluir registro"><img src="../../layout/images/delete.png"></a></td>
						</tr>
			<?php
					}
			}?>
		</tbody>
	</table>