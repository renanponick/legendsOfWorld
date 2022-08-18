			<h2> Aviso </h2>
			<?php
				$imagem="alert_icon.png";
				$url_retorno="?folder=profile&file=ff_fmupdpersonal_profile&ext=php";
				$p_nome = $_POST['txtnome'];
				$p_data = $_POST['txtdata'];
				$p_doc = $_POST['seldocumento'];
				$p_numdoc = $_POST['txtnumerodoc'];
				$p_telefone = $_POST['txttelefone'];
				$p_email = $_POST['txtemail'];
				
				$DocPadrao = "";
				//transformando pra fomato br
				$data = implode('-', array_reverse(explode('/', $p_data))); 
				// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
				// $data = implode('/', array_reverse(array(2014, 12, 15));
				// $data = implode('/', array(15, 12, 2014); 
				// $data = 15/12/2014;
				//verificação para ver se existe outra pessoa com o mesmo documento E mesmo numero de documento
				if($p_doc=="1"){
					$documento="CPF";
				}else if($p_doc=="2"){
						$documento="RG";
					}else{
						$documento="Passaporte";
					}
				if($p_nome==""){
					$msg="Preencha o Campo Nome";
				}else if($p_data==""){
						$msg="Preencha o Campo Data de Nascimento";
					}else if(!$ResultadoComparacao = ComparaData($data)){
							$msg="Preencha o Campo Data de Nascimento Corretamente.";
						}else if($p_doc==""){
								$msg="Selecione um Tipo de Documento";
							}else if($p_numdoc==""){
									$msg="Preencha o Campo Número de Documento";
								}else if(!ComparaDocumento($p_numdoc, $p_doc)){
										$msg="Preencha o Campo Número de Documento Corretamente<br> Vale apena lembrar, <span>Use a Pontuação</span>";
									}else if($p_telefone==""){
											$msg="Preencha o Campo Telefone";
										}else if(!$ResultadoComparacao = ComparaTelefone($p_telefone)){
												$msg="Preencha o Campo Telefone Corretamente";
											}else if($p_email==""){
													$msg="Preencha o Campo E-Mail";
												}else if(!$ResultadoComparacao = ComparaEmail($p_email)){
														$msg="Preencha o campo E-mail corretamente!";
													}else{
															$sql_sel_clientes="SELECT tipo_doc, num_doc FROM clientes WHERE tipo_doc='".addslashes($p_doc)."' AND num_doc='".addslashes($p_numdoc)."' AND usuarios_id<>'".addslashes($_SESSION['id'])."'";
															$sql_sel_clientes_resultado=$conexao->query($sql_sel_clientes);
															if($sql_sel_clientes_resultado->num_rows>0){
																$msg="<br>Usuário já cadastrado.<br>Motivo: Este Numero de ".$documento." ( ".$p_numdoc." ) já está sendo utilizado, favor conferi-lo.";
														}else{
															
															$tabela="clientes";
															$dados=array(
																'nome'=>$p_nome,
																'nascimento'=>$data,
																'tipo_doc'=>$p_doc,
																'email'=>$p_email,
																'num_doc'=>$p_numdoc,
																'telefone'=>$p_telefone
															);
															$condicao="usuarios_id='".$_SESSION['id']."'";
															$resultado = alterar ($tabela, $dados, $condicao);
															
															if(!$resultado){
																$msg="Erro ao efetuar a alteração.<br> ".$conexao->erro;
															}else{
																$msg="Dados alterados com sucesso.";
																$imagem="done_icon.png";
																$url_retorno="?folder=profile&file=ff_view_profile&ext=php";
															}
														}
													}
			?>				
			<div id='mensagem'>
				<h1><img src="../../layout/images/<?php echo $imagem; ?>" height='60px' width='60px'><br> <?php echo $msg; ?></h1>
				<a href="<?php  echo $url_retorno;?>""><button type="button">Retornar</button></a>
			</div>
			</div>