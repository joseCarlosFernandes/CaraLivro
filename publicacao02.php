<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>publicar</title>
</head>
<body>
	<?php
		require("dbconnect.php");
		require("sessao.php");
		$publicacao = $_POST['publicacao'];
		$id = $_SESSION['idU'];
		$imagem = $_FILES['img_post']['tmp_name'];
		$tipo = $_FILES['img_post']['type'];
		$tamanho = $_FILES['img_post']['size'];

		if ($imagem == null) {
			$sql = "insert into publicacoes (textopubli, id) values (?,?)";
			$stmt = mysqli_prepare($linkDB, $sql);
			if(!$stmt){
				die("Erro ao publicar");
			}
			if(!mysqli_stmt_bind_param($stmt, "ss" ,$publicacao,$id)){
   				die("Não foi possível consultar os parâmetros!");
   			}
   			if(!mysqli_stmt_execute($stmt)) {
                die("Não foi possível executar!");
        	}
		}
		else{
			$fp = fopen($imagem, "rb");
			$conteudo = fread($fp, $tamanho);
			$conteudo = addslashes($conteudo);
	   		fclose($fp);

   			$sqlInserirImagem = "insert into publicacoes (textopubli, id, imagem, tipoImg) values (?,?, '$conteudo', '$tipo')";
   			$stmtImg = mysqli_prepare($linkDB, $sqlInserirImagem);
   			if(!$stmtImg){
				die("Erro ao publicar");
			}
			if(!mysqli_stmt_bind_param($stmtImg, "ss" ,$publicacao,$id)){
   				die("Não foi possível consultar os parâmetros!");
   			}
   			if(!mysqli_stmt_execute($stmtImg)) {
                die("Não foi possível executar!");
        	}
   		}
			header("Location: homescreen.php");
	?>

</body>
</html>