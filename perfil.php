<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>Perfil de usuário</title>
	<style type="text/css">
		.flex-container{
			display: flex;
		}
		#imagemPerfil{
			position: relative;
			left: 45px;
			top: 5px;
			height: 200px;
			width: 200px;
			border-radius: 100px;
			border: 5px solid white;
		}
		#infos{
			display: inline-block;
			position: relative;
			left: 20px;
			top: 5px;
			background-color: #6C7A89;
			width: 300px;
			height: 100vh;
		}
		#nome{
			color: white;
			-webkit-text-stroke-width: 1px;
    		-webkit-text-stroke-color: #000;
    		font-size: 30px;
			position: relative;
			top: 5px;
			left: 10px;
		}
		body{
			background: #1a1919;
		}
		#imagemUser{
			height: 20px;
			width: 20px;
			border-radius: 100px;
		}
		#nomeP{
			color: white;
		}
		#publi{
			color: white;
		}
		#postagens{
			position: relative;
			left: 80px;
			top: 40px;
		}
		#bio{
			position: relative;
			color: white;
			left: 10px;
			top: 20px;
		}
		#curtidas{
			color: white;
			font-size: 30px;
			position: relative;
			left: 65px;
			top: 40px;

		}
		#seguidores{
			color: white;
			font-size: 30px;
			position: relative;
			left: 65px;
			top: 60px;
		}
		#arroba{
			position: relative;
			left: 10px;
			top: 3px;
		}


		/* botão voltar */
		.fab{
		  position: fixed;
		  bottom:10px;
		  right:10px;
		}

		.fab button{
		  cursor: pointer;
		  width: 48px;
		  height: 48px;
		  border-radius: 30px;
		  background-color: #cb60b3;
		  border: none;
		  box-shadow: 0 1px 5px rgba(0,0,0,.4);
		  font-size: 24px;
		  color: white;
		    
		  -webkit-transition: .2s ease-out;
		  -moz-transition: .2s ease-out;
		  transition: .2s ease-out;
		}

		.fab button:focus{
		  outline: none;
		}

		.fab button.main{
		  position: absolute;
		  width: 60px;
		  height: 60px;
		  border-radius: 30px;
		  background-color: #5b19b7;
		  right: 0;
		  bottom: 0;
		  z-index: 20;
		}

		.fab button.main:before{
		  content: '↩';
		}
	</style>
</head>
<body>
	<?php
		require("sessao.php");
		$id = $_GET["id"];
		$idU = $_SESSION['idU'];
		$curtidas = 0;
		$seguidores = 0;
		require("dbconnect.php");

		if ($id == $idU) {
			header("Location: editarperfil.php");
		}
		else{
		//perfil aberto
		$sql = "select nomeUsuario, imgUser, tipoImg, bio from users where id = '$id'";
		$dataset = mysqli_query($linkDB, $sql);

		$linhaBD=mysqli_fetch_assoc($dataset);
		$nome = $linhaBD['nomeUsuario'];
		$bio = $linhaBD['bio'];
		$tipoImg = $linhaBD['tipoImg'];
		$imagemUser = 'data:' . $tipoImg . ';base64,' . base64_encode($linhaBD['imgUser']);

		//quantidade de curtidas no perfil aberto
		$sql_curtidas = "select * from curtidas where id_perfil = '$id'";
		$dataset_curtidas = mysqli_query($linkDB, $sql_curtidas);
		while($c_linha=mysqli_fetch_assoc($dataset_curtidas)){
			$curtidas++;
		}

		//quantidade de seguidores no perfil aberto
		$sql_seguidores = "select * from seguidores where id_PerfilSeguido = '$id'";
		$dataset_seguidores = mysqli_query($linkDB, $sql_seguidores);
		while ($s_linha=mysqli_fetch_assoc($dataset_seguidores)) {
			$seguidores++;
		}


		//perfil de quem está usando
		$sql2 = "select nomeUsuario, imgUser, tipoImg from users where id = '$idU'";
		$dataset2 = mysqli_query($linkDB, $sql2);

		$linha2=mysqli_fetch_assoc($dataset2);
		$nomeU = $linha2['nomeUsuario'];
		$tipoImg2 = $linha2['tipoImg'];
		$img = 'data:' . $tipoImg2 . ';base64,' . base64_encode($linha2['imgUser']);

	?>

	<div class="fab">
	  <a href='homescreen.php'><button class="main"></button></a>
	</div>

	<!-- navbar
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-bottom">
 		 <div class="container-fluid">
     		<a class="nav-link" href="editarperfil.php?id=<?php echo "$idU"; ?>"><img src="<?php echo "$img";?>" alt="Avatar Logo" style="width:40px;" class="rounded-pill"></a>
     		<ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="homescreen.php">Voltar ↩</a>
		      </li>
		    </ul>
  		</div>
	</nav>
	-->

	<div class="flex-container">

		<!-- infos do perfil -->
		<div id="infos">
			<img id="imagemPerfil" src="<?php echo "$imagemUser";?>"><br>
			<div class="flex-container">
				<b id="nome"><?php echo "$nome";?></b>
			</div>
			<div id="arroba"><?php echo "$id"?></div>
			<p id="bio"><?php echo "$bio";?></p>

			<!-- botão curtida -->
			<div class="flex-container">
				<div id="curtidas"><?php echo "$curtidas";?></div>
				<a href ="curtir.php?idC=<?php echo "$id";?>" style="text-decoration: none;position:relative; left:2px; top: 40px; font-size: 30px;"> ❤ </a>
			</div>

			<!-- botão seguidor -->
			<div class="flex-container">
				<div id="seguidores"><?php echo "$seguidores";?></div>
				<a href="seguir.php?idS=<?php echo "$id";?>" style="text-decoration: none; position: relative; left:2px; top: 40px;font-size:50px;">★</a>
			</div>
		</div>
		<div id="posts">
			<h1 style="color: white; position:relative; left: 80px; top: 20px;">Postagens</h1>
			<?php
			//recuperar as postagens
				$sql3 = "select textopubli, data, imagem, tipoImg from publicacoes where id = '$id' order by data DESC";
				$dataset3 = mysqli_query($linkDB, $sql3);

				while($linha3=mysqli_fetch_assoc($dataset3)){
					$postagens = $linha3['textopubli'];
					$data = $linha3['data'];
					$tipoPubli = $linha3['tipoImg'];

					if ($tipoPubli == null) {
						$imgPubli = " ";
						$altura = "0px";
						$largura = "0px";
					}else{
						$imgPubli = 'data:' . $tipoPubli .  ';base64,' . base64_encode($linha3['imagem']);
						$altura = "300px";
						$largura = "300px";
						
					}
					?>
						<div id="postagens">
							<div class="nome"> 
								<img id="imagemUser" src="<?php echo "$imagemUser";?>">
								<div id="nomeP"><?php echo "$nome";?> <small><?php echo " $data";?></small></div>
							</div>
							<div id="publi"> <?php echo "$postagens";?><br></div>
							<img id="imgPost" src="<?php echo "$imgPubli" ?>" style="width: <?php echo "$largura";?>; height:<?php echo "$altura";?>;">
						</div>
					<?php
				}
			?>
		</div>
	</div>
	<?php } ?>
</body>
</html>