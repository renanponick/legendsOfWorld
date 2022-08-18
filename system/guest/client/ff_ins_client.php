	<div id="mensagemfinal">
		<?php
			$documento="";
			$url_retorno="?folder=system/guest/client&file=ff_fmins_client&ext=html";
			$msg="";
			$p_nomecompleto =  $_POST['txtnomecompleto'];
			$p_data =  $_POST['txtdata'];
			$p_tipodocumento =  $_POST['seldocumento'];
			$p_numerodoc =  $_POST['txtnumerodoc'];
			$p_nomelogin =  $_POST['txtnamelogin'];
			$p_senha =  $_POST['pwdsenha'];
			$p_email =  $_POST['txtemail'];
			$p_senhavalida =  $_POST['pwdsenhavalida'];
			$p_emailvalida =  $_POST['txtemailvalida'];
			$p_telefone =  $_POST['txttelefone'];
			$imagem="warning.png";
			$data = implode('-', array_reverse(explode('/', $p_data))); 
			// $data = implode('-', array_reverse(explode('/', 15/12/2014))); 
			// $data = implode('-', array_reverse(array(15, 12, 2014));
			// $data = implode('-', array(2014, 12, 15); 
			// $data = 2014-12-15;
			if($p_nomecompleto==""){
				$msg = depositoMensagens(1, 'Nome Completo');
			}else if($p_data==""){
					$msg="Preencha o campo Data de Nascimento!";
				}else if(!$ResultadoComparacao = ComparaData($data)){
						$msg="Preencha o campo Data de Nascimento Corretamente!";
					}else if($p_tipodocumento==""){
							$msg="Preencha o campo Tipo de Documento!";
						}else if($p_numerodoc==""){
								$msg="Preencha o campo Número de Documento!";
							}else if(!ComparaDocumento($p_numerodoc, $p_tipodocumento)){
									$msg="Preencha o campo Número de Documento Corretamente!";
								}else if($p_nomelogin==""){
										$msg="Preencha o campo Nome de Usuário!";
									}else if($p_senha==""){
											$msg="Preencha o campo Senha!";
										}else if($p_email==""){
												$msg="Preencha o campo E-mail!";
											}else if(!$ResultadoComparacao = ComparaEmail($p_email)){
													$msg="Preencha o campo E-mail corretamente!";
												}else if($p_telefone==""){
														$msg="Preencha o campo Telefone";
													}else if(!$ResultadoComparacao = ComparaTelefone($p_telefone)){
															$msg="Preencha o campo Telefone Corretamente";
														}else if($p_senha != $p_senhavalida){
																$msg="Senha não compativel";
															}else if($p_email != $p_emailvalida){
																	$msg="E-mail não compativel";
																}else{
																	if($p_tipodocumento=="1"){
																		$documento="CPF";
																	}else if($p_tipodocumento=="2"){
																			$documento="RG";
																		}else{
																			$documento="Passaporte";
																		}
														
														
													//--Validando Documnto--\\
													$sql_sel_clientesD="SELECT tipo_doc, num_doc FROM clientes WHERE tipo_doc='".addslashes($p_tipodocumento)."' AND num_doc='".addslashes($p_numerodoc)."'";
													$sql_sel_clientes_resultadoD=$conexao->query($sql_sel_clientesD);
														
													//--Validando Login--\\	
													$sql_sel_usuarios="SELECT login FROM usuarios WHERE login='".addslashes($p_nomelogin)."'";
													$sql_sel_usuarios_resultado=$conexao->query($sql_sel_usuarios);
													
													//--Validando email--\\
													$sql_sel_clientesE="SELECT email FROM clientes WHERE email='".addslashes($p_email)."'";
													$sql_sel_clientes_resultadoE=$conexao->query($sql_sel_clientesE);

													if($sql_sel_clientes_resultadoD->num_rows > 0){
														$msg="Este Numero de Documento ( ".$documento.": ".$p_numerodoc." ) já está sendo utilizado, favor conferi-lo.";
													}else if($sql_sel_usuarios_resultado->num_rows > 0){
															$msg="Este Nome de login ( ".$p_nomelogin." ) já está sendo utilizado, favor troca-lo.";
														}else if($sql_sel_clientes_resultadoE->num_rows > 0){
															$msg="Este Nome de email ( ".htmlentities($p_email, ENT_QUOTES)." ) já está sendo utilizado, favor troca-lo.";
															}else{
																//Alterando a Senha Para modo Encriptado
																$hash_senha = md5($salt.$p_senha);
																
																$tabela="usuarios";
																$dados=array(
																	'login'=>$p_nomelogin,
																	'senha'=>$hash_senha,
																	'permissao'=> 1
																);
																$resultado = adicionar($tabela, $dados);
																if($resultado){
																	//pegar o ultimo id registrado
																	$p_usuarios_id=$conexao->insert_id;
																	
																	$tabela="clientes";
																	$dados=array(
																		'nome' => $p_nomecompleto,
																		'nascimento' => $data,
																		'tipo_doc' => $p_tipodocumento,
																		'email' => $p_email,
																		'telefone' => $p_telefone,
																		'num_doc' => $p_numerodoc,
																		'usuarios_id' => $p_usuarios_id
																	);
																	$resultado = adicionar($tabela, $dados);
																	if($resultado){
																		$msg="Cadastro efetuado com SUCESSO!";
																		$imagem="ok.png";
																		$url_retorno="index.php";
																	}
																}else{	
																	$msg="Erro ao efetuar o cadastro".$conexao->error;
																}
															}
													}
		?>
		<img src="layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="<?php echo $url_retorno;?>"><button type="button">Retornar</button></a>
	</div>