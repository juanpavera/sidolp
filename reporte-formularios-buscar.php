<?php
require_once('funciones.class.php');

//include('config.php');
//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    $ok             = true;
    $link           = new Sidolp();
    $arrResponse    = array();
    $id_gestion     = '%%';
    $tipo_form      = '%%';

    if (isset($_POST['gestion']) && $_POST['gestion']!='')
        $id_gestion = $_POST['gestion'];
    if (isset($_POST['tipo_form']) && $_POST['tipo_form']!='')
        $tipo_form         = $_POST['tipo_form'];
    
    $link->sqlf = 'SELECT ge.gestion, fo.tipo, fo.cantidad_ant, fo.cantidad_new, fo.fecha_creacion, us.nombre, us.cargo
    FROM si_formulario AS fo
    INNER JOIN ad_gestion AS ge ON fo.ad_gestion_id = ge.id_gestion
    INNER JOIN ad_usuario AS us ON fo.ad_usuario_id = us.id_usuario
    WHERE fo.tipo LIKE "'.$tipo_form.'" AND 
    fo.ad_gestion_id LIKE "'.$id_gestion.'"
    ;';
    
    $arrResponse['error']   = 0;
    $arrResponse['detalle'] = '
    <div class="box box-info" style="background:#F9F9F9;" >
      <div class="box-header">
      </div>
      <div class="box-body">
        <div id="tb_afiliaciones" class="table-responsive no-padding">
          <table id="tb" class="table table-bordered table-striped">
            <thead class="bg bg-info">
              <th>GESTION</th>
              <th>TIPO FORMULARIO</th>
              <th>CANTIDAD INICIAL</th>
              <th>CANTIDAD FINAL</th>
              <th>FECHA DE IMPRESIÓN</th>
              <th>USUARIO</th>
              <th>CARGO</th>
            </thead>
            <tbody>';
        if (($rs = $link->query($link->sqlf)) !== false) {
            while($row = $rs->fetch_array(MYSQLI_ASSOC)){
                switch ($row['tipo']) {
                    case 'PS':
                      $det_tipo = '<span class="label  bg-gray">Formulario de Pase</span>';
                      break;
                    case 'FI':
                      $det_tipo = '<span class="label  bg-green">Formulario de Inscripción</span>';
                      break;
                    case 'NC':
                      $det_tipo = '<span class="label  bg-blue">Formulario de Nuevo Club</span>';
                      break;
                  }

                  $arrResponse['detalle'] .= '
                    <tr>
                        <td>'.$row['gestion'].'</td>
                        <td>'.$det_tipo.'</td>
                        <td>'.$row['cantidad_ant'].'</td>
                        <td>'.$row['cantidad_new'].'</td>
                        <td>'.$row['fecha_creacion'].'</td>
                        <td>'.$row['nombre'].'</td>
                        <td>'.$row['cargo'].'</td>
                    </tr>';
            }
        }
        $arrResponse['detalle'] .='</tbody>
        <tfood class="bg bg-info">
              <th>GESTION</th>
              <th>TIPO FORMULARIO</th>
              <th>CANTIDAD INICIAL</th>
              <th>CANTIDAD FINAL</th>
              <th>FECHA DE IMPRESIÓN</th>
              <th>USUARIO</th>
              <th>CARGO</th>
            </tfood>
          </table>
      </div>
    </div>  


    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        $("#tb").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": true,
          "oLanguage":{
            "sUrl":"plugins/datatables/datatables.spanish.txt"
          }
        });
      });
    </script>';
    sleep(0);//retrasamos la petición 3 segundos
    
    echo json_encode($arrResponse, true);


}else{
    throw new Exception("Error Processing Request", 1);   
}