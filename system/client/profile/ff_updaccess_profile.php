	<h2> Aviso </h2>
	<?php
		$imagem="alert_icon.png";
		$url_retorno="?folder=profile&file=ff_fmupdaccess_profile&ext=php";
		$p_senha = $_POST['pwdsenha'];
		if($p_senha==""){
			$msg="Preencha o Campo Senha";
		}else {
		//Alterando a Senha Para modo Encriptado
			$hash_senha = md5($salt.$p_senha);
			
			$tabela="usuarios";
			$dados=array('senha'=>$hash_senha);
			$condicao="id='".$_SESSION['id']."'";
			$resultado = alterar ($tabela, $dados, $condicao);
			
			if(!$resultado){
				$msg="Erro ao efetuar a alteração.<br> ".$conexao->erro;
			}else{
				$msg="Dados alterados com sucesso.";
				$imagem="done_icon.png";
				$url_retorno="?folder=profile&file=ff_view_profile&ext=php";
			}
		}
	?>				
	<div id='mensagem'>
		<h1><img src="../../layout/images/<?php echo $imagem; ?>" height='60px' width='60px'> <?php echo $msg; ?></h1>
		<a href="<?php  echo $url_retorno;?>""><button type="button">Retornar</button></a>
	</div>