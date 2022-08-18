		<?php
			$p_codigo=$_POST['txtcodigo'];
			$p_motivo=$_POST['selmotivo'];
			$url_retorno="?folder=reservations&file=ff_fmdecline_reservation&ext=php&codigo=".$p_codigo;
			$imagem="warning.png";
			if($p_codigo==""){
				$msg="Erro, favor refazer processo de declinio.<br>(objeto não encontrado)";
				$url_retorno="?folder=reservations&file=ff_view_reservation&ext=php";
			}else if($p_motivo==""){
					$msg="Selecione um motivo";
				}else{
					$tabela="canceladas";
					$dados=array(
						'motivo' => $p_motivo ,
						'permissao_usuario' => 0
					);
					$resultado=adicionar($tabela, $dados);
					if(!$resultado){
						$msg="Erro - Canceladas".$conexao->erro;
					}else{
						$tabela = "reservas";
						$condicao = "codigo = '".$p_codigo."'";
						$resultado = deletar($tabela, $condicao);
						if(!$resultado){
							$msg="Erro - Reservas".$conexao->erro;
						}else{
							$msg="Reserva excluida com Sucesso";
							$url_retorno="?folder=reservations&file=ff_view_reservation&ext=php";
							$imagem="ok.png";
						}
					}
				}
		?>
			<fieldset>
				<legend>Aviso</legend>
				<img src="../../layout/images/<?php echo $imagem;?>">
				<p><?php echo $msg;?></p>
				<a href="<?php echo $url_retorno;?>"><button type="button">Retornar</button></a>
			</fieldset>