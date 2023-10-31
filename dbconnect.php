<?php
	$servidorBD = "localhost";
	$userDB = "root";
	$senhaDB = "";
	$bancoDB = "caralivro";

	$linkDB = mysqli_connect($servidorBD,$userDB,$senhaDB,$bancoDB);
	if (!$linkDB){
		echo("Erro: ".mysqli_connect_error()."<br>");
		die("DEU PRA CONECTAR NÃO MENOR");
	}
?>