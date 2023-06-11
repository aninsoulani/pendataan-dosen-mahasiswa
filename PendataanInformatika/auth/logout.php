<?php
	session_start();
	unset($_SESSION['id_users']);
	session_destroy();
	header('location:../../');
?>