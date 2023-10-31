<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>Pesquisa de Usuário</title>
</head>
<style type="text/css">
	#imgpesq{
		height: 100px;
		width: 100px;
		border-radius: 100px;
	}
	.container{
		position: relative;
		top: 80px;
		border-radius: 10px;
		transition: 0.3s;
	}
	.container:hover{
		box-shadow: 0 0 15px #489edb;
	}
	#nome{
		position: relative;
		top: 5px;
		text-decoration: none;
	}
	#bio{
		position: relative;
		left: 50px;
		text-decoration: none;
	}
	.flex-container{
		display: flex;
	}
	body{
		background:#505250;
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
<body>
	<?php
		require("sessao.php");
		require("dbconnect.php");
		$arroba = $_POST['arroba'];
		$idU = $_POST['iduser'];

		$sql = "select id, nomeUsuario, imgUser, tipoImg, bio from users where id like '%$arroba%'";
		$dataset = mysqli_query($linkDB, $sql);

		/*
		$linhaBD = mysqli_fetch_assoc($dataset);
		$nome = $linhaBD['nomeUsuario'];
		$bio = $linhaBD['bio'];
		$tipo = $linhaBD['tipoImg'];
		$imagem = 'data:' . $tipo . ';base64,' . base64_encode($linhaBD['imgUser']);
		*/

		//dados de quem esta usando
		$sql2 = "select tipoImg, imgUser from users where id = '$idU'";
		$dataset2 = mysqli_query($linkDB, $sql2);
		$linha2 = mysqli_fetch_assoc($dataset2);
		$tipoImg = $linha2['tipoImg'];
		$img = 'data:' . $tipoImg . ';base64,' . base64_encode($linha2['imgUser']);

	?>

	<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
 		 <div class="container-fluid">
     		<a class="nav-link" href="editarperfil.php?id=<?php echo "$idU"; ?>"><img src="<?php echo "$img";?>" alt="Avatar Logo" style="width:40px;" class="rounded-pill"></a>
     		<form class="d-flex" method="POST" action="pesquisar.php">
		        <input class="form-control me-2" type="text" placeholder="Pesquisar Pessoas" name="arroba">
		        <input type="hidden" name="iduser" value="<?php echo "$idU";?>">
		        <input type="submit" name="pesquisar" value="⌕" class="btn btn-primary">
      		</form>
     		<ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="homescreen.php">Voltar ↩</a>
		      </li>
		    </ul>
  		</div>
	</nav>

	<!-- botão voltar -->
	<div class="fab">
	  <a href='homescreen.php'><button class="main"></button></a>
	</div>

	<!-- retornos -->
	<?php 
		while($linhaBD = mysqli_fetch_assoc($dataset)){
			$id = $linhaBD['id'];
			$nome = $linhaBD['nomeUsuario'];
			$bio = $linhaBD['bio'];
			$tipo = $linhaBD['tipoImg'];
			$imagem = 'data:' . $tipo . ';base64,' . base64_encode($linhaBD['imgUser']);

			?>
			<a href = "perfil.php?id=<?php echo "$id";?>">
				<div class="container p-5 my-5 bg-dark text-white ">
					<div class="flex-container">
						<img id="imgpesq" src="<?php echo "$imagem"; ?>">
						<div id="bio"><?php echo "$bio";?></div>
					</div>
					<h1><?php echo "$nome";?></h1>
				</div>
			</a>
			<?php
		}
		?>
</body>
</html>