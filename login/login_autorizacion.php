<!DOCTYPE html>
<?php
include('../config.php');?>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Acceso Autorizaciones Web Salud</title>
    
    
    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/style.css">
    <link href="../css/font-awesome.css" rel="stylesheet"/>
    <link href="../css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Select2 -->
    <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body link="#fffff" vlink="#ffffff" alink="#ffffff">
    <!--Compañias-->
<!--<div class="" align="center" style="color:gray; float: right; background:white; ">-->
  <?php
  $selectp="SELECT logo FROM companias WHERE activo='1'";

  $consultap=mysql_query($selectp,$conexion);
  $i=0;
  while($datos = mysql_fetch_array($consultap)){
    $i++;
    //echo'<img src="../images/logos/'.$datos['logo'].'" width="40%" alt="" id="img-'.$i.'" ><br>';
    //echo'<div style="width:300px;height:225px;filter:alpha(opacity=25);-moz-opacity:.25;opacity:.25;background:url ../images/logos/'.$datos['logo'].'"></div>';

  }
  ?>
  <style type="text/css">
  select:required{
	  border:1px solid #F00;
	  }
  </style>
<!--</div>-->
<!-- Form Mixin-->

<!-- Pen Title-->
<div class="pen-title">
  <h1><a style="font-size:12pt;">Web</a>SALUD</h1><span> <i class='fa fa-paint-brush'></i> + <i class='fa fa-code'></i> by <a href='#'>Coboser</a></span>
</div>


<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-wrench"></i>
    <div class="tooltip">Ayuda</div>
  </div>
  <div class="form">
    <h2 align="center">Acceder a autorizaciones</h2>
    <!--<form action="lib/control_acceso.php" method="POST">-->
      <form action="lib/control_acceso_autorizacion.php" method="POST">
      <div id="login_usuario">
        <div align="center">
          <img src="../images/icono-salud.png" height="118" width="140" alt="">
        </div>
        <input type="text" name="ci" placeholder="Documento de Identidad" id="ci" required maxlength="8" autofocus class="form-control"/>
       <select name="ext" id="ext" required style="width:240px; height:40px;" class="form-control select2">
         <option value="">Extensión
         <option value="LP">La Paz
         <option value="CB">Cochabamba
         <option value="SC">Santa Cruz
         <option value="CH">Chuquisaca
         <option value="BE">Beni
         <option value="OR">Oruro
         <option value="PN">Pando
         <option value="TJ">Tarija
         <option value="PT">Potosí
         <option value="PE">Persona Extranjera
       </select><br><br>
        <?php
        //$selectp="SELECT id_empresa, nombre, descripcion
        //FROM empresas WHERE activo='1'";
        $selectp="SELECT em.id_empresa as id, em.nombre, em.activo=0 as tipo
        FROM empresas as em
        INNER JOIN cuentas as cu on cu.id_empresa = em.id_empresa
        WHERE activo='1' and em.id_empresa!=0
        UNION
        SELECT id_compania as id, nombre, activo=1 as tipo
        FROM companias
        WHERE activo='1'
        ORDER BY tipo, nombre";
      
        $consultap=mysql_query($selectp,$conexion);
      
        echo'<select name="id" id="id" style="width:240px; height:40px;" class="form-control select2">
            <option value="0">Seleccione su Empresa</option>';
         while($resultadop = mysql_fetch_array($consultap)){
             echo'<option value='.$resultadop['id'].'>'.utf8_encode($resultadop['nombre']).'</option>';  
         }
        echo'</select>
        <br><br>';
        if (isset($_GET['error'])) {
          echo'<div style="color: #D8000C;
       background-color: #FFBABA; text-align:center;">Usted no puede solicitar autorizaciones</div>';
        }
        ?>
        <br>
        <div>
          <button name="ingresar" type="submit" id="ingresar">Ingresar</button>
        </div>  
      </div>
      
    </form>
  </div>
  <div class="form">
    <h2>Asistencia en Linea</h2>
    <form> 
      <img src="../images/Logo-coboser.png" alt="" width="100%">
      <!--Tel&eacute;fonos de contacto:-->
      <br><br>
      <input type="tel" placeholder="Phone Number" readonly value="2433500 (116) - 2971790" style="text-align:center;"/>
      

          <button class=""> 
            <a href="../admin/index.php"> <i class="fa fa-cogs"></i> Administrar</a>
          </button>
        
      
      
    </form>
  </div>
  <div class="cta"><a href="../../index.php"><i class="fa fa-globe fa-2x"></i></a></div>
</div>
<br>
<!--Compañias-->
<div class="" align="center" style="color:gray;background:white; width:100%;">
  <div align="right">
    Compa&ntilde;ias que Trabajan con Nosotros<br>
    <?php
    $selectp="SELECT logo FROM companias WHERE activo='1' ORDER BY nombre desc";
    $consultap=mysql_query($selectp,$conexion);
    $i=0;
    while($datos = mysql_fetch_array($consultap)){
      $i++;
      echo'&nbsp;&nbsp;<img src="../images/logos/'.$datos['logo'].'" width="6%" alt="" id="img-'.$i.'" >&nbsp;&nbsp;';
    }
    ?>  
  </div>
  
</div>
<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<script src='../js/jquery-2.1.4.min.js'></script>

<script src="js/index.js"></script>
<script type="text/javascript" src="../js/grayscale.js"></script>
<script type="text/javascript">
$(function() {
  
  for (var i = 1; i <= <?=$i?>; i++) {
    var im = document.getElementById('img-'+i);
    grayscale(im);   
  };
});
</script>
<!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>


    <script type="text/javascript">
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        
      });
    </script>
  </body>

</html>