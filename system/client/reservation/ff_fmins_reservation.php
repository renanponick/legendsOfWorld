		<?php
			//Selecionando data
			$sql_sel_ingressos="SELECT datas.id, 
										ingressosdisponiveis.qtde_normal, 
										ingressosdisponiveis.qtde_vip, 
										datas.dia 
								FROM datas 
								INNER JOIN ingressosdisponiveis ON (ingressosdisponiveis.datas_id = datas.id)
								ORDER BY dia ASC";
			$sql_sel_ingressos_resultado = $conexao->query($sql_sel_ingressos);
		?>
			<h2>Reserva de Ingressos</h2>
			<fieldset>
				<form name="frmreservar" method="post" action="?folder=reservation&file=ff_ins_reservation&ext=php" onsubmit="return verificar_quantidade()">
					<table>
						<tr>
							<td width="40%">Data:</td>
							<td>
								<select name="seldata" required>
									<option value="">Escolha...</option>
								<?php
									//Enquanto conseguir extrair um arrei de resultados e enviar para a variavel dados
									while($sql_sel_ingressos_dados= $sql_sel_ingressos_resultado->fetch_array()){
									$data = implode('/', array_reverse(explode('-', $sql_sel_ingressos_dados['dia']))); 
									// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
									// $data = implode('/', array_reverse(array(2014, 12, 15));
									// $data = implode('/', array(15, 12, 2014); 
									// $data = 15/12/2014;
								?>	
									<option value="<?php echo $sql_sel_ingressos_dados['id'];?>"> <?php echo $data;?> </option>
								<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="40%">Quantidade Normal:</td>
							<td><input required type="text" name="txtqtde_normal" maxlength="1" placeHolder="	   ------ Maximo 4 -------"></td>
						</tr>
						<tr>
							<td width="40%">Quantidade Vip:</td>
							<td><input required type="text" name="txtqtde_vip" maxlength="1" placeHolder="	   ------ Maximo 4 ------- "></td>
						</tr>
						<tr id="mensagemObrigatoria">
							<td colspan="2" align="center">Todos os campos são obrigatórios</td>
						</tr>
						<tr>
							<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Reservar</button></td>
						</tr>
					</table>
				</form>
			</fieldset>
			<?php
			$sql_sel_tabela="SELECT ingressosdisponiveis.valor_normal, ingressosdisponiveis.valor_vip, datas.dia FROM datas
								INNER JOIN ingressosdisponiveis ON (ingressosdisponiveis.datas_id = datas.id)
								ORDER BY dia ASC";
			$sql_sel_tabela_resultado=$conexao->query($sql_sel_tabela);
			if($sql_sel_tabela_resultado->num_rows==0){
				echo "<h3>Nenhum ngresso Disponivel no sistema</br>Volte mais tarde...<h3>";
			}else{
			?>
			<h3>Preços dos Ingressos</h3>
				<fieldset>
					<table>
						<tr>
							<th>Dia</th>
							<th>Normal</th>
							<th>VIP</th>
						</tr>
						<?php
							while($sql_sel_tabela_dados = $sql_sel_tabela_resultado->fetch_array()){
							$data = implode('/', array_reverse(explode('-', $sql_sel_tabela_dados['dia']))); 
							// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
							// $data = implode('/', array_reverse(array(2014, 12, 15));
							// $data = implode('/', array(15, 12, 2014); 
							// $data = 15/12/2014;
						?>
						<tr>
							<td><?php echo $data; ?></td>
							<td>R$ <?php echo number_format($sql_sel_tabela_dados['valor_normal'],2,',','.');?></td>
							<td>R$ <?php echo number_format($sql_sel_tabela_dados['valor_vip'],2,',','.');?></td>
						</tr>
						<?php
				}
			}
						?>
					</table>
				</fieldset>