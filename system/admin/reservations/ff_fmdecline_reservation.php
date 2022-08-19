		<?php
			$g_codigo = $_GET['codigo'];
			$sql_sel_reservas="SELECT codigo FROM reservas WHERE codigo='".$g_codigo."'";
			$sql_sel_reservas_resultado=$conexao->prepare($sql_sel_reservas);
			$sql_sel_reservas_resultado->execute();
			if($sql_sel_reservas_resultado -> num_rows == 0){ ?>
				<fieldset>
					<h3><span>Aviso</span></h3>
					Reserva Inexistente<br><br>
					<a href="?folder=reservations&file=ff_view_reservation&ext=php"><button type="button">Retornar</button></a>
					<br>
				</fieldset>
		<?php
			}else{
		?>
			<fieldset>
				<legend>Declinar Reserva</legend>
				<form name="frmdeclinar" method="post" action="?folder=reservations&file=ff_decline_reservation&ext=php" onsubmit="return verificar_declineo()">
					<table>
						<tr>
							<td>* Código da Reserva</td>
							<td><input type="text" name="txtcodigo" readonly value="<?php echo $g_codigo;?>" required/></td>
						</tr>
						<tr>
							<td>* Motivo da Declinação</td>
							<td>
								<select name="selmotivo" required >
									<option value="">MOTIVO</option>
									<option value="D">Documentação Inválida</option>
									<option value="S">Dados Inválidos/Suspeitos</option>
									<option value="O">Outros</option>
								</select>
							</td>
						</tr>
						<td colspan="2" align="center">
								<a href="?folder=reservations&file=ff_view_reservation&ext=php"><button type="button" >Retornar</button></a>
								<button type="submit" >Enviar</button>
						</td>
					</table>
				</form>
			</fieldset>
		<?php
			}
		?>