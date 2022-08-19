		<?php
			//Auxiliar
			$documento="";
			$sql_sel_informacao="SELECT reservas.*, clientes.*, datas.dia FROM reservas
									INNER JOIN clientes ON (reservas.clientes_id = clientes.id)
									INNER JOIN ingressosdisponiveis ON (reservas.ingressosdisponiveis_id = ingressosdisponiveis.id)
									INNER JOIN datas ON (datas.id = ingressosdisponiveis.datas_id)
									ORDER BY codigo DESC";
			$sql_sel_informacao_resultado=$conexao->prepare($sql_sel_informacao);
			$sql_sel_informacao_resultado->execute();
			$sql_sel_informacao_checar=$sql_sel_informacao_resultado->rowCount();
		?>
			<h4>Reservas Efetuadas</h4>
			<table border="1" width="1000">
				<thead>
					<tr>
						<th width="10%">Código</th>
						<th width="10%">Cliente</th>
						<th width="5%">Tipo do Documento</th>
						<th width="10%">Número do Documento</th>
						<th width="10%">Telefone</th>
						<th width="10%">E-mail</th>
						<th width="10%">Data do Evento</th>
						<th width="5%">Quant. Normais</th>
						<th width="5%">Quant. Vips</th>
						<th width="5%">Declinar</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					if($sql_sel_informacao_checar == 0){
					?>
							<td colspan="10">Não há nenhuma Reserva no Sistema.</td>					
					<?php
					}else{
						while($sql_sel_informacao_dados=$sql_sel_informacao_resultado->fetch()){
							if($sql_sel_informacao_dados['tipo_doc']=="1"){
								$documento="CPF";
							}else if($sql_sel_informacao_dados['tipo_doc']=="2"){
									$documento="RG";
								}else{
									$documento="Passaporte";
								}
								$data = implode('/', array_reverse(explode('-', $sql_sel_informacao_dados['dia']))); 
								// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
								// $data = implode('/', array_reverse(array(2014, 12, 15));
								// $data = implode('/', array(15, 12, 2014); 
								// $data = 15/12/2014;
							?>
							<tr>
								<td width="10%"><?php echo $sql_sel_informacao_dados['codigo'];?></td>
								<td width="10%"><?php echo $sql_sel_informacao_dados['nome'];?></td>
								<td width="5%"><?php echo $documento;?></td>
								<td width="10%"><?php echo $sql_sel_informacao_dados['num_doc'];?></td>
								<td width="10%"><?php echo $sql_sel_informacao_dados['telefone'];?></td>
								<td width="10%"><?php echo $sql_sel_informacao_dados['email'];?></td>
								<td width="10%"><?php echo $data;?></td>
								<td width="5%"><?php echo $sql_sel_informacao_dados['qtde_normal'];?></td>
								<td width="5%"><?php echo $sql_sel_informacao_dados['qtde_vip'];?></td>
								<td width="5%"><a  href="?folder=reservations&file=ff_fmdecline_reservation&ext=php&codigo=<?php echo $sql_sel_informacao_dados['codigo'];?>" title="Excluir Reserva"><img src="../../layout/images/decline.png"></a></td>
							</tr>
					<?php }
					}?>
				</tbody>
			</table>