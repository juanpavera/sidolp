<?php
ob_start();

session_start();
require_once("funciones_generales.inc.php");
$id_conexion=conectar_mysql();

if(!isset($_SESSION['ci']) && !isset($_SESSION['ext'])){
	if(isset($_POST['ingresar'])){
		$ci=mysql_real_escape_string($_POST['ci']);
		$ext=mysql_real_escape_string($_POST['ext']);
		$empresa=mysql_real_escape_string($_POST['id']);
		$registrar_inclusion=registrar_inclusion($id_conexion,$ci,$ext,$empresa);
		
		if($registrar_inclusion==1){
			//header("location: ../../autorizacion_main.php");
			//header("location: ../../solicitar_autorizacion.php");
			header("location: ../../../autorizacion_solicitud.php");
			//echo "HOLA";
			exit();
		}elseif($registrar_inclusion==0){
			session_unset();
			session_destroy();
			//header("location: ../login_autorizacion.php?error=".$registrar_inclusion);
			header("location: ../../../autorizacion_panel.php?error=".$registrar_inclusion);
		}		
	}else{
		echo "No se puede iniciar sesión";
	}
}else{
	$ci=mysql_real_escape_string($_POST['ci']);
	$ext=mysql_real_escape_string($_POST['ext']);
	$empresa=mysql_real_escape_string($_POST['id']);
	$registrar_inclusion=registrar_inclusion($id_conexion,$ci,$ext,$empresa);
	
	if($registrar_inclusion==1){
		//header("location: ../../autorizacion_main.php");
		//header("location: ../../solicitar_autorizacion.php");
		header("location: ../../../autorizacion_solicitud.php");
		//echo "HOLA";
		exit();
	}elseif($registrar_inclusion==0){
		session_unset();
		session_destroy();
		//header("location: ../login_autorizacion.php?error=".$registrar_inclusion);
		header("location: ../../../autorizacion_panel.php?error=".$registrar_inclusion);
	}
}
	
	ob_end_flush();
?>