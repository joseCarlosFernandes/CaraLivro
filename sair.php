<?php
	unset($_SESSION);
	session_abort();
	ob_clean();
	header("Location: index.php");
?>