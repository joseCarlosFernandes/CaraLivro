<?php

function GeraAlgo($tamanho){
	$numeros = '0123456789';
	$novoId = ' ';

	for($lni = 0; $lni < $tamanho; $lni++){
		$sorte = intval(rand(0,9));
		$novoId = substr($numeros, $sorte, 1);
	}
	return $novoId;
}


function CriaId($nome){
	$meionome = substr($nome,0, 6);
	$arroba = "@".$meionome.GeraAlgo(3);
	return $arroba;
}


?>