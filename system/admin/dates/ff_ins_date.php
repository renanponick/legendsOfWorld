	<?php
		// Recebendo dados \\
		$p_data = $_POST ['txtdata'];
		$p_descdata = $_POST ['txadescricao_data'];
		//Variavel auxiliar
		$msg ="";
		$imagem = "warning.png";
		// Analizando dados(completos).\\
		//Criando condição para preg_match
		$data = implode('-', array_reverse(explode('/', $p_data))); 
		// $data = implode('-', array_reverse(explode('/', 15/12/2014))); 
		// $data = implode('-', array_reverse(array(15, 12, 2014));
		// $data = implode('-', array(2014, 12, 15); 
		// $data = 2014-12-15;

		if ($p_data == ""){
			$msg = depositoMensagens(1,'Data');
		}else if ($p_descdata == ""){
				$msg = depositoMensagens(1,'Descrição da Data');
			}else if(!$ResultadoCompara = ComparaData($data)){
					$msg = depositoMensagens(10,'Data');
				}else{
				//transformando pra fomato br
					//Criando Sintaxe
					$sql_sel_datas="SELECT dia FROM datas WHERE dia='".addslashes($data)."'";
					//Executando Sintaxe
					$sql_sel_datas_resultado=$conexao->prepare($sql_sel_datas);
					$sql_sel_datas_resultado->execute();
					//Verificando quantas vezes ele achou o que foi solicitado
					if($sql_sel_datas_resultado->rowCount()>0){
						$msg= depositoMensagens(3,'a data', 'a');
					}else{
						$tabela="datas";
						$dados=array(
							'dia' => $data,
							'descricao' =>$p_descdata
						);
						$resultado = adicionar($tabela, $dados);
						//Verificando se deu certo ou se deu erro
						if($resultado){
							$msg = depositoMensagens(4);
							$imagem = "ok.png";
						}else{
								$msg= depositoMensagens(7).$conexao -> error;
							}
					}
				}
		// $conexao->close();
	// Fim \\
	?>
	<!-- Mensagem final -->
	<fieldset>
		<legend>Aviso</legend>
		<img src="../../layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="?folder=dates&file=ff_fmins_date&ext=php"><button type="button">Retornar</button></a>
	</fieldset>
	<!--Fim -->