			<?php
				$_SESSION['pagina']="";
				$descricao = "";
				$nome = "";
				//Variavel usada para saber se precisa botar a img de imprimir
				$Imprim="F";
				
				$ContIf="1";
				$ContWhi="1";
				$ContDat="Fora";
				
				$_SESSION['pagina']['titulo'] = "<div class='ajustar_centro ajustar_titulos'>Programação</div>";
				$_SESSION['pagina']['conteudo'] =""; 
				
				$sql_sel_data="SELECT * FROM datas ORDER BY dia ASC";
				$sql_sel_data_resultado = $conexao -> prepare($sql_sel_data);
				$sql_sel_data_resultado->execute();

				if($sql_sel_data_resultado->rowCount() == 0){
					$_SESSION['pagina']['conteudo']="<div id='mensagemfinal'>Nenhuma data cadastrada no sistema.</div>";
					$ContDat="Entrou";
				}else{
					while($sql_sel_data_dados = $sql_sel_data_resultado -> fetch()){
						$ContWhi= $ContWhi + 1;
						$sql_sel_banda="SELECT nome FROM bandas WHERE datas_id='".$sql_sel_data_dados['id']."'";
						$sql_sel_banda_resultado = $conexao -> prepare($sql_sel_banda);
						$sql_sel_banda_resultado->execute();
						if($sql_sel_banda_resultado->rowCount() == 0){
							$ContIf= $ContIf+1;
						}else{
							//deixando data de forma BR
							$data = implode('/', array_reverse(explode('-', $sql_sel_data_dados['dia']))); 
							// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
							// $data = implode('/', array_reverse(array(2014, 12, 15));
							// $data = implode('/', array(15, 12, 2014); 
							// $data = 15/12/2014;
							$descricao = $sql_sel_data_dados['descricao'];
							$_SESSION['pagina']['conteudo'] .="
								<table class='tabela_programacao'>
									<tr>
										<th class='dia'>Bandas do dia: $data</th>
									</tr>
									<tr>
										<th>$descricao</th>
									</tr>";
							while($sql_sel_banda_dados = $sql_sel_banda_resultado->fetch()){
							$Imprim="V";
								$nome = $sql_sel_banda_dados['nome'];
								$_SESSION['pagina']['conteudo'].="
									<tr>
										<td>$nome</td>
									</tr>";
							}
						}
								$_SESSION['pagina']['conteudo'].="</table>";
					}
				}if(($ContIf==$ContWhi)&&($ContDat=="Fora")){
					$_SESSION['pagina']['conteudo'] = "<div id='mensagemfinal'>Nenhuma banda cadastrada no sistema.</div>";
					
				} 
				echo $_SESSION['pagina']['titulo'];
				echo $_SESSION['pagina']['conteudo'];
				if($Imprim=="V"){
				?>
					<a href="addons/plugins/pdf/ff_construtorpdf_pdf.php" target="_blank"><img class="imprimir" src="layout/images/imprimir.png" title="Gerar PDF" /></a>
				<?php
				}
				?>