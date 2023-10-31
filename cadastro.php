<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro</title>
	<style type="text/css">
		body{
			background:#1a1919;
			font-family: sans-serif;
			overflow: hidden;
		}
		#A-login{
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}
		#f-login{
			display: flex;
			flex-direction: column;
			align-items: center;
			border: 5px ridge #e6e6e6;
			background-color: #000d1a;
			width: 355px;
			height: 325px;
			padding: 35px;
		}
		#f-login form
		{
			display: flex;
			width: 100%;
			flex-direction: column;
			
		}
		#nome{
			padding: 10px;
			margin-top: 10px;
			border: none;
			height: 15px;
			outline: none;
			cursor: pointer;
			border-radius: 8px;
			color: white;
			background-color: #293847;
		}
		#senha{
			padding: 10px;
			margin-top: 10px;
			border: none;
			height: 15px;
			outline: none;
			cursor: pointer;
			border-radius: 8px;
			color: white;
			background-color: #293847;
		}
		#email{
			padding: 10px;
			margin-top: 10px;
			border: none;
			height: 15px;
			outline: none;
			cursor: pointer;
			border-radius: 8px;
			color: white;
			background-color: #293847;
		}
		#btn{
			height: 40px;
			position: relative;
			font-size: 15px;
			text-decoration: none;
			text-shadow: 0 0 5px var(--crl);
			background: #000d1a;
			color: white;
			text-transform: uppercase;
			transition: 0.5s;
			border: none;
			outline: none;
			cursor: pointer;
		}
		#btn:hover{
			position: relative;
			background: var(--crl);
			letter-spacing: 0.25em;
			font-size: 15px;
			color: var(--crl);
			box-shadow: 0 0 35px var(--crl);
	 		color: white;
		}
		input::placeholder
		{
			color: white;
			font-size: 15px;
		}
		input[type="file"]{
			display: none;
		}
		label{
			height: 15px;
			position: relative;
			font-size: 15px;
			text-decoration: none;
			text-shadow: 0 0 5px var(--crl);
			background: #000d1a;
			color: white;
			text-transform: uppercase;
			transition: 0.5s;
			border: none;
			outline: none;
			cursor: pointer;
		}
		label:hover{
			position: relative;
			background: var(--crl);
			letter-spacing: 0.10em;
			font-size: 15px;
			color: var(--crl);
			box-shadow: 0 0 35px var(--crl);
	 		color: white;
		}
	</style>
</head>
<body>
	<div id="A-login">
		<div id="f-login">
			<form enctype="multipart/form-data" name="fCadastro" method="POST" action="cadastro02.php">
				<input type="text" name="username" placeholder="Nome de usuário" maxlength="18" id="nome"><br>
				<input type="text" name="email" maxlength="50" placeholder="E-Mail" id="email"><br>
				<input type="password" name="senha" maxlength="20" placeholder="Senha" id="senha"><br>
				<input type="password" name="senha2" maxlength="20" placeholder="Repita a Senha" id="senha"><br>
				<label for="img-input">Escolher Imagem de Perfil</label>
				<input type="file" name="img_perfil" id="img-input" accept="image/png, image/gif, image/jpeg, image/jfif, image/webp" id="img-input"><br>
				<br>
				<input type="submit" style="--crl:#1e9bff" name="cadastrar" value="Cadastrar" id="btn">
			</form>
		</div>
	</div>
</body>
</html>