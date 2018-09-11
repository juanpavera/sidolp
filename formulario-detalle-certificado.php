<?php
header("Expires: Thu, 27 Mar 1980 23:59:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
include('config.class.php');
$base_datos = new SidolpDB();
$conexion   = $base_datos->connectDB();

require_once 'formulario-certificado-class.php';

if(isset($_GET['type']) && isset($_GET['cat']) && isset($_GET['ges'])){
	$type      = $_GET['type'];
	$category  = base64_decode($_GET['cat']);
	$gestion   = base64_decode($_GET['ges']);
	
	//VERIFICAMOS SI LA SOLICITUD REQUERIDA ES LA COMPLETA
	$cb = new Fomularios($type, $category, $gestion, $conexion);
	if($cb->error == TRUE){
		switch ($type) {
			case 'PRINT':
				$cb->get_formulario_PRINT();
				break;
			case 'PDF':
				$cb->get_formulario_PDF();
				break;

		}
	}
	else{
		echo 'No se puede obtener los Datps CT: '.$category.' TP: '.$type.'  ERROR!!'.$cb->error. "<br>___ ".$cb->select2;
	}
	
}///FIN IF SOLO TRES PARAMETROS
else{
	echo 'ERROR No se puede obtener el Documento ▼<br/>';
}
?>
