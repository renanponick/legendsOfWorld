	<?php
	// Recebendo dados \\
		$p_nome = $_POST ['txtnome_banda'];
		$p_descbanda = $_POST ['txadescricao_banda'];
		$p_urlbanda = $_POST ['txturl_banda'];
		$p_databanda = $_POST ['seldata_banda'];
	// Fim \\
	//Variavel auxiliar
		$msg ="";
		$imagem = "warning.png";
	// Analizando dados(completos).\\
		if ($p_nome == ""){
			$msg = depositoMensagens(1, 'Nome');
		}else if ($p_descbanda == ""){
				$msg = depositoMensagens(1, 'Descrição da Banda');
			}else if ($p_urlbanda == ""){
					$msg = depositoMensagens(1, 'URL da Banda');
				}else if ($p_databanda == ""){
						$msg = depositoMensagens(2, 'Data do Evento');
					}else{
						// .-. Criando a sintaxe SQL para executar no BD .-. \\
						$sql_sel_bandas="SELECT nome FROM bandas WHERE nome='".addslashes($p_nome)."'";
						$sql_sel_bandas_resultado=$conexao->query($sql_sel_bandas);
						if($sql_sel_bandas_resultado->num_rows > 0){
							$msg = depositoMensagens(3,'a banda', 'a');
						}else{
							$tabela = "bandas";
							$dados = array(
								'datas_id' => $p_databanda,
								'nome' => $p_nome,
								'descricao' => $p_descbanda,
								'url_imagem' => $p_urlbanda
								);
							$resultado = adicionar($tabela, $dados);
								// .-. Verifica se deu certo ou não .-. \\
							if($resultado){
								$msg = depositoMensagens(4);
								$imagem = "ok.png";
							}else{
								$msg = depositoMensagens(7).$conexao->error;
							}
						}
					}
	// Fim \\
	?>
	<fieldset>
		<legend>Aviso</legend>
		<img src="../../layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="?folder=bands&file=ff_fmins_band&ext=php"><button type="button">Retornar</button></a>
	</fieldset>