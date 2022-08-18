<?php 
/*
Lista de Caso por número
1 - Campo vazio, não preenchido.
2 - Select vazio, não selecionado.
3 - Cadastro já existente

4 - Cadastrado COM SUCESSO!
5 - Alterado COM SUCESSO!
6 - Deletado COM SUCESSO!

7 - Erro ao Cadastrar
8 - Erro ao Alterar
9 - Erro ao Deletar

10 - Campo preenhido errado

11 - Nào é possivel deletar. Chave estrangeira. 
12 -
13 -
14 -
15 -
16 -
17 -
18 -

*/

function depositoMensagens($pr_id, $pr_campo='', $pr_genero=''){
	switch($pr_id){
		case 1 : { 
			$msg = "Preencha o campo ".$pr_campo."!"; 
		}
		break;
		case 2 : { 
			$msg = "Selecione o campo ".$pr_campo."!"; 
		}
		break;
		case 3 : { 
			$msg = "Est".$pr_campo." já está cadastrad".$pr_genero."!"; 
		}
		break;
		case 4 : { 
			$msg = "Cadastro realizado com sucesso!"; 
		}
		break;
		case 5 : { 
			$msg = "Alteração realizada com sucesso!"; 
		}
		break;
		case 6 : { 
			$msg = "Exclusão realizada com sucesso!"; 
		}
		break;
		case 7 : { 
			$msg = "Erro ao efetuar o cadastro."; 
		}
		break;
		case 8 : { 
			$msg = "Erro ao efetuar o alteração"; 
		}
		break;
		case 9 : { 
			$msg = "Erro ao efetuar o exclusão"; 
		}
		break;
		case 10 : { 
			$msg = "Campo ".$pr_campo." preenchido de forma errada.<br>Favor conferir."; 
		}
		break;
		case 11 : { 
			$msg = "Não é possivel deletar est"; 
		}
		break;
		case 12 : { 
			$msg = ""; 
		}
		break;
		case 13 : { 
			$msg = ""; 
		}
		break;
		case 14 : { 
			$msg = ""; 
		}
		break;
		case 15 : { 
			$msg = ""; 
		}
		break;
		case 16 : { 
			$msg = ""; 
		}
		break;
		case 17 : { 
			$msg = ""; 
		}
		break;
		case 18 : { 
			$msg = ""; 
		}
		break;
	}
	return $msg;
}


?>