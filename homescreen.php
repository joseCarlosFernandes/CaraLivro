<?php
	require("sessao.php"); 
	require("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="style.css">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>Home</title>
	<style type="text/css">
		#userimg{
			height: 100px;
			width: 100px;
		}
		#imagemUser{
			height: 20px;
			width: 20px;
			border-radius: 100px;
		}
		#forum{
			width: 100%;
			height: 100vh;
		}
		.flex-container {
    		display: flex;
  		}
  		.postagens{
  			position: relative;
  			margin: 0 auto;
  			width: 1000px;
			height: 80vh;
			top: 30px;
			background: #d6d4d2;
  		}
  		body{
  			background: #1a1919;
  		}

	</style>
</head>
<body>
	<?php
		$nome = $_SESSION['nomeUsuario'];
		$id = $_SESSION['idU'];

		$sql = "select imgUser, tipoImg from users where id = '$id'";
		$dataset = mysqli_query($linkDB, $sql);
		
		$imagem = $dataset->fetch_assoc();
		$mime = $imagem['tipoImg'];
		$primeira_imagem = 'data:' . $mime . ';base64,' . base64_encode($imagem['imgUser']);
	?>

	<div class="fab">
	  <a href='publicacao.php'><button class="main"></button></a>
	</div>

	<!-- navbar -->
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
 		 <div class="container-fluid">
     		<a class="nav-link" href="editarperfil.php"><img src="<?php echo "$primeira_imagem";?>" alt="Avatar Logo" style="width:40px;" class="rounded-pill"></a>
     		<form class="d-flex" method="POST" action="pesquisar.php">
		        <input class="form-control me-2" type="text" placeholder="Pesquisar Pessoas" name="arroba">
		        <input type="hidden" name="iduser" value="<?php echo "$id";?>">
		        <input type="submit" name="pesquisar" value="⌕" class="btn btn-primary" maxlength="10">
      		</form>
     		<ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="sair.php">Sair ✖</a>
		      </li>
		    </ul>
  		</div>
	</nav>

	<div class="flex-container">
		<div id="forum">
			<?php 

			/*$sql_s = "select id_PerfilSeguido from seguidores where id_user='$id'";
			$dataset_s = mysqli_query($linkDB, $sql_s);

			while($linhaS = mysqli_fetch_assoc($dataset_s)){
				$id_perfil = $linhaS['id_PerfilSeguido'];*/
			
				$sql2 = "select id, textopubli, imagem, tipoImg, data from publicacoes order by data DESC";
				$dataset2 = mysqli_query($linkDB, $sql2);

				?>
				<div class="mensagens">
				<?php
				while($linha=mysqli_fetch_assoc($dataset2)){
					//pegar publicação
					$id_post = $linha['id'];
					$texto = $linha['textopubli'];
					$tipo = $linha['tipoImg'];
					$data = $linha['data'];

					//pegar imagens postadas
					if ($tipo == null) {
						$imgPost = " ";
						$altura = "0px";
						$largura = "0px";
					}else{
						$imgPost = 'data:' . $tipo .  ';base64,' . base64_encode($linha['imagem']);
						$altura = "350px";
						$largura = "350px";
						
					}

					//pegar imagem do usuário
					$sqlImgU = "select nomeUsuario, imgUser, tipoImg from users where id = '$id_post'";
					$datasetImgU = mysqli_query($linkDB, $sqlImgU);
					$imagemU = $datasetImgU->fetch_assoc();
					$mimeUser = $imagemU['tipoImg'];
					$imagemUser = 'data:' . $mimeUser . ';base64,' . base64_encode($imagemU['imgUser']);
					$nomeUsuario = $imagemU['nomeUsuario'];

					?>
						<br>
						<div class="postagens">
							<div class="nome"> 
								<img id="imagemUser" src="<?php echo "$imagemUser";?>" style="position: relative; left:10px;">
								<a style="position: relative; left:10px;" href="perfil.php?id=<?php echo "$id_post";?>"><?php echo "$nomeUsuario";?></a> <small style="position:relative; left:10px;"><?php echo "$data";?></small>
							</div>
							<div id="publi" style="position:relative; left:10px;"> <?php echo "$texto";?><br></div>
							<img id="imgPost" src="<?php echo "$imgPost";?>" style="position: relative; left:10px; width: <?php echo "$largura"; ?>; height:<?php echo "$altura"; ?>">
					<?php
				}
			?>
				</div>
		</div>
	</div>
</body>
</html>