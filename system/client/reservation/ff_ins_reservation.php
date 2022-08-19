			<h2> Aviso </h2>
			<?php
				$url_retorno="?folder=reservation&file=ff_fmins_reservation&ext=php";
				$p_data = $_POST['seldata'];
				$p_normal = $_POST['txtqtde_normal'];
				$p_vip = $_POST['txtqtde_vip'];
				$msg="";
				$imagem="alert_icon.png";
				if($p_data==""){
					$msg="Selecione uma Data.";
				}else if($p_normal==""){
						$msg="Preencha o Campo Qtde Normal.";
					
					}else if($p_vip==""){
						$msg="Preencha o Campo Qtde Vip.";
						
						}else if(($p_vip=="0")&&($p_normal=="0")){
								$msg="Não é possivel realizar uma reserva com <span>0(Zero)</span> ingressos normais e vips.";
								
							}else if(!$ResultadoComparacao = ComparaQuantMax($p_normal)){
									$msg="Preencha o campo Qtde Normal corretamente.<br> <span>No máximo, 4 ingressos</span>";
									
								}else if(!$ResultadoComparacao = ComparaQuantMax($p_vip)){
										$msg="Preencha o campo Qtde Vip corretamente.<br> <span>No máximo, 4 ingressos</span>";
									
									}else{
										//Selecionando o ID do usuario para a Reserva
										$sql_sel_clientes="SELECT id FROM clientes WHERE usuarios_id='".$_SESSION['id']."'";
										$sql_sel_clientes_resultado=$conexao->prepare($sql_sel_clientes);
										$sql_sel_clientes_resultado->execute();
										//Transformando em ARRAY
										$sql_sel_clientes_dados=$sql_sel_clientes_resultado->fetch();
										//Salvando o ID do Cliente
										$idCliente=$sql_sel_clientes_dados['id'];
										
										//Selecionando o Id estrangeiro dos Ingressos Disponiveis
										$sql_sel_ingressosdisponiveis="SELECT * FROM ingressosdisponiveis WHERE datas_id='".$p_data."'";
										$sql_sel_ingressosdisponiveis_resultado=$conexao->prepare($sql_sel_ingressosdisponiveis);
										$sql_sel_ingressosdisponiveis_resultado->execute();
										//Transformando em ARRAY
										$sql_sel_ingressosdisponiveis_dados=$sql_sel_ingressosdisponiveis_resultado->fetch();
										//Salvando o ID dos Ingressos Disponiveis
										$idIngressos = $sql_sel_ingressosdisponiveis_dados['id'];
										
										$sql_sel_reservas="SELECT codigo FROM reservas WHERE clientes_id='".$idCliente."' AND ingressosdisponiveis_id='".$idIngressos."'";
										$sql_sel_reservas_resultado=$conexao->prepare($sql_sel_reservas);
										$sql_sel_reservas_resultado->execute();
										//Verificando se ele ja tem reserva.
										if($sql_sel_reservas_resultado -> num_rows>0){
											$msg="Esta data já possui uma reserva";
										}else{
											$total_disponivel_normal = $sql_sel_ingressosdisponiveis_dados['qtde_normal'];
											$total_disponivel_vip = $sql_sel_ingressosdisponiveis_dados['qtde_vip'];
											
											//------------------------------------SOMA--------------------------------------\\
											$sql_sum_ingressos="SELECT SUM(qtde_normal) AS soma_normais, SUM(qtde_vip) AS soma_vips FROM reservas WHERE ingressosdisponiveis_id='".$idIngressos."'";
											$sql_sum_ingressos_resultado=$conexao->prepare($sql_sum_ingressos);
											$sql_sum_ingressos_resultado->execute();
											$sql_sum_ingressos_dados=$sql_sum_ingressos_resultado->fetch();
											$qtde_normal_reservados=$sql_sum_ingressos_dados['soma_normais'];
											$qtde_vip_reservados=$sql_sum_ingressos_dados['soma_vips'];
											// Vendo se a quantidade de ingressos reservados + a quantidade q foi solicitada quando subtraida da qunatidade total ainda sobra alguma coisa.
											
											$disponiveis_normais = $total_disponivel_normal - $qtde_normal_reservados ;
											$disponiveis_vips = $total_disponivel_vip - $qtde_vip_reservados ;
											if((($disponiveis_normais - $p_normal) < 0)&&((($disponiveis_vips - $p_vip) < 0))){
												$msg="Esta data não possui ingressos disponíveis.";
											}
											else if(($disponiveis_normais - $p_normal) < 0){
												$msg="Reserva Disponivel para ingressos Normais é ".$disponiveis_normais."<br> Favor Verificar número solicitado";
											}else if(($disponiveis_vips - $p_vip) < 0){
													$msg="Reserva Disponivel para ingressos Vips é ".$disponiveis_vips."<br> Favor Verificar número solicitado";
												}else{
											//---------------------------------FIM--SOMA------------------------------------\\
													// Se a atualização deu certo
													// Inserir na tabela de RESERVAS a reserva feita pelo cliente
													
													$tabela="reservas";
													$dados=array(
														'qtde_normal' => $p_normal, 
														'qtde_vip' => $p_vip, 
														'ingressosdisponiveis_id' => $idIngressos, 
														'clientes_id' => $idCliente
													);
													$resultado=adicionar($tabela, $dados);
													
													//Se deu certo msg de ok
													if($resultado){
														$msg="Sua reserva foi efetuada!";
														$imagem="done_icon.png";
														$url_retorno="?folder=reservation&file=ff_view_reservation&ext=php";
													//Se deu errado Necessita tirar A atualização feita na tabela de Ingressos Disponiveis 
													//Pois na reserva ocorreu algum erro, sendo assim nao tem-se a reserva e mostrar o erro.
													}else{
														$msg="Erro".$conexao->erro;
													}
												}
										}
									}
			?>				
			<div id='mensagem'>
				<h1><img src="../../layout/images/<?php echo $imagem ?>" height='60px' width='60px'> <?php echo "<br>".$msg; ?></h1>
				<a href="<?php echo $url_retorno;?>"><button type="button">Retornar</button></a>
			</div>