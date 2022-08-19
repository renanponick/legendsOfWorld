	<?php
		//Recebendo variaveis
		$p_id = $_POST['hidid'];
		$p_data = $_POST['txtdata'];
		$p_descridata = $_POST['txadescricao_data'];
		//Variavel auxiliar
		$msg="";
		$imagem="warning.png";
		$url_retorno="?folder=dates&file=ff_fmupd_date&ext=php&id=".$p_id;
		//transformando pra fomato br
		$data = implode('-', array_reverse(explode('/', $p_data))); 
		// $data = implode('-', array_reverse(explode('/', 15/12/2014))); 
		// $data = implode('-', array_reverse(array(15, 12, 2014));
		// $data = implode('-', array(2014, 12, 15); 
		// $data = 2014-12-15;
		//Verificar se os dados forma preenchidos
		if($p_data==""){
			$msg=depositoMensagens(1,'Data');
		}else if($p_descridata==""){
				$msg=depositoMensagens(1,'Descrição da Data');
			}else if(!$ResultadoCompara = ComparaData($data)){
					$msg = depositoMensagens(10,'Data');
				}else{
					//Entrando em contato com o banco Através de uma sintaxe
					$sql_sel_datas="SELECT dia FROM datas WHERE dia='".addslashes($data)."' AND id<>'".$p_id."'";
					$sql_sel_datas_resultado=$conexao->prepare($sql_sel_datas);
					$sql_sel_datas_resultado->execute();
					//Verificando quantas vezes ele achou o que foi solicitado
					if($sql_sel_datas_resultado->rowCount() > 0){
						$msg = depositoMensagens(3,'a data', 'a');
					}else{
						//Entrando em contato com o banco Através de uma sintaxe
						$tabela="datas";
						$dados=array(
							'dia'=>$data,
							'descricao'=>$p_descridata
						);
						$condicao="id='".$p_id."'";
						$resultado = alterar($tabela, $dados, $condicao);
						//Verificando se deu certo ou se deu erro
						if($resultado){
							$msg=depositoMensagens(5);
							$imagem="ok.png";
							$url_retorno="?folder=dates&file=ff_fmins_date&ext=php";
						}else{
							$msg=depositoMensagens(8).$conexao->error;
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