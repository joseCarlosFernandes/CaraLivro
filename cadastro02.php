<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro Cad</title>
</head>
<body>
	<?php
		require("dbconnect.php");
		require("functions.php");
		require("criptografia.php");
		$nome = $_POST['username'];
		$senha = $_POST['senha'];
		$senha2 = $_POST['senha2'];
		$email = $_POST['email'];
		$imagem = $_FILES['img_perfil']['tmp_name'];
		$tipo = $_FILES['img_perfil']['type'];
		$tamanho = $_FILES['img_perfil']['size'];

		//validação php
		$mensagem="";
		if($senha != $senha2){
			$mensagem+="Senhas não combinam";
		}
		if($mensagem!=""){
			die("Atenção: <br> $mensagem");
		}	
		if($nome == ""){
			die("Atenção: O Nome não pode ser vazio");
		}	

		$senhaCrip=FazSenha($senha, $nome);

		$fp = fopen($imagem, "rb");
		$conteudo = fread($fp, $tamanho);
		$conteudo = addslashes($conteudo);
	   	fclose($fp);

	   	$ID = CriaId($nome);

   		$sql = "insert into users (id, nomeUsuario, senha, imgUser, email, tipoImg) values ('$ID',?, '$senhaCrip', '$conteudo', ?,'$tipo')";
   		$stmt = mysqli_prepare($linkDB, $sql);
   		if(!$stmt){
   			die("Erro ao cadastrar");
   		}
   		if(!mysqli_stmt_bind_param($stmt, "ss" ,$nome,$email)){
   			die("Não foi possível consultar os parâmetros!");
   		}
   		if(!mysqli_stmt_execute($stmt)) {
                die("Não foi possível executar!");
        }
   		header("Location: index.php");

	?>

</body>
</html>