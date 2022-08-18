<?php
	$aux="0";
	//auxiliares
	$_SESSION['pagina']=""; // Variavel para Sessão (DO42 PDF)
	$msg="";
	$total_sobrando=""; // Quantos Ingressos ainda podem ser reservados
	$qtde_sobrando_normal=""; // Quantos Ingressos NORMAIS ainda podem ser reservados
	$qtde_sobrando_vip=""; // Quantos Ingressos VIPS ainda podem ser reservados
	$total_disponibilizado=""; // Total De ingressos Disponibilizado no BD
	$qtde_disponibilizado_vip=""; // Total De ingressos VIPS Disponibilizado no BD
	$qtde_disponibilizado_normal=""; // Total De ingressos NORMAIS Disponibilizado no BD
	$total_reservado=""; // Total De reservas realizadas no BD
	$qtde_reservada_vip=""; // Total De reservas VIPS realizadas no BD
	$qtde_reservada_normal=""; // Total De reservas NORMAIS realizadas no BD
	//criando sintaxe
	$sql_sel_informacao="SELECT SUM(reservas.qtde_vip) AS reservas_vip, SUM(reservas.qtde_normal) AS reservas_normal, ingressosdisponiveis.qtde_vip, ingressosdisponiveis.qtde_normal, datas.dia FROM reservas
							INNER JOIN ingressosdisponiveis ON (reservas.ingressosdisponiveis_id = ingressosdisponiveis.id)
							INNER JOIN datas ON (ingressosdisponiveis.datas_id = datas.id)
							GROUP BY datas.dia";
	$sql_sel_informacao_resultado=$conexao->query($sql_sel_informacao);
	// Salvando Conteudo em Variavel de sessão para abrir em PDF
	$_SESSION['pagina']['titulo']='<h4>Relatório de Ingressos Reservados</h4>';	
	$_SESSION['pagina']['conteudo']="
		<table border='1'>
			<thead>
				<tr>
					<th>Data</th>
					<th>Tipo</th>
					<th>Quantidade Disponibilizada</th>
					<th>Quantidade Reservada</th>
					<th>Quantidade Disponivel</th>
				</tr>
			</thead>";
		// se n achar nada no BD é pq n tem nehuma reserva, INNER join n funciono no inicio
	if($sql_sel_informacao_resultado->num_rows == 0){
		$_SESSION['pagina']['conteudo'].="
			<tr>
				<td colspan='5'>Não há nenhuma Reserva no Sistema.</td>
			<tr>";
			$aux="1";
	}else{
		while($sql_sel_informacao_dados=$sql_sel_informacao_resultado->fetch_array()){
			//transformando pra fomato br
			$data = implode('/', array_reverse(explode('-', $sql_sel_informacao_dados['dia']))); 
			// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
			// $data = implode('/', array_reverse(array(2014, 12, 15));
			// $data = implode('/', array(15, 12, 2014); 
			// $data = 15/12/2014;
			//Descobrinco a Qunatidade disponivel
			$qtde_sobrando_normal = $sql_sel_informacao_dados['qtde_normal']-$sql_sel_informacao_dados['reservas_normal'];
			$qtde_sobrando_vip = $sql_sel_informacao_dados['qtde_vip']-$sql_sel_informacao_dados['reservas_vip'];
			//Descobrindo o Total
			$total_disponibilizado = $total_disponibilizado + ($sql_sel_informacao_dados['qtde_vip'] + $sql_sel_informacao_dados['qtde_normal']);
			$total_reservado = $total_reservado + ($sql_sel_informacao_dados['reservas_vip'] + $sql_sel_informacao_dados['reservas_normal']);
			$total_sobrando = $total_sobrando + ($qtde_sobrando_normal + $qtde_sobrando_vip);
			
			//DO42
			$qtde_reservada_vip = $sql_sel_informacao_dados['reservas_vip'];
			$qtde_disponibilizado_vip = $sql_sel_informacao_dados['qtde_vip'];
			$qtde_reservada_normal = $sql_sel_informacao_dados['reservas_normal'];
			$qtde_disponibilizado_normal = $sql_sel_informacao_dados['qtde_normal'];
			
			$_SESSION['pagina']['conteudo'].="
				<tbody>
					<tr>
						<td rowspan='2'>$data</td>
						<td>Vips</td>
						<td>$qtde_disponibilizado_vip</td>
						<td>$qtde_reservada_vip</td>
						<td>$qtde_sobrando_vip</td>
					</tr>
					<tr>
						<td>Normais</td>
						<td>$qtde_disponibilizado_normal</td>
						<td>$qtde_reservada_normal</td>
						<td>$qtde_sobrando_normal</td>
					</tr>
				</tbody>";
		}
		$_SESSION['pagina']['conteudo'].="
			<tr>
				<th colspan='2'>Total:</th>
				<td>$total_disponibilizado</td>
				<td>$total_reservado</td>
				<td>$total_sobrando</td>
			<tr>";
	}
	$_SESSION['pagina']['conteudo'].="</table>";
	
	echo $_SESSION['pagina']['titulo'];
	echo $_SESSION['pagina']['conteudo'];
	if($aux=="0"){
		?><a href="../../addons/plugins/pdf/ff_construtorpdf_pdf.php" target="_blank"><img src="../../layout/images/imprimir.png" title="Gerar PDF" /></a></a><?php
		}
?>