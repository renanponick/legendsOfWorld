	<?php
	//Recebendo variaveis
	$p_id = $_POST['hidid'];
	$p_nome = $_POST['txtnome_banda'];
	$p_descricao = $_POST['txadescricao_banda'];
	$p_url = $_POST['txturl_banda'];
	$p_id_data = $_POST['seldata_banda'];
	//Variavel auxiliar
	$msg="";
	$imagem="warning.png";
	$url_retorno="?folder=bands&file=ff_fmupd_band&ext=php&id=".$p_id;
	//Verificando se tudo foi preenchido
	if ($p_nome == ""){
			$msg = depositoMensagens(1, 'Nome');
		}else if ($p_descricao == ""){
				$msg = depositoMensagens(1, 'Descrição da Banda');
			}else if ($p_url == ""){
					$msg = depositoMensagens(1, 'URL da Banda');
				}else if ($p_id_data == ""){
						$msg = depositoMensagens(2, 'Data do Evento');
					}else{
					//Criando Sintaxe
					$sql_sel_bandas="SELECT nome FROM bandas WHERE nome='".addslashes($p_nome)."' AND id<>'".$p_id."'";
					//Executando Sintaxe
					$sql_sel_bandas_resultado=$conexao->query($sql_sel_bandas);
					//Verificando se foi encontrado algum nome igual
					if($sql_sel_bandas_resultado->num_rows > 0){
						$msg = depositoMensagens(3,'a banda', 'a');
					}else{
						//Criando Sintaxe
						$tabela="bandas";
						$dados=array(
							'nome' => $p_nome,
							'descricao' => $p_descricao, 
							'url_imagem' => $p_url, 
							'datas_id' => $p_id_data
						);
						$condicao="id='".$p_id."'";
						$resultado = alterar($tabela, $dados, $condicao);
						if($resultado){
							$msg=depositoMensagens(5);
							$imagem="ok.png";
							$url_retorno="?folder=bands&file=ff_fmins_band&ext=php";
						}else{
							$msg = depositoMensagens(8).$conexao->error;
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