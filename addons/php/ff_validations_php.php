<?php 
	// - Compara DATA  -//
	function ComparaData($pr_condicao){
		$DataPadrao="/^(([0-9]{1}+[0-9]{1}+[0-9]{1}+[0-9]{1})+([-]{1})+((((([0]{1})+(([1]{1})||([3-9]{1})))||(([1]{1})+([0-2]{1})))+([-]{1})+(([0]{1}+[1-9]{1})||([1-2]{1}+[0-9]{1})||([3]{1}+[0-1]{1})))||((([0]{1})+([2]{1}))+([-]{1})+(([0]{1}+[1-9]{1})||([1-2]{1}+[0-9]{1})))))$/";
		$resultado = preg_match($DataPadrao, $pr_condicao);
		return $resultado;
	}

	
	// - Compara Valor de Ingresso  -//
	function ComparaValor($pr_condicao){
		$PadraoValor="/^(([0-9]{1,5})||((([0-9]{1,3})+[.]{1}+(([0-9]{1}+[0-9]{1})||([0-9]{1})))||(([0]{1})+([.]{1})+(([0]{1}+[1-9]{1})||([1-9]{1}+[0-9]{1})))))$/";
		$resultado = preg_match($PadraoValor, $pr_condicao);
		return $resultado;
	}
	function ComparaValorVazio($pr_condicao){
		$VazioValor="/^(([0]{1,})||([0]{1,3}+[.]{1}+[0]{1,2}))$/";
		$resultado = preg_match($VazioValor, $pr_condicao);
		return $resultado;
	}

	
	// - Compara Quantidades de Ingresso preenchida corretamente -//
	function ComparaQuant($pr_condicao){
		$PadraoQuant="/^([0-9]{1,10})$/";
		$resultado = preg_match($PadraoQuant, $pr_condicao);
		return $resultado;
	}
	function ComparaQuantVazio($pr_condicao){
		$VazioQuant="/^([0]{1,})$/";
		$resultado = preg_match($VazioQuant, $pr_condicao);
		return $resultado;
	}
	
	
	// - Compara Quantidades de Ingresso preenchida corretamente -//
	function ComparaQuantMax($pr_condicao){
		$PadraoQuant="/^([0-4]{1})$/";
		$resultado = preg_match($PadraoQuant, $pr_condicao);
		return $resultado;
		}
		
		
	// - Compara Numero do Telefone - //
	function ComparaTelefone($pr_condicao){
		$TelefonePadrao = "/^([0-9]{9,12})$/";
		$resultado = preg_match($TelefonePadrao, $pr_condicao);
		return $resultado;
	}
	
	
	// - Compara Numero do doc - //
	function ComparaDocumento($pr_condicao, $pr_tipo){
		if($pr_tipo==1){
			$DocPadrao = "/^([0-9]{3}+[.]{1}+[0-9]{3}+[.]{1}+[0-9]{3}+[-]{1}+[0-9]{2})$/";
			$resultado = preg_match($DocPadrao, $pr_condicao);
		}else{
			$resultado=true;
		}
		return $resultado;
	}
	
	
	// - Compara Email - //
	function ComparaEmail($pr_condicao){
		$EmailPadrao = "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
		$resultado = preg_match($EmailPadrao, $pr_condicao);
		return $resultado;
	}
?>