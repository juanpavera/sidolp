<?php
ob_start(); 
//Lo primero es iniciar la sesión antes de enviar nada, pero
//estableciendo el modo con cookies por si estuviera desactivado
session_start();
include('funciones_generales.inc.php');
$id_conexion = conectar_mysql() ;

if(!isset ($_SESSION['usuario']) and  !isset ($_SESSION['password'])){
  //echo'ingresa 1';
  //echo "<h1>|".$_SESSION['usuario_prosalud']."|</h1>";
  
		if ( isset ($_POST['ingresar']) ) {
		
			$usuario=mysql_real_escape_string($_POST['usuario']);
	        $password=mysql_real_escape_string($_POST['password']);
	        $id_compania=mysql_real_escape_string($_POST['id']);
			$res_registrar = registra_usuario ($id_conexion, $usuario, $password, $id_compania);
			
			if ( $res_registrar == 1 ){
				//echo "ENTRO AQUI 1 exito";
				if (isset($_POST['type'])) {
					header("Location: ../../admin/index_admin.php");
					exit;
				}else{
					header("Location: ../../index.php");
					exit;
				}
				
			} elseif ( $res_registrar == -1 ){
				//echo "ENTRO AQUI -1 ERROR";
				session_unset();
				session_destroy();
				if (isset($_POST['type'])) {
					header("Location: ../../admin/login.php?error=".$res_registrar);
				}else{
					header("Location: ../login.php?error=".$res_registrar);
				}
				exit;
				//header("Location: ../login_attempt.php");
				//echo '<meta http-equiv="refresh" content="1; url=../login_attempt.php?error='.$res_registrar.'">' ;
			} elseif ( $res_registrar == -3 ){
				//echo "ENTRO AQUI -3 ERROR";
				session_unset();
				session_destroy();
				if (isset($_POST['type'])) {
					header("Location: ../../admin/login.php?error=".$res_registrar);
				}else{
					header("Location: ../login.php?error=".$res_registrar);
				}
				//exit;
				//header("Location: ../login_attempt.php");
				//echo '<meta http-equiv="refresh" content="1; url=../login_attempt.php?error='.$res_registrar.'">' ;
			} elseif ( $res_registrar == -2 ){
				//echo "ENTRO AQUI -2 ERROR";
				session_unset();
				session_destroy();
				if (isset($_POST['type'])) {
					header("Location: ../../admin/login.php?error=".$res_registrar);
				}else{
					header("Location: .../login.php?error=".$res_registrar);
				}
				exit;
				//header("Location: ../login_attempt.php");
				//echo '<meta http-equiv="refresh" content="1; url=../login_attempt.php?error='.$res_registrar.'">' ;
			}
		} else {
			//echo "total fracaso";
			header("Location: ../login.php");
		}
 } else {
	//echo "<h1>con sesion saliiiirrrrrr</h1>" ;
	if(isset($_GET['salir'])) {	
		session_unset();
		session_destroy();
		header("Location: ../login.php");
	} else {
		session_unset();
		session_destroy();
		header("Location: ../login.php");
	}
}
//desconectar_mysql($id_conexion) ;
ob_end_flush();
?>