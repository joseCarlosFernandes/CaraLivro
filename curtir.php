<?php
	require("sessao.php");
	$idC = $_GET['idC'];
	$idU = $_SESSION['idU'];
	$i = 0;
	$id_curtida;

	$idC2 = $idC;
	$idU2 = $idU;
	require("dbconnect.php");

	$sql_verif="select id_usuario, id_curtida from curtidas where id_perfil = '$idC2'";
	$data_verif = mysqli_query($linkDB, $sql_verif);
	while($verif = mysqli_fetch_array($data_verif)){
		if ( $verif['id_usuario'] == $idU2) {
			$i++;
			$id_curtida = $verif['id_curtida'];
		}
	}
	if ($i != 0) {
		$del_cur = "delete from curtidas where id_curtida='$id_curtida'";
		$data_del = mysqli_query($linkDB, $del_cur);

		header("Location: perfil.php?id=".$idC2);
	}else{
		$sql = "insert into curtidas (id_perfil, id_usuario) values ('$idC2', '$idU2')";
		$dataset = mysqli_query($linkDB, $sql);

		header("Location: perfil.php?id=".$idC2);
	}
?>