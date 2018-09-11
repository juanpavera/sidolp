<?php
require_once ('../funciones.class.php');

ob_start(); 
//Lo primero es iniciar la sesión antes de enviar nada, pero
//estableciendo el modo con cookies por si estuviera desactivado
session_start();
$link = new Sidolp();


if(!isset ($_SESSION['usuario'])){
	if ( isset ($_POST['ingresar']) ) {
	
		$login    = mysql_real_escape_string($_POST['user']);
		$password = mysql_real_escape_string($_POST['password']);
		$res_registrar = $link->control_login ($login, $password);
		

		if ( $res_registrar == 1 ){
			header("Location: ../index.php?pg=".md5('INI'));
			exit;			
		} elseif ( $res_registrar == 11 ){
			header("Location: ../index.php?pg=".md5('US_UP'));
			exit;			
		} elseif ( $res_registrar == 2 ){
			session_unset();
			session_destroy();
			header("Location: login.php?msg=".base64_encode($res_registrar));
			exit;
		} elseif ( $res_registrar == 0 ){
			session_unset();
			session_destroy();
			header("Location: login.php?msg=".base64_encode($res_registrar));
			exit;
		} 
	} else {
		header("Location: ../index.php");
		exit;
	}
}else {
	//echo "<h1>con sesion saliiiirrrrrr</h1>" ;
	if(isset($_GET['salir'])) {	
		session_unset();
		session_destroy();
		header("Location: ../index.php");
	} else {
		session_unset();
		session_destroy();
		header("Location: ../index.php");
	}
}
ob_end_flush();
?>