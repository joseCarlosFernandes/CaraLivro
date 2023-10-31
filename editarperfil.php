<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>Editar Perfil</title>
	<style type="text/css">
		#imagemUser{
			position: relative;
			left: 45px;
			top: 5px;
			height: 200px;
			width: 200px;
			border-radius: 100px;
			border: 5px solid white;
		}
		#btnEditar{
			position: relative;
			left: 220px;
			top: 31px;
			border-radius: 100px;
		}
		#nometxt{
			position: relative;
			left: 34px;
		}
		#btnmod{
			position: relative;
			left: 92px;
			top: 5px;
		}
		#flex-container{
			display: flex;
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
		body{
			background: #1a1919;
		}
		#bio{
			position: relative;
			left: 10px;
			top: 5px;
		}
		#arroba{
			position: relative;
			left: 10px;
		}
		#postagens{
			position: relative;
			left: 80px;
			top: 40px;
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
		#nomeP{
			color: white;
		}
		#imagemP{
			height: 20px;
			width: 20px;
			border-radius: 100px;
		}
		#publi{
			color: white;
		}
		#btn_apg{
			border-radius: 100px;
		}
		#curtidas{
			color: white;
			font-size: 30px;
			position: relative;
			left: 15px;
			top: 5px;
		}
		#update_img{
			visibility: hidden;
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
	<script type="text/javascript">
		click = 0;
		function editarnome(){
			if(click == 0){
				document.getElementById("nometxt").readOnly = false;
				document.getElementById("bio").readOnly = false;
				document.getElementById("btnmod").style.visibility = "visible";
				document.getElementById("update_img").style.visibility = "visible";
				click = 1;
			}
			else {
				document.getElementById("nometxt").readOnly = true;
				document.getElementById("bio").readOnly = true;
				document.getElementById("btnmod").style.visibility = "hidden";
				document.getElementById("update_img").style.visibility = "hidden";
				click = 0;
			}
		}
	</script>
</head>
<body>
	<?php
		require("sessao.php");
		$id = $_SESSION['idU'];
		$curtidas = 0;
		require("dbconnect.php");

		$sql = "select nomeUsuario, imgUser, tipoImg, bio from users where id = '$id'";
		$dataset = mysqli_query($linkDB, $sql);

		$linhaBD=mysqli_fetch_assoc($dataset);
		$nome = $linhaBD['nomeUsuario'];
		$bio = $linhaBD['bio'];
		$tipoImg = $linhaBD['tipoImg'];
		$imagemUser = 'data:' . $tipoImg . ';base64,' . base64_encode($linhaBD['imgUser']);

		$sql_curtidas = "select * from curtidas where id_perfil = '$id'";
		$dataset_curtidas = mysqli_query($linkDB, $sql_curtidas);
		while($c_linha=mysqli_fetch_assoc($dataset_curtidas)){
			$curtidas++;
		}
	?>

	<!-- navbar 
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-bottom">
 		 <div class="container-fluid">
     		<img src="<?php echo "$imagemUser";?>" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
     		<ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="homescreen.php">Voltar ↩</a>
		      </li>
		    </ul>
  		</div>
	</nav>
	-->

	<div class="fab">
	  <a href='homescreen.php'><button class="main"></button></a>
	</div>

	<div id="flex-container">
		<div id="infos">
			<img id="imagemUser" src="<?php echo "$imagemUser";?>"><br>
			<button class="btn btn-outline-dark btn-sm" id="btnEditar" onclick="editarnome()">✎</button><br>

			<!-- perfil nome/bio -->
			<form name="fmod" enctype="multipart/form-data" method="POST" action="editarperfil02.php">
				<input type="text"  name="modnome" value="<?php echo "$nome";?>" maxlength= "18" size="19" id="nometxt" style="text-align: center;" readonly="true">
				<textarea id="bio" name="bio" rows="5" cols="30" maxlength="150" readonly="true" style="resize: none;"><?php echo "$bio";?></textarea><br>
				<div id="arroba"><?php echo "$id";?></div><br>

				<input type="file" name="update_img" id="update_img" accept="image/jpg, image/png, image/gif, image/jpeg, image/jfif, image/webp"><br>

				<input class="btn btn-outline-dark" type="submit" name="btn_mod" value="Salvar" style="visibility:hidden; border-radius:100px;" id="btnmod">
			</form>
			<div id="curtidas">
				<?php echo "$curtidas" ?> ❤
			</div>
		</div>

		<!-- publicações -->
		<div id="posts">
			<h1 style="color: white; position:relative; left: 80px; top: 20px;">Postagens</h1>
			<?php
				$sql3 = "select textopubli, data, id_mensagem, imagem, tipoImg from publicacoes where id = '$id' order by data DESC";
				$dataset3 = mysqli_query($linkDB, $sql3);
					while($linha=mysqli_fetch_assoc($dataset3)){
						$postagens = $linha['textopubli'];
						$data = $linha['data'];
						$id_mensagem = $linha['id_mensagem'];
						$tipoPubli = $linha['tipoImg'];

						if ($tipoPubli == null) {
							$imgPubli = " ";
							$altura = "0px";
							$largura = "0px";
						}else{
							$imgPubli = 'data:' . $tipoPubli .  ';base64,' . base64_encode($linha['imagem']);
							$altura = "300px";
							$largura = "300px";
							
						}
						?>
							<div id="postagens">
								<div class="nome"> 
									<img id="imagemP" src="<?php echo "$imagemUser";?>">
									<div id="nomeP"><?php echo "$nome";?> <small><?php echo " $data";?></small></div>
								</div>
								<div id="publi"> <?php echo "$postagens";?> <button id="btn_apg" onclick="window.location.href = 'deletarpubli.php?id_publi=<?php echo "$id_mensagem"; ?>'">🗑</button><br></div>
								<img id="imgPost" src="<?php echo "$imgPubli" ?>" style="width: <?php echo "$largura";?>; height:<?php echo "$altura";?>;">
							</div>
						<?php
					}
			?>
		</div>
	</div>
</body>
</html>