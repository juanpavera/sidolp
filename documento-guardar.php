<?php
require_once('funciones.class.php');
//include('config.php');
//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    $ok            = true;
    $link          = new Sidolp();
    $usuario       = $_POST['usuario'];
    $nombre        = $_POST['nombre'];
    $cargo         = $_POST['cargo'];
    $institucion   = $_POST['institucion'];
    $referencia    = $_POST['referencia'];
    $tipo          = $_POST['tipo'];
    $gestion       = $_POST['gestion'];
    $id            = uniqid();
    $arrResponse   = array();

    $sql = "SELECT MAX(correlativo) AS actual 
            FROM si_documento AS t0 
            INNER JOIN ad_gestion AS t1 ON t0.ad_gestion_id = t1.id_gestion 
            WHERE t0.tipo = '".$tipo."' AND t1.activo = 1;";

    if (($link->rss = $link->query($sql, MYSQLI_STORE_RESULT))) {   
        $link->rowA = $link->rss->fetch_array(MYSQLI_ASSOC); 

        if ($link->rowA['actual'] != '') {           

            $correlativo = $link->rowA['actual'] + 1;
        }else{
            $correlativo = 1;
        } 


        $dirigido = ucwords(strtolower($nombre)).'|'.ucwords(strtolower($cargo)).'|'.ucwords(strtolower($institucion));

        $referencia = ucfirst(strtolower($referencia));

        $sql_For = "INSERT INTO si_documento (id_documento, ad_usuario_id, ad_gestion_id, correlativo, dirigido, referencia, tipo, fecha_creacion) VALUES ('".$id."', '".$usuario."', ".$gestion.", ".$correlativo.", '".$dirigido."', '".$referencia."', '".$tipo."', curdate())";
        
        if ($link->query($sql_For) === true) {

            $arrResponse['error'] = '0';
            $arrResponse['detalle'] = '';
            $arrResponse['id'] = $id;

        }else{
            $ok = false;
            $arrResponse['error'] = '1';
            $arrResponse['detalle'] = 'No se pudo guardar los datos del Documento '.$sql_For;
        }
    }else{
        $ok = false;
        $arrResponse['error'] = '1';
        $arrResponse['detalle'] = 'No se pudo guardar los datos del Documento '.$sql_For;
    }

    sleep(1);//retrasamos la petición 3 segundos
    
    echo json_encode($arrResponse, true);

}else{
    throw new Exception("Error Processing Request", 1);   
}