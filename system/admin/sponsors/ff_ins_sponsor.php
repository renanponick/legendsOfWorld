	<?php
		$msg ="";
		$imagem = "warning.png";
	
		$p_urlpatroc = $_POST['txturl_patroc'];
		$p_nomepatroc = $_POST['txtnome_patroc'];
		
		//Validando campos
		if($p_nomepatroc==""){
			$msg="Preencha o campo Nome.";
		}else if($p_urlpatroc==""){
				$msg="Preencha o campo URL da Imagem";
			//Entrando em contato com o banco Através de uma sintaxe
			}else{
				//Entrando em contato com o banco Através de uma sintaxe
				$sql_sel_patrocinadores = "SELECT nome FROM patrocinadores WHERE nome='".addslashes($p_nomepatroc)."'";
				$sql_sel_patrocinadores_resultado = $conexao -> query($sql_sel_patrocinadores);
				if($sql_sel_patrocinadores_resultado->num_rows > 0){
					$msg = "Esse Patrocinador já está cadastrado.";
				}else{
					$tabela="patrocinadores";
					//campos = keys    -    valores = valor
					$dados= array(
						//keys => valor
						'nome' => $p_nomepatroc ,
						'url_logo' => $p_urlpatroc
					);
					$resultado = adicionar($tabela, $dados);
					if($resultado){
						$msg = "Cadastrado com Sucesso";
						$imagem = "ok.png";
					}else{
							$msg="Erro ao efetuar o cadastro.".$conexao->error;
							}
				}
			}
		$conexao->close();
		// Fim \\
	?>
	<!-- Mensagem final -->
	<fieldset>
		<legend>Aviso</legend>
		<img src="../../layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="?folder=sponsors&file=ff_fmins_sponsor&ext=php"><button type="button">Retornar</button></a>
	</fieldset>
	<!-- Fim -->