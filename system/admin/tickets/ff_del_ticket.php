			<?php
				// Recebendo dados \\
				$g_id = $_GET['id'];
				$imagem='warning.png';
				$msg='';
				// Criando sintaxe
				$sql_sel_reservas="SELECT ingressosdisponiveis_id FROM reservas WHERE ingressosdisponiveis_id='".$g_id."'";
				$sql_sel_reservas_resultado=$conexao->prepare($sql_sel_reservas);
				if($sql_sel_reservas_resultado->rowCount() > 0){
					$msg="Não é possivel deletar esses Ingressos Disponiveis<br>MOTIVO<br>Este Cadastro de Ingresso já possui reservas<br>SOLUÇÃO<br>Deletar todas as reservas";
				}else{
					$tabela = "ingressosdisponiveis";
					$condicao = "id = '".$g_id."'";
					$resultado = deletar($tabela, $condicao);
					if($resultado){
						$msg="Excluido com Sucesso";
						$imagem="ok.png";
					}else{
						$msg="Erro ao efetuar a exclusão".$conexao->error;
					}
				}
			?>
			<!-- Mensagem final -->
			<fieldset>
				<legend>Aviso</legend>
				<img src="../../layout/images/<?php echo $imagem;?>">
				<p><?php echo $msg;?></p>
				<a href="?folder=tickets&file=ff_fmins_ticket&ext=php"><button type="button">Retornar</button></a>
			</fieldset>
			<!-- Fim -->