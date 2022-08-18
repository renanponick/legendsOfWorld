<?php
$estilo="";
$html="";

	// Criando cabeçalho padrão para todos os PDFs
	session_start();
	$html="
			<hr>
				<div id='logo'><img src='../../../layout/images/logo_festival.png'>
				</div>
				<div class='info'>
					<div id='titulo'>Legends of World</div>
					<br>
					Endereço: Festival Low, Rio de Janeiro
					<br>
					Fone: (47)3442-7070 - (47)9925-7070
					<br>
					Email: administracaoLOW@gmail.com
					<br>
				</div>
			<hr>
			<div id='titulo'>".$_SESSION['pagina']['titulo']."</div>
		<pagefooter name='rodape' content-right='Data de emissão: {DATE j/m/y}'/>
		<setpagefooter name='rodape' value='on' />";
		
	// incluindo pluguin
	include("mpdf57/mpdf.php");
	
	// formato do arquivo
	$mpdf = new mPDF('c','A4','','',32,25,30,20,10,10);
	
	//Chamando uma pagina (o estilo)
	$estilo = file_get_contents('../../../layout/css/ff_layout_pdf_css.css');
	$mpdf -> WriteHTML($estilo,1);
	
	// Passando os valores atribuidos à uma variavel
	$html .= $_SESSION['pagina']['conteudo'];
	// Escrevendo o valor que foi repassado acima
	$mpdf -> WriteHTML($html);
	$mpdf -> Output();
	exit;

?>