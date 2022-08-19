	<?php
		//Recebendo variaveis
		$p_id = $_POST['hidid'];
		//Variavel auxiliar
		$msg="";
		$imagem="warning.png";
		$url_retorno="?folder=sponsors&file=ff_fmupd_sponsor&ext=php&id=".$p_id;
		$p_urlpatroc = $_POST['txturl_patroc'];
		$p_nomepatroc = $_POST['txtnome_patroc'];
		
		//Validando campos
		if($p_nomepatroc==""){
			$msg="Preencha o campo Nome.";
		}else if($p_urlpatroc==""){
				$msg="Preencha o campo URL da Imagem";
			//Entrando em contato com o banco Através de uma sintaxe
			}else{
				//criando sintaxe
				$sql_sel_patrocinadores="SELECT nome FROM patrocinadores WHERE nome='".addslashes($p_nomepatroc)."' AND id<>'".$p_id."'";
				//executando sintaxe
				$sql_sel_patrocinadores_resultado=$conexao->prepare($sql_sel_patrocinadores);
				//Verificando quantas vezes ele achou o que foi solicitado
				if($sql_sel_patrocinadores_resultado->rowCount() > 0){
					$msg = "Esse patrocinador já está cadastrado.";
				}else{
					$tabela = "patrocinadores";
					$dados = array(
						'nome' => $p_nomepatroc , 
						'url_logo' => $p_urlpatroc
					);
					$condicao = "id='".$p_id."'";
					$resultado = alterar($tabela, $dados, $condicao);
					// .-. Verifica se deu certo ou não .-. \\
					if($resultado){
						$msg="Alterado com sucesso.";
						$imagem="ok.png";
						$url_retorno="?folder=sponsors&file=ff_fmins_sponsor&ext=php";
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