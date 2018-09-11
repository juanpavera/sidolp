<?php
require_once('funciones.class.php');
require_once('header.php');
$sidolp = new Sidolp();
session_start();
$user = '';
if (isset($_SESSION['usuario'])) {
  $user = $_SESSION['usuario'];
}

if (isset($_GET['pg'])) {
  $pg = $_GET['pg'];
}else{
  $pg = md5('NADA');
}

if (($rsGE = $sidolp->gestion_act('act')) !== false) {
  $rowGE = $rsGE->fetch_array(MYSQLI_ASSOC);
  $gestion = $rowGE['id_gestion'];
}
?>
<!DOCTYPE html>
<html lang="es">
  <?=cabecera();?>
  <body class="sidebar-mini skin-blue-light">
    <div class="wrapper">

      <?=$sidolp->content_menu();?>
      <!-- Left side column. contains the logo and sidebar -->
      <?=$sidolp->menu($user);?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            AODLP
            <small>Asociación Obrera Deportiva La Paz</small>
          </h1>
          <ol class="breadcrumb">
            <li class="fa fa-globe"></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php
          if (!isset($_SESSION['usuario'])) {
            //require('login/login.php');
          }else{

          }
          switch ($pg) {
            case md5('INI'):
              if ($_SESSION['tipo']=='REPAG' || $_SESSION['tipo']=='REPNA') {
                require('inicio.php');
              }else{
                $title = 'Panel de Casos Pendientes';
                require('panel_pendientes.php');
              }
              
              break;
            case md5('US_UP'):  //User Update
              $title = 'Datos Usuario';
              echo '<meta http-equiv="refresh" content="0;url=usuario-formulario.php">';
              break;            
            case md5('FO_PS'):
              $title = 'Pases';
              $short = 'PS';
              require('formulario-aodlp.php');
              break;
            case md5('FO_FI'):
              $title = 'Formularios de Inscripción';
              $short = 'FI';
              require('formulario-aodlp.php');
              break;
            case md5('FO_NC'):
              $title = 'Formulario de Nuevo Club';
              $short = 'NC';
              require('formulario-aodlp.php');
              break;
            case md5('DC_CA'):
              $title = 'Carta';
              $short = 'CA';
              require('documento-aodlp.php');
              break;
            case md5('DC_IN'):
              $title = 'Informe';
              $short = 'IN';
              require('documento-aodlp.php');
              break;
            case md5('DC_PR'):
              $title = 'Impresion de Documento';
              require('documento-print.php');
              break;
            case md5('RP_FO'):
              $title = 'Reporte de Formularios';
              require('reporte-formularios.php');
              break;
            case md5('RP_DO'):
              $title = 'Reporte de Documentos';
              require('reporte-documentos.php');
              break;            
            case md5('RP_AF'):
              $title = 'Reporte de Afiliación Equipos';
              require('reporte-af-equipos.php');
              break;
            case md5('AD_US'):
              $title = 'Administración de Usuarios';
              require('admin-usuarios.php');
              break;            
            case md5('AD_AF'):
              $title = 'Administración de Afiliación';
              require('admin-afiliacion.php');
              break;
            default:
              require('inicio.php');
              break;
          }
          ?>

          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2017 <a href="http://www.asociacion-obrera.org" target="_black">AODLP</a></strong> Derechos Reservados.
      </footer>

    </div><!-- ./wrapper -->

    <?=pie();?>
  </body>
</html>
