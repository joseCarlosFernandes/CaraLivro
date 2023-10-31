<?php
	require("dbconnect.php");
	require("sessao.php");
	$id_publi = $_GET['id_publi'];
	

	$sql = "delete from publicacoes where id_mensagem='$id_publi'";
	$dataset = mysqli_query($linkDB, $sql);

	header("Location: editarperfil.php");
?>