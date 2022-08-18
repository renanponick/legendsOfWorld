	<h2>Aviso</h2>
		<?php
			$imagem="alert_icon.png";
			$msg="";
			$p_codigo=$_POST['txtcodigo'];
			$p_motivo=$_POST['selmotivo'];
			$url_retorno='?folder=reservation&file=ff_fmcancel_reservation&ext=php&codigo='.$p_codigo;
			if($p_codigo==""){
				$msg="Erro, favor reenviar.";
			}else if($p_motivo==""){
					$msg="Favor Selecinar um Motivo.";
				}else{
					$tabela="canceladas";
					$dados=array(
						'permissao_usuario'=>1,
						'motivo'=>$p_motivo
					);
					$resultado = adicionar($tabela, $dados);
					if(!$resultado){
						$msg="Erro : ".$conexao->error;
					}else{
						
						$tabela="reservas";
						$condicao="codigo='".$p_codigo."'";
						$resultado=deletar($tabela, $condicao);
						
						if(!$resultado){
							$msg="Erro : ".$conexao->error;
						}else{
							$msg="Cancelamento efetuado com sucesso, qualquer dúvida entre em contato conosco.";
							$imagem="done_icon.png";
							$url_retorno="?folder=reservation&file=ff_view_reservation&ext=php";
						}
					}
				}
		?>
	<div id="mensagem">
		<img src="../../layout/images/<?php echo $imagem;?>">
		<h1><?php echo $msg;?></h1>
		<a href="<?php echo $url_retorno; ?>"><button type="button">Retornar</button></a>
	</div>