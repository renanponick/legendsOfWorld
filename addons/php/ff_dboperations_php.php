<?php 
	/*
	Autor: Renan Ponick
	Data 10/03/2015
	Descrição: irá conter funções php;
	*/
	
function adicionar($pr_tabela, $pr_dados){
	$campos=array_keys($pr_dados);
	$n_campos = count($campos);
	$sintaxe = "INSERT INTO ".$pr_tabela." ( ";
	//Sentando a variavel auxiliar, dando a condição, incrementando
		for($aux=0; $aux < $n_campos; $aux++){
	//.= concatena e acrescenta o q ja existe
			$sintaxe .= $campos[$aux].", ";
		}
	//o que substituir, a partir de onde, como substituir.
	// "INSERT INTO usuarios (login, senha, permissao, 
	$sintaxe = substr($sintaxe, 0, -2);
	$sintaxe.=" ) VALUES ( ";
	
	// "INSERT INTO usuarios (login, senha, permissao) VALUES (
	for($aux=0; $aux < $n_campos; $aux++){
				//pegar de $pr_dados o valor. pegar o valor de $campos atravez da $aux
			$sintaxe .="'".addslashes($pr_dados[$campos[$aux]])."', ";
		}
	// "INSERT INTO usuarios (login, senha, permissao) VALUES ('adm','123','0',
	//substituir a sintaxe atual, retirando 2 caracteres da mesma começando do fim(0,-2).
	$sintaxe = substr($sintaxe, 0, -2);
	$sintaxe .= " )";
	//chama algo do global pra dentro da função, usar só quando necessário. quase nunca
	global $conexao;
	
	$resultado = $conexao->prepare($sintaxe);
	$resultado->execute();
	
	return $resultado;
}
	
function deletar($pr_tabela, $pr_condicao){
	$sintaxe="DELETE FROM ".$pr_tabela." WHERE ".$pr_condicao;
	
	global $conexao;
	
	$resultado = $conexao -> prepare($sintaxe);
	$resultado->execute();
	
	return $resultado;

}
				
function alterar($pr_tabela,$pr_dados,$pr_condicao){
	//"UPDATE usuarios SET login='".$p_nomelogin."' ,senha='".$p_senha."' WHERE id='".$p_id."'"
	//pegar as chaves do pr_dados e passar para valores e um array
	$campos = array_keys($pr_dados);
	//contar quantos dados existem neste array
	$n_campos = count($campos);
	//iniciar sintaxe
	$sintaxe="UPDATE ".$pr_tabela." SET ";
		//Dando continuidade a sintaxe
		for($aux = 0; $aux < $n_campos; $aux++){
			$sintaxe .= $campos[$aux]." = '".addslashes($pr_dados[$campos[$aux]])."', ";
		}
		//$pr_dados[$campos[$aux]]
		//$pr_dados[$campos[0]]
		//$pr_dados[login]
		//admin
		//"UPDATE usuarios SET login='".$p_nomelogin."' ,senha='".$p_senha."', 
		
		
		$sintaxe = substr($sintaxe, 0, -2);
		//substituir a sintaxe atual, retirando 2 caracteres da mesma começando do fim(0,-2).
		//"UPDATE usuarios SET login='".$p_nomelogin."' ,senha='".$p_senha."'
		
		
		$sintaxe .=" WHERE ".$pr_condicao;
		//"UPDATE usuarios SET login='".$p_nomelogin."' ,senha='".$p_senha."' WHERE id='".$p_id."'"
		global $conexao;
		
		$resultado = $conexao -> prepare($sintaxe);
		$resultado->execute();
		
		return $resultado;
}	
	
	/* serve para a depuração do codigo.
		echo $sintaxe;
			exit;
	*/
?>