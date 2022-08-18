// DO 41 \\

function excluir(pr_complemento){
	var resultado;
	// variavel recebe o resultado do confirm, confirm, pede um valor ao usuario para continuar a operação
	resultado = confirm("Você deseja excluir "+pr_complemento+"?");
	// se for falso ele retorna falso e para a operação
	if(!resultado){
		return false;
	}
}

//Selecionar - Cadastro//
	function clicar(){
	if(frmcadastrar.seldocumento.value==""){
			document.getElementById("num_doc").disabled = true;
			document.getElementById("num_doc").placeholder="Escolha o tipo de Doc";
		}else{
			document.getElementById("num_doc").disabled = false;
			document.getElementById("num_doc").placeholder="Apenas Números";
		}
	}
//Fim//

// FRONT-END
		function verifica_login(){
			if(frmautenticacao.txtnomelogin.value==""){
				alert('Preencha o campo Nome');
					frmautenticacao.txtnomelogin.focus();
					return false;
				}else if(frmautenticacao.pwdsenha.value==""){
						alert('Preencha o campo Senha');
						frmautenticacao.pwdsenha.focus();
						return false;
					}
			}
		// CADRASTRO
		function verifica_cadastro(){
			if(frmcadastrar.txtnomecompleto.value==""){
				alert('Preencha o campo Nome Completo');
				frmcadastrar.txtnomecompleto.focus();
				return false;
			}else if(frmcadastrar.txtdata.value==""){
					alert('Preencha o campo Data de Nascimento');
					frmcadastrar.txtdata.focus();
					return false;
				}else if(frmcadastrar.seldocumento.value==""){
						alert('Preencha o campo Tipo de Documento');
						frmcadastrar.seldocumento.focus();
						return false;
					}else if(frmcadastrar.txtnumerodoc.value==""){
							alert('Preencha o campo Número do documento');
							frmcadastrar.txtnumerodoc.focus();
							return false;
						}else if(frmcadastrar.txtnamelogin.value==""){
								alert('Preencha o campo Nome de Usuário');
								frmcadastrar.txtnamelogin.focus();
								return false;
							}else if(frmcadastrar.pwdsenha.value==""){
									alert('Preencha o campo Senha');
									frmcadastrar.pwdsenha.focus();
									return false;
								}else if(frmcadastrar.txtemail.value==""){
										alert('Preencha o campo E-mail');
										frmcadastrar.txtemail.focus();
										return false;
									}else if(frmcadastrar.txttelefone.value==""){
										alert('Preencha o campo Telefone');
										frmcadastrar.txttelefone.focus();
										return false;
									}else if(frmcadastrar.pwdsenha.value!==frmcadastrar.pwdsenhavalida.value){
										alert('Senha Incompativel');
										frmcadastrar.pwdsenha.focus();
										return false;
									}else if(frmcadastrar.txtemail.value!==frmcadastrar.txtemailvalida.value){
										alert('Email Incompativel');
										frmcadastrar.txtemail.focus();
										return false;
										}
		}
		//FIM CADASTRO
	// FIM FRONT-END
	
//------------------------------------------------------------------------------------------------------------------------------\\
	
	// BACK-END ADMINISTRADOR CADASTRO
			//Script ADM 
			function verificar_administrador(){
				if(frmcadadmin.txtnomelogin.value == ""){
					alert('Preencha o campo Nome');
					frmcadadmin.txtnomelogin.focus();
					return false;
				}else if(frmcadadmin.pwdsenha.value == ""){
						alert('Preencha o campo Senha');
						frmcadadmin.pwdsenha.focus();
						return false;
					}
			}
			//script BANDA
			function verificar_banda(){
				if(frmcadband.txtnome_banda.value == ""){
					alert('Preencha o campo Nome');
					frmcadband.txtnome_banda.focus();
					return false;
				}else if(frmcadband.txadescricao_banda.value == ""){
						alert('Preencha o campo Descrição');
						frmcadband.txadescricao_banda.focus();
						return false;
					}else if(frmcadband.txturl_banda.value == ""){
							alert('Preencha o campo URL da Imagem');
							frmcadband.txturl_banda.focus();
							return false;
						}else if(frmcadband.seldata_banda.value == ""){
								alert('Selecione a Data do Evento');
								frmcadband.seldata_banda.focus();
								return false;
							}
			}
			//script DATA
				function verificar_data(){
						if(frmcaddata.txtdata.value == ""){
							alert('Preencha o campo Data');
							frmcaddata.txtdata.focus();
							return false;
						}else if(frmcaddata.txadescricao_data.value == ""){
								alert('Preencha o campo Descrição');
								frmcaddata.txadescricao_data.focus();
								return false;
							}
					}
			//script PRATROCINIO
			function verificar_patrocinio(){
					if(frmcadpatroc.txtnome_patroc.value == ""){
						alert('Preencha o campo Nome');
						frmcadpatroc.txtnome_patroc.focus();
						return false;
					}else if(frmcadpatroc.txturl_patroc.value == ""){
							alert('Preencha o campo URL da Imagem');
							frmcadpatroc.txturl_patroc.focus();
							return false;
						}
				}
			//script INGRESSO
			function verificar_ingresso(){
					if(frmcadingr.seldata_ingresso.value == ""){
						alert('Escolha o campo Data do Evento');
						frmcadingr.seldata_ingresso.focus();
						return false;
					}else if(frmcadingr.txtquant_normais.value == ""){
							alert('Preencha o campo Qtde - Normais');
							frmcadingr.txtquant_normais.focus();
							return false;
						}else if(frmcadingr.txtvalor_normais.value == ""){
								alert('Preencha o campo Valor - Normais');
								frmcadingr.txtvalor_normais.focus();
								return false;
							}else if(frmcadingr.txtquant_vips.value == ""){
									alert('Preencha o campo Qtde - VIPs');
									frmcadingr.txtquant_vips.focus();
									return false;
								}else if(frmcadingr.txtvalor_vips.value == ""){
										alert('Preencha o campo Valor - VIPs');
										frmcadingr.txtvalor_vips.focus();
										return false;
									}
				}
				
			//Cancelar Ingresso
			function verificar_declineo(){
					if(frmdeclinar.selmotivo.value == ""){
							alert('Selecione um motivo.');
							frmdeclinar.selmotivo.focus();
							return false;
						}
				}	
		// FIM BACK BACK-END ADMIN	
		
		// INICIO BACK BACK-END CLIENTE
		
			//Cancelar Ingresso
				function verificar_cancelamento(){
					if(frmcancelar.selmotivo.value == ""){
							alert('Selecione um motivo.');
							frmcancelar.selmotivo.focus();
							return false;
						}
				}
				
				//Reservar ingresso
				function verificar_quantidade(){
					if(frmreservar.seldata.value == ""){
						alert('Escolha o campo Data.');
						frmreservar.seldata.focus();
						return false;
					}else if(frmreservar.txtqtde_normal.value == ""){
							alert('Preencha o campo Quantidade Normal');
							frmreservar.txtqtde_normal.focus();
							return false;
						}else if(frmreservar.txtqtde_vip.value == ""){
								alert('Preencha o campo Quantidade Vip');
								frmreservar.txtqtde_vip.focus();
								return false;
							}
				}
				
				//Alterar perfil de acesso
			function verifica_acesso(){
				if(frmalteracao.pwdsenha.value==""){
					alert('Preencha o campo Senha');
					frmalteracao.pwdsenha.focus();
					return false;
				}
			}

				//Alterar perfil pessoal
		function verifica_pessoal(){
			if(frmalteracao.txtnome.value==""){
				alert('Preencha o campo Nome');
				frmalteracao.txtnome.focus();
				return false;
			}else if(frmalteracao.txtdata.value==""){
					alert('Preencha o campo Data de Nascimento');
					frmalteracao.txtdata.focus();
					return false;
				}else if(frmalteracao.txtnumerodoc.value==""){
						alert('Preencha o campo Número de Documento');
						frmalteracao.txtnumerodoc.focus();
						return false;
					}else if(frmalteracao.txttelefone.value==""){
							alert('Preencha o campo Telefone');
							frmalteracao.txttelefone.focus();
							return false;
						}else if(frmalteracao.txtemail.value==""){
								alert('Preencha o campo E-mail');
								frmalteracao.txtemail.focus();
								return false;
							}
		}