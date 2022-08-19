	<?php
		// Recebendo dados \\
		$p_quantvips= $_POST['txtquant_vips'];
		$p_valorvip= $_POST['txtvalor_vips'];
		$p_quantnormais= $_POST['txtquant_normais'];
		$p_valornormal= $_POST['txtvalor_normais'];
		$p_id = $_POST['hidid'];
		$p_id_data = $_POST['seldata_ingresso'];
		$msg='';
		$imagem='warning.png';
		$url_retorno='?folder=tickets&file=ff_fmupd_ticket&ext=php&id='.$p_id;
		//Verificando se tudo foi preenchido
		$valorvips = implode('.', explode(',', $p_valorvip)); 
		$valornormais = implode('.', explode(',', $p_valornormal));
		if($p_id_data == ""){
			$msg = "Selecione a Data Do ingresso";
			
		}else if($p_quantnormais == ""){
				$msg = "Preencha o campo Qtde - Normais!";
			}else if($ResultadoComparacao = ComparaQuantVazio($p_quantnormais)){
					$msg = "Favor preencher o campo Qtde - Normais<br><span>Não se pode cadastrar 0(zero) ingressos.</span>";
				}else if(!$ResultadoComparacao = ComparaQuant($p_quantnormais)){
						$msg = "Favor preencher o campo Qtde - Normais corretamente!";
				
					}else if ($valornormais == ""){
							$msg = "Preencha o campo Valor - Normais!";
						}else if($ResultadoComparacao = ComparaValorVazio($valornormais)){
								$msg = "Favor preencher o campo Valor - Normais<br><span>Não se pode cadastrar ingressos com valor 0(zero).</span>";
							}else if(!$ResultadoComparacao = ComparaValor($valornormais)){
									$msg = "Favor preencher o campo Valor - Normais corretamente!";
									
								}else if($p_quantvips == ""){
										$msg = "Preencha o campo Qtde - VIPs!";
									}else if($ResultadoComparacao = ComparaQuantVazio($p_quantvips)){
											$msg = "Favor preencher o campo Qtde - VIPs<br><span>Não se pode cadastrar 0(zero) ingressos.</span>";
										}else if(!$ResultadoComparacao = ComparaQuant($p_quantvips)){
												$msg = "Favor preencher o campo Qtde - VIPs corretamente!";
											
											}else if($valorvips == ""){
													$msg = "Preencha o campo Valor - VIPs!";
												}else if($ResultadoComparacao = ComparaValorVazio($valorvips)){
														$msg = "Favor preencher o campo Valor - VIPs<br><span>Não se pode cadastrar ingressos com valor 0(zero).</span>";
													}else if(!$ResultadoComparacao = ComparaValor($valorvips)){
															$msg = "Favor preencher o campo Valor - VIPs corretamente!";
														}else{
															//Criando Sintaxe
															$sql_sel_ingressos="SELECT id FROM ingressosdisponiveis WHERE id<>'".$p_id."' AND datas_id='".addslashes($p_id_data)."'";
															//Executando Sintaxe
															$sql_sel_ingressos_resultado=$conexao->prepare($sql_sel_ingressos);
															$sql_sel_ingressos_resultado->execute();
															//Verificando se foi encontrado algum nome igual
															if($sql_sel_ingressos_resultado->rowCount() > 0){
																$msg="Essa data já possui um Registro de Ingresso.";
															}else{
																$tabela="ingressosdisponiveis";
																$dados=array(
																	'datas_id' => $p_id_data,
																	'valor_vip' => $valorvips,
																	'valor_normal' => $valornormais,
																	'qtde_normal' => $p_quantnormais,
																	'qtde_vip' => $p_quantvips
																);
																$condicao="id = '".$p_id."'";
																$resultado = alterar($tabela, $dados, $condicao);
																if($resultado){
																	$msg="Alterado com Sucesso";
																	$imagem="ok.png";
																	$url_retorno="?folder=tickets&file=ff_fmins_ticket&ext=php";
																}else{
																	$msg="Erro ao efetuar a alteração".$conexao->error;
																}
															}
															
														}
	?>
	<!-- Mensagem final -->
	<fieldset>
		<legend>Aviso</legend>
		<img src="../../layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="<?php echo $url_retorno;?>"><button type="button">Retornar</button></a>
	</fieldset>
	<!-- Fim -->