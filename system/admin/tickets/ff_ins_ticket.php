	<?php
	// Recebendo dados \\
		$p_dataingresso = $_POST ['seldata_ingresso'];
		$p_quantnormais = $_POST ['txtquant_normais'];
		$p_valornormais = $_POST ['txtvalor_normais'];
		$p_quantvips = $_POST ['txtquant_vips'];
		$p_valorvips = $_POST ['txtvalor_vips'];
	// Fim \\
	// Analizando dados(completos).\\	
	$valorvips = implode('.', explode(',', $p_valorvips)); 
	$valornormais = implode('.', explode(',', $p_valornormais));
	$msg = "";
		$imagem = "warning.png";
		if($p_dataingresso == ""){
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
															// .-. Criando a sintaxe SQL para executar no BD .-. \\
																$sql_sel_ingresso="SELECT id, datas_id FROM ingressosdisponiveis WHERE datas_id='".addslashes($p_dataingresso)."'";
																// .-. Verificar(executa a sintaxe) se deu certo a Sintaxe .-. \\
																$sql_sel_ingresso_resultado = $conexao -> query($sql_sel_ingresso);
																if($sql_sel_ingresso_resultado->num_rows > 0){
																	$msg = "Essa data já possui ingressos cadastrados.";
																}else{
																	$tabela="ingressosdisponiveis";
																	$dados=array(
																		'datas_id' => $p_dataingresso,
																		'valor_vip' => $valorvips,
																		'valor_normal' => $valornormais,
																		'qtde_normal' => $p_quantnormais,
																		'qtde_vip' => $p_quantvips
																	);
																	$resultado = adicionar($tabela, $dados);
																	if($resultado){
																		$msg="Cadastrado com sucesso.";
																		$imagem = "ok.png";
																	}else{
																		$msg="Erro ao efetuar o cadastro.".$conexao->error;
																	}
																}
														}
	// Fim \\
	?>
	<!-- Mensagem final -->
	<fieldset>
		<legend>Aviso</legend>
		<img src="../../layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="?folder=tickets&file=ff_fmins_ticket&ext=php"><button type="button">Retornar</button></a>
	</fieldset>
	<!-- Fim -->