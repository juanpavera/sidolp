<?php
require_once('funciones.class.php');
//include('config.php');
//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    $ok            = true;
    $link          = new Sidolp();
    $usuario       = $_POST['usuario'];
    $cantidad      = $_POST['cantidad'];
    $tipo          = $_POST['tipo'];
    $gestion       = $_POST['gestion'];
    $id            = uniqid();
    $arrResponse   = array();

    $sql = "SELECT MAX(cantidad_new) AS actual 
            FROM si_formulario AS t0 
            INNER JOIN ad_gestion AS t1 ON t0.ad_gestion_id = t1.id_gestion 
            WHERE t0.tipo = '".$tipo."' AND t1.activo = 1;";

    if (($link->rss = $link->query($sql, MYSQLI_STORE_RESULT))) {   
        $link->rowA = $link->rss->fetch_array(MYSQLI_ASSOC); 

        if ($link->rowA['actual'] != '') {           

            $cantidad_act = $link->rowA['actual'] + 1;
            $cantidad_new = $link->rowA['actual'] + $cantidad;
        }else{
            $cantidad_act = 1;
            $cantidad_new = $cantidad;
        } 

        

        $sql_For = "INSERT INTO si_formulario (id_formulario, ad_usuario_id, ad_gestion_id,cantidad_ant, cantidad_new, tipo, fecha_creacion) VALUES ('".$id."', '".$usuario."', ".$gestion.", ".$cantidad_act.", ".$cantidad_new.", '".$tipo."', curdate())";
        
        if ($link->query($sql_For) === true) {

            $arrResponse['error'] = '0';
            $arrResponse['detalle'] = '';

        }else{
            $ok = false;
            $arrResponse['error'] = '1';
            $arrResponse['detalle'] = 'No se pudo guardar los datos del Formulario '.$sql_For;
        }
    }else{
        $ok = false;
        $arrResponse['error'] = '1';
        $arrResponse['detalle'] = 'No se pudo guardar los datos del Formulario '.$sql_For;
    }

    sleep(1);//retrasamos la petición 3 segundos
    
    echo json_encode($arrResponse, true);

}else{
    throw new Exception("Error Processing Request", 1);   
}