<?php
	session_start();

	session_unset();

	session_destroy();

	header('Location: ini_sesion.html');
?>