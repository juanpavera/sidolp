<?php
require_once('funciones.class.php');
//include('config.php');
//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    $ok           = true;
    $link         = new Crecer();
    $arrResponse  = array();
    $usuario      = strtoupper($_POST['usuario']);
    $nombre       = $_POST['nombre'];
    $email        = $_POST['email'];
    $id_agencia   = $_POST['id_agencia'];
    $id_cargo     = $_POST['id_cargo'];
    $pass1        = $_POST['pass1'];
    $pass2        = $_POST['pass2'];
    $cambio_psswd = $_POST['cambio_psswd'];

    $arrResponse['error']   = 1;
    $arrResponse['detalle'] = '';
    if ($cambio_psswd==0 && $pass1 == $pass2) {
        //============================================== UPDATE ==============================================//
        
        $sql_Cli = "UPDATE usuarios SET 
        nombre      = '".$nombre."', 
        password      = '".md5($pass1)."', 
        email        = '".$email."', 
        id_agencia   = '".$id_agencia."', 
        id_cargo     = '".$id_cargo."', 
        cambio_psswd = 1
        WHERE id_usuario = '".$usuario."';";
        
        if ($link->query($sql_Cli) === true) {
            $arrResponse['error']   = 0;
            $arrResponse['detalle'] = '';
        }else{
            $ok = false;
            $arrResponse['error']   = 1;
            $arrResponse['detalle'] = 'No se pudo actualizar los datos del Usuario '.$sql_Cli;
        }
    }else{
    }

    sleep(1);//retrasamos la petición 3 segundos
    
    echo json_encode($arrResponse, true);

}else{
    throw new Exception("Error Processing Request", 1);   
}