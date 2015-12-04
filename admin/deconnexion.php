<?php
session_start();
	if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])){
		session_destroy();
		header("location: index.php");
	}
?>