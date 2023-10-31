<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="F:\XAMPP\htdocs\CaraLivro\Imagens\caralivro.ico" type="image/ico">
	<title>Login</title>
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
		#f-login input{
			padding: 10px;
			margin-top: 10px;
			border: none;
			height: 40px;
			outline: none;
			cursor: pointer;
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
		#email{
			border-radius: 8px;
			color: white;
			background-color: #293847;
		}
		#senha{
			border-radius: 8px;
			color: white;
			background-color: #293847;
		}
		input::placeholder
		{
			color: white;
			font-size: 15px;
		}
		p
		{
			color: white;
		}

		a
		{	
			margin: 10px;
			color: #489edb;
		}

		a:hover
		{	
			color: white;
			background-color: #489edb;
		}

		#logo{
			width: 400px;
			height: 100px;
		}
		#logo-div{
			position: relative;
			top: -90px;
			left: -90px;
			color: white;
		}
		#descricao{
			color: white;
		}
	</style>
</head>
<body>
	<div id="A-login">
		<div id="logo-div">
			<img id="logo" src="Imagens\CaraLivro.png"><br>
			<h2>O CaraLivro² ajuda você a.... não sei, não testei,<br> escreve umas coisa ai, e ve no que dá</h2>
		</div>
		<div id="f-login">
			<div>
				<form name="fLogin" method="POST" action="login.php">
					<input type="text" name="email" maxlength="50" placeholder="E-Mail" id="email"><br>
					<input type="password" name="senha" placeholder="Senha" id="senha"><br>
					<input type="submit" style="--crl:#1e9bff" name="entrar" value="ENTRAR" id="btn"><br>
				</form>
				<p>Ainda não tem uma conta? <a href="cadastro.php">Criar conta</a></p>
			</div>
		</div>
	</div>

</body>
</html>