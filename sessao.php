<?php
	session_start();
	if(!isset($_SESSION['idU'])){ 
		ob_clean();
		header("Location: index.php");
	}
?>