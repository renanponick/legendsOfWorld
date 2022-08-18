		<div id="atracoes">
		<?php
			$sql_sel_bandas="SELECT nome, descricao, url_imagem FROM bandas ORDER BY nome ASC";
			$sql_sel_bandas_resultado=$conexao->query($sql_sel_bandas);
			
			if($sql_sel_bandas_resultado->num_rows == 0){
				?>
					<div id="mensagemfinal">Nenhuma Banda foi cadastrada no sistema!</br>Volte mais tarde...</div>
				<?php
			}else{
				while($sql_sel_bandas_dados = $sql_sel_bandas_resultado->fetch_array()){
		?>		
				<div class='banda'>
					<div id='imagem_banda'>
						<img src="<?php echo $sql_sel_bandas_dados['url_imagem']; ?>" width="200px" height="170px">
					</div>
					<div>
						<div class='ajustar_centro ajustar_titulos'>
							<?php echo $sql_sel_bandas_dados['nome'];?>
						</div>
						<?php echo $sql_sel_bandas_dados['descricao']; ?>
					</div>
				</div>
				<hr/>
		<?php }
		} ?>
		</div>