<!DOCTYPE html>
<html lang="pt-BR">
	<head>
	<!-- Chamando o arquivo char, que faz criação do gráfico -->
		<script src="../../addons/js/Chart.min.js"></script>
	</head>
	<body>
	<?php
		$msg="";
		$motivo_o_adm = 0;
		$motivo_o_cli = 0;
		$motivo_f = 0;
		$motivo_e = 0;
		$motivo_i = 0;
		$motivo_a = 0;
		$motivo_s = 0;
		$motivo_d = 0;
		$sql_sel_canceladas = "SELECT motivo, permissao_usuario FROM canceladas";
		$sql_sel_canceladas_resultado = $conexao->prepare($sql_sel_canceladas);
		if($sql_sel_canceladas_resultado->rowCount()==0){
			echo "<span id='msg'>Sem Declinio e Cancelamento</span>";
		}else{
			while($sql_sel_canceladas_dados = $sql_sel_canceladas_resultado -> fetch()){
				if($sql_sel_canceladas_dados['motivo']=="O"){
					if($sql_sel_canceladas_dados['permissao_usuario']==0){
						$motivo_o_adm += 1;
					}else{
						$motivo_o_cli += 1;
					}
				}else if($sql_sel_canceladas_dados['motivo']=="F"){
					$motivo_f += 1;
				}else if($sql_sel_canceladas_dados['motivo']=="E"){
					$motivo_e += 1;
				}else if($sql_sel_canceladas_dados['motivo']=="I"){
					$motivo_i += 1;
				}else if($sql_sel_canceladas_dados['motivo']=="A"){
					$motivo_a += 1;
				}else if($sql_sel_canceladas_dados['motivo']=="S"){
					$motivo_s += 1;
				}else if($sql_sel_canceladas_dados['motivo']=="D"){
					$motivo_d += 1;
				}
			} ?>
			<!-- Criação dos Valores do gráfico -->
				<script type="text/javascript">
			<?php if(($motivo_s !=0)||($motivo_d !=0)||($motivo_o_adm !=0)){ ?>
					var motivo_d = <?php echo $motivo_d;?>;
					var motivo_s = <?php echo $motivo_s;?>;
					var motivo_o_adm = <?php echo $motivo_o_adm;?>;
					var options = {
							animation: false
						};
					var declinados = [
						{
							value: motivo_d,
							color: "#FFD600",
							label: "Documentação Inválida"
						},
						{
							value: motivo_s,
							color: "#E5C100",
							label: "Dados Inválidos/Suspeitos"
						},
						{
							value: motivo_o_adm,
							color: "#403500",
							label: "Outros"
						}
					];
			<?php } if(($motivo_f !=0)||($motivo_e !=0)||($motivo_i !=0)||($motivo_a !=0)||($motivo_o_cli !=0)){ ?>
					var motivo_f = <?php echo $motivo_f;?>;
					var motivo_e = <?php echo $motivo_e;?>;
					var motivo_i = <?php echo $motivo_i;?>;
					var motivo_a = <?php echo $motivo_a;?>;
					var motivo_o_cli = <?php echo $motivo_o_cli;?>;
					var options = {
							animation: false
						};
					var cancelados = [
						{
							value: motivo_f,
							color:"#FFD600",
							label: "Financeiro"
						},
						{
							value: motivo_i,
							color: "#7F6B00",
							label: "Insatisfação"
						},
						{
							value: motivo_e,
							color: "#E5C100",
							label: "Eventos mais importantes"
						},
						{
							value: motivo_a,
							color: "#BFA000",
							label: "Adversidade familiar"
						},
						{
							value: motivo_o_cli,
							color: "#403500",
							label: "Outros"
						}
					];
			<?php } ?>
			window.onload = function(){
				<?php if(($motivo_s !=0)||($motivo_d !=0)||($motivo_o_adm !=0)){?>
						var GraficoDecli = document.getElementById("declinadas").getContext("2d");
						var Pizza = new Chart(GraficoDecli).Pie(declinados, options);
				<?php } if(($motivo_f !=0)||($motivo_e !=0)||($motivo_i !=0)||($motivo_a !=0)||($motivo_o_cli !=0)){?>
						var GraficoCance = document.getElementById("canceladas").getContext("2d");
						var PizzaChart = new Chart(GraficoCance).Pie(cancelados, options);
				<?php } ?>
					} 
				</script>
			<?php if(($motivo_s !=0)||($motivo_d !=0)||($motivo_o_adm !=0)){?>
					<fieldset>
						<legend>Declinadas</legend>
					<!-- Chamando o arquivo char, que faz criação do gráfico -->
						<div>
							<canvas id="declinadas"></canvas>
							 <div class="chart-legenda">
								 <ul>
								 <?php if($motivo_d != 0){?>
									<li class="D">Documentação Inválida</li>
									
								<?php }if($motivo_s != 0){?>
									<li class="S">Dados Inválidos/Suspeitos</li>
									
								<?php }if($motivo_o_adm != 0){?>
									<li class="O">Outros</li>
								<?php } ?>
								 </ul>
							 </div>
						</div>
					</fieldset>
	<!-- Grafico 2 -->
		<?php }else{
			$msg="Sem Declínio";
			}if(($motivo_f !=0)||($motivo_e !=0)||($motivo_i !=0)||($motivo_a !=0)||($motivo_o_cli !=0)){ ?>
			<fieldset>
				<legend>Canceladas</legend>
			<!-- Chamando o arquivo char, que faz criação do gráfico -->
					<canvas id="canceladas"></canvas>
					<div class="chart-legenda">
						 <ul>
						 <?php if($motivo_f != 0){?>
							<li class="F">Financeiro</li>
							
						 <?php }if($motivo_e != 0){?>
							<li class="E">Eventos mais Importantes</li>
							
						 <?php }if($motivo_i != 0){?>
							<li class="I">Insatisfação</li>
							
						 <?php } if($motivo_a != 0){?>
							<li class="A">Adversidade Familiar</li>
							
						 <?php }if($motivo_o_cli != 0){?>
							<li class="O">Outros</li>
						 <?php } ?>
						 </ul>
					 </div>
			</fieldset>
			<?php } else{ 
					$msg="Sem Cancelamento";
					}
		} ?>
		<span id="msg"><?php echo $msg; ?></span>
	</body>
</html>