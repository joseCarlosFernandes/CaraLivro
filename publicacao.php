<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>Publicar</title>
	<style type="text/css">
		.publitxt{
  			text-align: center;
			position: absolute;
			width:100%;
		}
		#form{
			top: 20px;
			display: inline-block;
			position: relative;
		}
		body{
  			background: #1a1919;
  		}
  		
	</style>
</head>
<body>
	<?php
		require("sessao.php");
		$id = $_SESSION['idU'];
		require("dbconnect.php");

		$sql = "select imgUser, tipoImg, nomeUsuario from users where id = '$id'";
		$dataset = mysqli_query($linkDB, $sql);
		
		$imagem = $dataset->fetch_assoc();
		$mime = $imagem['tipoImg'];
		$primeira_imagem = 'data:' . $mime . ';base64,' . base64_encode($imagem['imgUser']);
		$nome = $imagem['nomeUsuario'];
	?>

	<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-bottom">
 		 <div class="container-fluid">
     		<img src="<?php echo "$primeira_imagem";?>" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
     		<ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="homescreen.php">Voltar ↩</a>
		      </li>
		    </ul>
  		</div>
	</nav>


	<div class="publitxt">
		<form enctype="multipart/form-data" name="publitxt" method="POST" action="publicacao02.php" id="form">
			<textarea id="publicacao" name="publicacao" rows="10" cols="50" placeholder="Publicar como <?php echo "$nome";?>" maxlength="150" style="resize: none; font-size: 20px;" autofocus></textarea><br>
			<input type="file" name="img_post" id="img_post" accept="image/jpg, image/png, image/gif, image/jpeg, image/jfif, image/webp"><br>
			<input type="hidden" name="idU" value="<?php echo "$id";?>"><br>
			<input class="btn btn-dark btn-lg" type="submit" name="btn_enviar" value="Publicar ✎">
		</form>
	</div>
</body>
</html>