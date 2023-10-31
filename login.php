<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<?php
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		require("dbconnect.php");
		require("sessao.php");
		require("criptografia.php");

		$sql = "select id, nomeUsuario, senha from users where email= ?";
		$stmt = mysqli_prepare($linkDB, $sql);
		if(!$stmt){
			die ("Erro ao preparar consulta");
		}
		if(!mysqli_stmt_bind_param($stmt, "s" ,$email)) { 
            die("Não foi possível consultar os parâmetros!");
        }
        if(!mysqli_stmt_execute($stmt)) {
            die("Não foi possível executar!");
        }
        if(!mysqli_stmt_bind_result($stmt, $id, $nomeUsuario, $senhaBD)){
            die("cominação sem resultado"); 
        }
        $fetch=mysqli_stmt_fetch($stmt);
        if(!$fetch){
            die("Não foi possível recuperar dados!");
        }
        if($fetch == null){
            die("Usuário não localizado");     	
        }else {
        	if (!ChecaSenha($senha,$senhaBD)){
           	 	die("Usuário/senha não localizado no banco de dados ");
           	}
        	session_cache_expire(15);
            $session = session_start();
			$_SESSION['id'] = session_id();
			$_SESSION['idU'] = $id;
			$_SESSION['nomeUsuario'] = $nomeUsuario;
			$_SESSION['senhaBD'] = $senha;
        	ob_clean();
			header("Location: homescreen.php");
        }

	?>

</body>
</html>