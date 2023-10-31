<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Editar Perfil</title>
</head>
<body>
	<?php
		require("sessao.php");
		require("dbconnect.php");
		$nome = $_POST['modnome'];
		$id = $_SESSION['idU'];
		$bio = $_POST['bio'];
		
		$imagem = $_FILES['update_img']['tmp_name'];
		$tipo = $_FILES['update_img']['type'];
		$tamanho = $_FILES['update_img']['size'];

	   	if($imagem == null){

	   		$sql = "update users set nomeUsuario = '$nome', bio=? where id = '$id'";
			$stmt = mysqli_prepare($linkDB,$sql);

	   	}else{

	   		$fp = fopen($imagem, "rb");
			$conteudo = fread($fp, $tamanho);
			$conteudo = addslashes($conteudo);
	   		fclose($fp);

	   		$sql = "update users set nomeUsuario = '$nome', bio=?, imgUser ='$conteudo', tipoImg = '$tipo' where id = '$id'";
			$stmt = mysqli_prepare($linkDB,$sql);
	   	}

		if(!$stmt){
			die("Erro ao atualizar usuário");
		}
		if(!mysqli_stmt_bind_param($stmt, "s" ,$bio)){
   				die("Não foi possível consultar os parâmetros!");
   		}
   		if(!mysqli_stmt_execute($stmt)) {
                die("Não foi possível executar!");
        }
		header("Location: homescreen.php");


	?>
</body>
</html>