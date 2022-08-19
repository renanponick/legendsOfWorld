	<h2>Reservas Efetuadas</h2>
		<?php 
			//INNER JOIN seleciona mais coisas em mais tabelas, apenas se ela tiverem algo em comum
			$sql_sel_reservas = "SELECT reservas.*,
										ingressosdisponiveis.valor_vip,
										ingressosdisponiveis.valor_normal,
										datas.dia
								FROM reservas
								INNER JOIN clientes ON (clientes.id = reservas.clientes_id)
								INNER JOIN ingressosdisponiveis ON (ingressosdisponiveis.id = reservas.ingressosdisponiveis_id)
								INNER JOIN datas ON (datas.id = ingressosdisponiveis.datas_id)
								WHERE clientes.usuarios_id = '".$_SESSION['id']."'";
						//selecione das reservas tudo
								//e das datas o dia - Na tabela clientes (o id do cliente que vai ser pego da tabela reservas)
	// ON MOSTRA A relação das duas tabelas			- Na tabela ingressosdisponiveis (o id do ingresso que vai ser pego da tabela reservas)
								//					- Na tabela datas (o id que vai ser pego da tabela ingressosdisponiveis(consulta acima))
								//sendo q todos eles tem q ter o usuarios_id = ao id da sessao
			// Executa a sintaxe
			$sql_sel_reservas_resultado=$conexao->prepare($sql_sel_reservas);
			$sql_sel_reservas_resultado->execute();
			if($sql_sel_reservas_resultado -> num_rows==0){
				echo "<div id='mensagem'><h1>Nenhuma Reserva Efetuada</h1></div>";
			}else{
		?>
			<table class="tabela_reservas" border="1px">
			<thead>
				<tr>
					<th>Código</th>
					<th>Data</th>
					<th>Quant. Normais</th>
					<th>Quant. Vips</th>
					<th>Valor total de reservas</th>
					<th>Cancelar</th>
				</tr>
			</thead>
			<?php while($sql_sel_reservas_dados=$sql_sel_reservas_resultado->fetch()){
				$valor_final=($sql_sel_reservas_dados['valor_vip']*$sql_sel_reservas_dados['qtde_vip'])+($sql_sel_reservas_dados['valor_normal']*$sql_sel_reservas_dados['qtde_normal']);
				$data = implode('/', array_reverse(explode('-', $sql_sel_reservas_dados['dia']))); 
				// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
				// $data = implode('/', array_reverse(array(2014, 12, 15));
				// $data = implode('/', array(15, 12, 2014); 
				// $data = 15/12/2014;
			?>
			<tbody>
				<tr>
					<td><?php echo $sql_sel_reservas_dados['codigo'];?></td>
					<td><?php echo $data; ?></td>
					<td><?php echo $sql_sel_reservas_dados['qtde_normal'];?></td>
					<td><?php echo $sql_sel_reservas_dados['qtde_vip'];?></td>
					<td>R$ <?php echo number_format($valor_final, 2, ",",".") ?></td>
					<td align="center"><a href="?folder=reservation&file=ff_fmcancel_reservation&ext=php&codigo=<?php echo $sql_sel_reservas_dados['codigo'];?>" title="Cancelar reserva"><img src="../../layout/images/decline.png"></a></td>						
				</tr>
			<?php }
			}
			?>
			</tbody>
		</table>