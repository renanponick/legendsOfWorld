	<h2> Alterar Perfil Pessoal </h2>
		<?php
			$sql_sel_clientes="SELECT * FROM clientes WHERE usuarios_id='".$_SESSION['id']."'";
			$sql_sel_clientes_resultado=$conexao->prepare($sql_sel_clientes);
			
			if(!$sql_sel_clientes_resultado){
				$msg="Erro".$conexao->error;
			?>	<h1><img src="../../layout/images/alert_icon.png" height='60px' width='60px'> <?php echo $msg; ?></h1><?php
			}else{
				$sql_sel_clientes_dados=$sql_sel_clientes_resultado->fetch();
			//transformando pra fomato br
				$data = implode('/', array_reverse(explode('-', $sql_sel_clientes_dados['nascimento']))); 
			// $data = implode('/', array_reverse(explode('-', 2014-12-15))); 
			// $data = implode('/', array_reverse(array(2014, 12, 15));
			// $data = implode('/', array(15, 12, 2014); 
			// $data = 15/12/2014;
			?>
			<fieldset>
				<table>
					<form name="frmalteracao" action="?folder=profile&file=ff_updpersonal_profile&ext=php" onsubmit="return verifica_pessoal()" method="post">
						<tr>
							<td>Nome: </td>
							<td><input required type="text" name="txtnome" maxlength="30" value="<?php echo htmlentities($sql_sel_clientes_dados['nome'], ENT_QUOTES);?>" ></td>
						</tr>
						<tr>
							<td>Data de Nascimento:</td>
							<td><input required type="text" name="txtdata" maxlength="10" value="<?php echo $data;?>"  placeHolder="DD/MM/AAAA"></td>
						</tr>
						<tr>
							<td>
								Tipo de Documento:
							</td>
							<td>
								<select name="seldocumento" required>
									<option value="1" <?php if($sql_sel_clientes_dados['tipo_doc'] == '1')echo "selected";?>>CPF</option>
									<option value="2" <?php if($sql_sel_clientes_dados['tipo_doc'] == '2')echo "selected";?>>RG</option>
									<option value="3" <?php if($sql_sel_clientes_dados['tipo_doc'] == '3')echo "selected";?>>Passaporte</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Número do documento:
							</td>
							<td>
								<input required type="text" placeHolder="Números com pontuação." maxlength="14" name="txtnumerodoc" value="<?php echo htmlentities($sql_sel_clientes_dados['num_doc'], ENT_QUOTES);?>" >
							</td>
						</tr>
						<tr>
							<td>Telefone: </td>
							<td><input required placeHolder="Apenas Números." type="text" name="txttelefone" maxlength="12" value="<?php echo htmlentities($sql_sel_clientes_dados['telefone'], ENT_QUOTES);?>" ></td>
						</tr>
						<tr>
							<td>E-mail: </td>
							<td><input required type="text" name="txtemail" maxlength="78" value="<?php echo htmlentities($sql_sel_clientes_dados['email'], ENT_QUOTES);?>" ></td>
						</tr>
						<tr id="mensagemObrigatoria">
							<td colspan="2" align="center">Todos os campos são obrigatórios</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<a href="?folder=profile&file=ff_view_profile&ext=php"><button type="button" >Retornar</button></a>
								<button type="submit">Enviar</button>
							</td>
						</tr>
					</form>
				</table>
			</fieldset>
		<?php }?>