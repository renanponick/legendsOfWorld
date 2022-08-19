<?php
		$aux="0";
		$_SESSION['pagina']="";
		$msg="";
		//auxiliares
		$ganho_estimado_n="";
		$ganho_estimado_v="";
		$ganho_atual_n="";
		$ganho_atual_v="";
		$ganho_emaberto_n="";
		$ganho_emaberto_v="";
		
		$total_ganho_estimado="";
		$total_ganho_atual="";
		$total_ganho_aberto="";
		$total_ingressos_disp="";
		$total_ingressos_reservados="";
		
		//ok//
		$qtde_disponibilizado_vip=""; // Total De ingressos VIPS Disponibilizado no BD
		$qtde_disponibilizado_normal=""; // Total De ingressos NORMAIS Disponibilizado no BD
		
		$valor_vip=""; // Valor de ingressos vips no banco
		$valor_normal=""; // Valor de ingressos normais no banco
		
		$qtde_reservada_vip=""; // Total De reservas VIPS realizadas no BD
		$qtde_reservada_normal=""; // Total De reservas NORMAIS realizadas no BD
	
		
		//criando sintaxe
		//Sintaxe Significa 1/2/3/4 - Da tabela ingressosdisponiveis pegar pegar qtde/valor vip/normal.
		//Sintaxe Significa 5/6 - Soma de Todos os ingressos reservados vips/normais naquela data.
		//Sintaxe Significa 7 - da tabela data pegar o dia - "INICIADO", pela tabela mais importante IngressosDisponiveis.
		//Sintaxe Significa 8/9 - Referencias das tabelas
		//Sintaxe Significa 10 - Agrupar tudo pelos dia.
		$sql_sel_financieiro="SELECT ingressosdisponiveis.qtde_vip, 
									ingressosdisponiveis.qtde_normal,
									ingressosdisponiveis.valor_vip, 
									ingressosdisponiveis.valor_normal,
									SUM(reservas.qtde_vip) AS reservas_vip,
									SUM(reservas.qtde_normal) AS reservas_normal,
									datas.dia FROM reservas
									INNER JOIN ingressosdisponiveis ON (reservas.ingressosdisponiveis_id = ingressosdisponiveis.id)
									INNER JOIN datas ON (ingressosdisponiveis.datas_id = datas.id)
									GROUP BY datas.dia";
		$sql_sel_financieiro_resultado=$conexao->prepare($sql_sel_financieiro);
		$sql_sel_financieiro_resultado->execute();
		

$_SESSION['pagina']['titulo'] = "<h4>Estimativa de Ganho com Venda de Ingressos</h4>";
$_SESSION['pagina']['conteudo'] = "
	<table border='1' width='900'>
			<thead>
				<tr>
					<th width='10%'>Data</th>
					<th width='5%'>Tipo</th>
					<th width='10%'>Valor Ingresso</th>
					<th width='10%'>Total de Ingressos</th>
					<th width='10%'>Ingressos Reservados</th>
					<th width='10%'>Ganho Estimado</th>
					<th width='10%'>Ganho Atual</th>
					<th width='10%'>Ganho em Aberto</th>
				</tr>
			</thead>";
			if($sql_sel_financieiro_resultado->rowCount() == 0){
$_SESSION['pagina']['conteudo'] .="
			<tr>
				<td colspan='8'>Não há nenhuma Reserva no Sistema.</td>
			</tr>";
			$aux="1";
			}else{
			//Enquanto o Financeiro_dados conseguir extrair dados do financeiro resultado faça
			while($sql_sel_financeiro_dados = $sql_sel_financieiro_resultado->fetch()){
				//transformando pra fomato br
					$data = implode('/', array_reverse(explode('-', $sql_sel_financeiro_dados['dia']))); 
					// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
					// $data = implode('/', array_reverse(array(2014, 12, 15));
					// $data = implode('/', array(15, 12, 2014); 
					// $data = 15/12/2014;
			//     -  -  -  -  -  -  - SOMA  -  -  -  -  -  -  -  -     \\
						$ganho_estimado_v = $sql_sel_financeiro_dados['qtde_vip'] * $sql_sel_financeiro_dados['valor_vip'];
						$ganho_estimado_n = $sql_sel_financeiro_dados['qtde_normal'] * $sql_sel_financeiro_dados['valor_normal'];
						$ganho_atual_v = $sql_sel_financeiro_dados['reservas_vip'] * $sql_sel_financeiro_dados['valor_vip'];
						$ganho_atual_n = $sql_sel_financeiro_dados['reservas_normal'] * $sql_sel_financeiro_dados['valor_normal'];
						$ganho_emaberto_v = $ganho_estimado_v - $ganho_atual_v;
						$ganho_emaberto_n = $ganho_estimado_n - $ganho_atual_n;
						
						$total_ganho_estimado = $total_ganho_estimado + ($ganho_estimado_v + $ganho_estimado_n);
						$total_ganho_atual = $total_ganho_atual + ($ganho_atual_v + $ganho_atual_n);
						$total_ganho_aberto = $total_ganho_aberto + ($ganho_emaberto_v + $ganho_emaberto_n);
						$total_ingressos_disp = $total_ingressos_disp + ($sql_sel_financeiro_dados['qtde_vip'] + $sql_sel_financeiro_dados['qtde_normal']);
						$total_ingressos_reservados = $total_ingressos_reservados + ($sql_sel_financeiro_dados['reservas_vip'] + $sql_sel_financeiro_dados['reservas_normal']);
						
			//     -  -  -  -  -  -  - SOMA  -  -  -  -  -  -  -  -     \\
			//     -  -  -  -  -  -  -  PASSANDO VALORES PARA VARIAVEIS  -  -  -  -  -  -  -  -     \\
						// Pegando os valores de uma consulta e colocando em uma variavel
						$valor_vip = $sql_sel_financeiro_dados['valor_vip'];
						$qtde_disponibilizado_vip = $sql_sel_financeiro_dados['qtde_vip'];
						$qtde_reservada_vip = $sql_sel_financeiro_dados['reservas_vip'];
						$valor_normal = $sql_sel_financeiro_dados['valor_normal'];
						$qtde_disponibilizado_normal = $sql_sel_financeiro_dados['qtde_normal'];
						$qtde_reservada_normal = $sql_sel_financeiro_dados['reservas_normal'];
						
						// Variaveis sendo Formatadas Para melhor visualiza-las
						$valor_normal = number_format( $valor_normal,2,',','.');
						$valor_vip = number_format($valor_vip,2,',','.');
						$ganho_estimado_v_form = number_format($ganho_estimado_v,2,',','.');
						$ganho_estimado_n_form = number_format($ganho_estimado_n,2,',','.');
						$ganho_atual_v_form = number_format($ganho_atual_v,2,',','.');
						$ganho_atual_n_form = number_format($ganho_atual_n,2,',','.');
						$ganho_emaberto_n_form = number_format($ganho_emaberto_n,2,',','.');
						$ganho_emaberto_v_form = number_format($ganho_emaberto_v,2,',','.');
						$total_ganho_estimado_form = number_format($total_ganho_estimado,2,',','.');
						$total_ganho_atual_form = number_format($total_ganho_atual,2,',','.');
						$total_ganho_aberto_form = number_format($total_ganho_aberto,2,',','.');
			//     -  -  -  -  -  -  -  PASSANDO VALORES PARA VARIAVEIS  -  -  -  -  -  -  -  -     \\
$_SESSION['pagina']['conteudo'] .="
			<tbody>
				<tr>
					<td rowspan='2'>$data</td>
					<td>Vips</td>
					<td>R$ $valor_vip</td>
					<td> $qtde_disponibilizado_vip </td>
					<td> $qtde_reservada_vip</td>
					<td>R$ $ganho_estimado_v_form</td>
					<td>R$ $ganho_atual_v_form</td>
					<td>R$ $ganho_emaberto_v_form</td>
				</tr>
				<tr>
					<td>Normais</td>
					<td>R$ $valor_normal</td>
					<td> $qtde_disponibilizado_normal </td>
					<td> $qtde_reservada_normal </td>
					<td>R$ $ganho_estimado_n_form</td>
					<td>R$ $ganho_atual_n_form</td>
					<td>R$ $ganho_emaberto_n_form</td>
				</tr>
			";
				}
$_SESSION['pagina']['conteudo'] .="
				<tr>
					<th colspan='3'>Total:</th>
					<td>$total_ingressos_disp</td>
					<td>$total_ingressos_reservados</td>
					<td>R$ $total_ganho_estimado_form</td>
					<td>R$ $total_ganho_atual_form</td>
					<td>R$ $total_ganho_aberto_form</td>
				</tr>
			</tbody>
			";
		}
		$_SESSION['pagina']['conteudo'] .=" </table>";
		
		echo $_SESSION['pagina']['titulo'];
		echo $_SESSION['pagina']['conteudo'];
		if($aux=="0"){
				?><a href="../../addons/plugins/pdf/ff_construtorpdf_pdf.php" target="_blank"><img src="../../layout/images/imprimir.png" title="Gerar PDF" /></a></a><?php
				}
	?>
	