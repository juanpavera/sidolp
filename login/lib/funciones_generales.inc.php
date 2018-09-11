<?php

/*
**********************************************************
Nombre de la función:	conectar_mysql ($servidor, $usuario, $contrasena, $base_datos)
Propósito:				Se utiliza esta función para conectar directamente
						a un servidor con un usuario.
Parámetros:				$texto	--> La variable a validar
Valores de Retorno:		-1	--> Si la variable contiene otros 
								caracteres que no sean letras
						0	--> Si el text es válido
Observación:			Esta función se debe utilizar en 
						todo el sistema para validar los 
						campos de entrada que sean solo texto.
Fecha de Creación:		07 - 04 - 05
Versión:				1.0.0
**********************************************************
*/
function conectar_mysql ()
{
	include ("configuracion.inc.php") ;
	
	//echo "<h1>$HOST, $USUARIO, $CONTRASENA, $BASE_DATOS</h1>" ;

	if ( ! ($id_conexion = mysql_connect($HOST, $USUARIO, $CONTRASENA)) ) 
	{
		return -1 ;
	}
	elseif ( ! mysql_select_db ($BASE_DATOS, $id_conexion) ) 
	{ 
		echo "|" . mysql_errno($id_conexion) . ": " . mysql_error($id_conexion). "|\n";
		return -1 ;
	}
	else
		return $id_conexion ;
}


/*
**********************************************************
Nombre de la función:	desconectar_mysql ($id_conexion)
Propósito:				Se utiliza esta función para desconectarse
						del de mysql.
Parámetros:				$texto	--> La variable a validar
Valores de Retorno:		-1	--> Si la variable contiene otros 
								caracteres que no sean letras
						0	--> Si el text es válido
Observación:			Esta función se debe utilizar en 
						todo el sistema para validar los 
						campos de entrada que sean solo texto.
Fecha de Creación:		07 - 04 - 05
Versión:				1.0.0
**********************************************************
*/
function desconectar_mysql ($id_conexion) 
{ 
	if ( ! @mysql_close($id_conexion) )
	{ 
		echo "Error en la conexion:" . mysql_errno() . " Error: " . mysql_error() ; 
		return -1 ; 
	}
	else
	{
		return $id_conexion ;
	}
}

//////////////////////////////////////////////////////////////////
//	Verifica el id_usuario y password, si son correctos crea las 
//	variables de sesion id_usuario, id_usuario
//////////////////////////////////////////////////////////////////
function registra_usuario ($id_conexion, $id_usuario, $contrasenia, $empresa){			
	$pass = md5($contrasenia);

	$sql = "SELECT 	us.id_usuario, 
					us.nombre,
					us.password,
					us.tipo,
					us.id_empresa,
					us.id_compania
			FROM usuarios as us, empresas as emp
			WHERE us.id_empresa=emp.id_empresa 
			and us.id_usuario='".$id_usuario."' AND us.password='".$pass."' 
			AND (us.id_empresa='".$empresa."' OR us.id_compania='".$empresa."')";

	$res_query = mysql_query ($sql, $id_conexion);
	//echo $sql;
 	$numero_usuarios = mysql_num_rows($res_query);
	if ( $numero_usuarios == 0 ) {
		return -1 ;
		return $sql ;
	} elseif ( $numero_usuarios > 1 ) {
		return -2 ;
	} elseif ( $numero_usuarios == 1 ) {
		$reg = mysql_fetch_array ($res_query) ;

		///////////////////////////////////////////
		// verifica si el usuario es correcto 
		///////////////////////////////////////////
		if ( ($reg['id_usuario'] != "") and ($reg['password'] != "") ) {	
			//Una ves verificado el USUARIO y el PASSWORD Obtenemos los datos de la INSTITUCION
			if ($reg['id_empresa']!='') {
				$institucion="empresa";
				$id=$reg['id_empresa'];
			}elseif($reg['id_compania']!=''){
				$institucion="compania";
				$id=$reg['id_compania'];
			}
			$sqli = "SELECT logo, icon_user
			FROM ".$institucion."s
			WHERE id_".$institucion."='".$id."' LIMIT 1";
			$res_queryi = mysql_query ($sqli, $id_conexion);
			$regi = mysql_fetch_array ($res_queryi);
			include('Mobile_Detect.php'); 
			$detect = new Mobile_Detect(); //redireccionar a versión móvil si nos visitan desde un móvil o tablet 
			if ($detect->isMobile() || $detect->isTablet()) { 
			   //SI SE ACCEDE DESDE UN DISPOSITIVO MOVIL
				$_SESSION['usuario_wsalud'] = $reg['id_usuario'];
				$_SESSION['nombre_usuario'] = $reg['nombre'];
				$_SESSION['id_empresa']     = $id;
				$_SESSION['logo']           = $regi['logo'];
				$_SESSION['icon_user']      = $regi['icon_user'];
				$_SESSION['visita']         = "movil";
				$_SESSION['tipo']           = $reg['tipo'];
				return 1 ;
			}else{
				$ip_visita                  = getRealIP();
				$_SESSION['usuario_wsalud'] = $reg['id_usuario'];
				$_SESSION['nombre_usuario'] = $reg['nombre'];
				$_SESSION['id_empresa']     = $id;
				$_SESSION['logo']           = $regi['logo'];
				$_SESSION['icon_user']      = $regi['icon_user'];
				//$_SESSION['icon_user']    = $sqli;
				$_SESSION['visita']         = $ip_visita;
				$_SESSION['tipo']           = $reg['tipo'];
				return 1 ;	
			}
		} else {
			return -3 ;
		}
	}
}

/*************************************************
FUNCIÓN PARA VERIFICAR LA CÉDULA Y EXTENSIÓN DE UN ASEGURADO REGISTRADO EN INCLUSIONES
**************************************************/
function registrar_inclusion($id_conexion,$ci,$ext,$empresa){
	$sqlInclusion="SELECT c.ci, c.extension, concat( nombres, ' ', paterno, ' ', materno ) AS cliente, emp.nombre, cdet.tipo, emp.id_empresa, 
	(CASE cdet.estado
	WHEN 'ENV'
	THEN 'Enviado'
	WHEN 'APR'
	THEN 'Aprobado'
	END) AS estado
	FROM clientes AS c
	INNER JOIN empresas AS emp ON c.id_empresa = emp.id_empresa
	INNER JOIN cotizacion_detalle AS cdet ON c.id_cliente = cdet.id_cliente
	WHERE c.ci =".$ci."
	AND c.extension = '".$ext."'
	AND estado IN ('ENV', 'APR')
	and emp.id_empresa=".$empresa;
	$query=mysql_query($sqlInclusion,$id_conexion); 
	$num_asegurados=mysql_num_rows($query);

	if($num_asegurados==1){
		$row=mysql_fetch_array($query);
		if($row['ci']!='' && $row['extension']!=''){
			require_once("Mobile_Detect.php");
			$detect=new Mobile_Detect();
			if($detect->isMobile() || $detect->isTablet()){
				$_SESSION['ci']=$row['ci'];
				$_SESSION['extension']=$row['extension'];
				$_SESSION['id_empresa']=$row['id_empresa'];
				$_SESSION['tipo']=$row['tipo'];
				return 1;
			}else{
				$ip_visita=getRealIP();
				$_SESSION['ci']=$row['ci'];
				$_SESSION['extension']=$row['extension'];
				$_SESSION['id_empresa']=$row['id_empresa'];
				$_SESSION['tipo']=$row['tipo'];
				return 1;
				
			}
		}else{
			return -1;
		}
		
		
	}else{
		return 0;
	}
}

/********************************************************/
//FUNCION QUE OBTIENE LA DIRECCION IP REAL DEL VISITANTE
/*******************************************************/

function getRealIP() {
    if (isset($_SERVER['HTTP_CLIENT_IP']))
    {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif (isset($_SERVER['HTTP_X_FORWARDED']))
    {
        return $_SERVER['HTTP_X_FORWARDED'];
    }
    elseif (isset($_SERVER['HTTP_FORWARDED_FOR']))
    {
        return $_SERVER['HTTP_FORWARDED_FOR'];
    }
    elseif (isset($_SERVER['HTTP_FORWARDED']))
    {
        return $_SERVER['HTTP_FORWARDED'];
    }
    else
    {
        return $_SERVER['REMOTE_ADDR'];
    }
}

 /*if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];*/
?>