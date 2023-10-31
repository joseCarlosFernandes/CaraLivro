<?php
	require("sessao.php");
	require("dbconnect.php");
	$idS = $_GET['idS'];
	$idU = $_SESSION['idU'];
	$i = 0;
	$id_seguidores;

	//verificar se já não segue
	$sql_verif = "select id_user, id_segui from seguidores where id_PerfilSeguido = '$idS'";
	$data_verif = mysqli_query($linkDB, $sql_verif);
	while($verif = mysqli_fetch_assoc($data_verif)){
		if($verif['id_user'] == $idU){
			$i++;
			$id_seguidores = $verif['id_segui'];
		}
	}
	if($i != 0){
		$del_segui = "delete from seguidores where id_segui = '$id_seguidores'";
		$data_del = mysqli_query($linkDB, $del_segui);

		header("Location: perfil.php?id=".$idS);
	}
	else{
		$sql = "insert into seguidores (id_user, id_PerfilSeguido) values ('$idU', '$idS')";
		$dataset = mysqli_query($linkDB, $sql);

		header("Location: perfil.php?id=".$idS);
	}

?>