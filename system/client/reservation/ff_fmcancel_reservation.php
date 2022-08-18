<h2>Canselamento da Reservas de Ingresso</h2>
<?php 
	$g_codigo=$_GET['codigo'];
	$sql_sel_reservas="SELECT codigo FROM reservas WHERE codigo='".$g_codigo."'";
	$sql_sel_reservas_resultado=$conexao->query($sql_sel_reservas);
	if($sql_sel_reservas_resultado -> num_rows == 0){ ?>
	<fieldset>
		<h3><span>Aviso</span></h3>
		Reserva Inexistente<br><br>
		<a href="?folder=reservation&file=ff_view_reservation&ext=php"><button type="button">Retornar</button></a>
		<br>
	</fieldset>
<?php
}else{
?>
	<fieldset>
		<form name="frmcancelar" action="?folder=reservation&file=ff_cancel_reservation&ext=php" onsubmit="return verificar_cancelamento()" method="post">
			<table class="tabela_reservas">
				<tr>
					<td>Código da Reserva</td>
					<td><input type="text" name="txtcodigo" value="<?php echo $g_codigo;?>" readonly /></td>
				</tr>
				<tr>
					<td>Motivo do Cancelamento</td>
					<td>
						<select name="selmotivo" required>
							<option value=''>Selecione</option>
							<option value='F'>Financeiro</option>
							<option value='I'>Insatisfação</option>
							<option value='E'>Eventos mais importantes</option>
							<option value='A'>Adversidade familiar</option>
							<option value='O'>Outros</option>
						</select>
					</td>
				</tr>
				<tr id="mensagemObrigatoria">
					<td colspan="2" align="center">Todos os campos são obrigatórios</td>
				</tr>
				<tr>
					<td colspan="2">
						<a href="?folder=reservation&file=ff_view_reservation&ext=php"><button type="button">Retornar</button></a>
						<a href="?folder=reservation&file=ff_cancel_reservation&ext=php"><button type="submit">Cancelar</button></a>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
<?php } ?>