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
    $tipo_doc      = '%%';
    $fecha_ini      = '2015-05-18';
    $fecha_fin      = '2030-05-18';


    if (isset($_POST['gestion']) && $_POST['gestion']!='')
        $id_gestion = $_POST['gestion'];
    if (isset($_POST['tipo_doc']) && $_POST['tipo_doc']!='')
        $tipo_doc         = $_POST['tipo_doc'];
    if (isset($_POST['fecha_ini']) && $_POST['fecha_ini']!='')
        $fecha_ini = $_POST['fecha_ini'];
    if (isset($_POST['fecha_fin']) && $_POST['fecha_fin']!='')
        $fecha_fin = $_POST['fecha_fin'];
    
    $link->sqlf = 'SELECT ge.gestion, do.id_documento, do.tipo, do.correlativo, do.dirigido, do.referencia, do.fecha_creacion, us.nombre, us.cargo
      FROM si_documento AS do
      INNER JOIN ad_gestion AS ge ON do.ad_gestion_id = ge.id_gestion
      INNER JOIN ad_usuario AS us ON do.ad_usuario_id = us.id_usuario
      WHERE do.tipo LIKE "'.$tipo_doc.'" AND 
      do.ad_gestion_id LIKE "'.$id_gestion.'" AND
      do.fecha_creacion BETWEEN "'.$fecha_ini.'" AND "'.$fecha_fin.'";
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
              <th>TIPO DOCUMENTO</th>
              <th>NOMBRE DEL DOCUMENTO</th>
              <th>DIRIGIDO</th>
              <th>REFERENCIA</th>
              <th>FECHA DE IMPRESIÓN</th>
              <th>USUARIO</th>
              <th>CARGO</th>
            </thead>
            <tbody>';
        if (($rs = $link->query($link->sqlf)) !== false) {
            while($row = $rs->fetch_array(MYSQLI_ASSOC)){
                switch ($row['tipo']) {
                    case 'CA':
                      $det_tipo = '<span class="label  bg-gray">Carta</span>';
                      $det_nombre = 'Carta '.$row['correlativo'].' / '.$row['gestion'];
                      break;
                    case 'IN':
                      $det_tipo = '<span class="label  bg-green">Informe</span>';
                      $det_nombre = 'Informe '.$row['correlativo'].' /' .$row['gestion'];
                      break;
                  }

                  $dirigido = explode('|', $row['dirigido']);

                  $arrResponse['detalle'] .= '
                    <tr>
                        <td>'.$row['gestion'].'</td>
                        <td>'.$det_tipo.'</td>
                        <td>'.$det_nombre.'</td>
                        <td>'.$dirigido[0].'</td>
                        <td>'.$row['referencia'].'</td>
                        <td>'.$row['fecha_creacion'].'</td>
                        <td>'.$row['nombre'].'</td>
                        <td>'.$row['cargo'].'</td>
                    </tr>';
            }
        }
        $arrResponse['detalle'] .='</tbody>
        <tfood class="bg bg-info">
              <th>GESTION</th>
              <th>TIPO DOCUMENTO</th>
              <th>NOMBRE DEL DOCUMENTO</th>
              <th>DIRIGIDO</th>
              <th>REFERENCIA</th>
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