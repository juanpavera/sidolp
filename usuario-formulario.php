<?php
session_start();
if (isset($_SESSION['usuario'])) {
  $id_usuario = $_SESSION['usuario'];
}else{
  header('index.php');
  exit;
}
require_once('funciones.class.php');
$link = new Crecer();
$link->sqlUs = "SELECT us.id_usuario, us.nombre, us.email, us.id_agencia, ag.agencia, ag.sucursal, us.id_cargo, car.cargo, us.tipo, us.cambio_psswd
FROM usuarios AS us
INNER JOIN agencias AS ag ON ag.id_agencia = us.id_agencia
INNER JOIN cargos_funcionarios AS car ON car.id_cargo = us.id_cargo
WHERE us.id_usuario LIKE '".$id_usuario."' LIMIT 1;";
if (($link->rss = $link->query($link->sqlUs, MYSQLI_STORE_RESULT))) {
  if ($link->rss->num_rows == 1) {
    $link->rowU = $link->rss->fetch_array(MYSQLI_ASSOC); 
  }
}
?>
<html lang="es">
<!-- Bootstrap 3.3.4 -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- FontAwesome -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- AdminLTE Skins. Choose a skin from the css/skins-->
<link rel="stylesheet" href="login/css/style.css">
<link rel="stylesheet" href="css/style.css">

<body link="#fffff" vlink="#ffffff" alink="#ffffff">

  <div class="pen-title">
    <h4><span style="font-size:32pt; font-weight:bold;">Crecer</span>IFD</h4><span>
    <i class='fa fa-paint-brush'></i> + <i class='fa fa-code'></i> by <a href='#'>Coboser</a></span><br>
  </div>
  <div class="module form-module pen-body">
    <div class="toggle"><i class="fa fa-user"></i>
    </div>
    <div class="form">
      <h2 align="center">Administra tu cuenta</h2>
      <!--form action="" method="POST" class="formulario"-->
      <form id="f-sin" name="f-sin" action="" method="post" class="formulario">
        <div id="login_usuario">
          <div class="input-group" style="display:none;">
            <input type="text" class="form-control" id="usuario" name="usuario" readonly placeholder="Perfil" value="<?=$link->rowU['id_usuario']?>" style="font-weight:bold;">
            <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
          </div>
          <div class="col-md-12">&nbsp;</div>
          <div class="input-group">
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?=$link->rowU['nombre']?>">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
          </div>
          <div class="col-md-12">&nbsp;</div>
          <div class="input-group">
            <input type="text" class="form-control" name="email" id="email" placeholder="Correo Institucional" value="<?=$link->rowU['email']?>">
            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
          </div>
          <div class="col-md-12">&nbsp;</div>
          <div class="input-group">
            <select name="id_agencia" id="id_agencia" class="form-control">
              <option value="">Seleccione Agencia</option>
              <?php
              $rsAg = null;
              if (($rsAg = $link->agencias()) === false) {
                  $rsAg = null;
              }
              $aSucursales = array();
              if ($rsAg->data_seek(0) === true) {
                while($rowAg = $rsAg->fetch_array(MYSQLI_ASSOC)){ 
                  $aSucursales[$rowAg['id_agencia']]=$rowAg['sucursal']; ?>
                  <option value="<?=$rowAg['id_agencia']?>" <?php if ($link->rowU['id_agencia']==$rowAg['id_agencia']): ?> selected <?php endif ?>><?=$rowAg['agencia']?></option>
                  <?php
                }
              } ?>
            </select>
            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
          </div>
          <!--div class="col-md-12">&nbsp;</div>
          <div class="input-group">
            <input type="text" class="form-control" id="sucursal" readonly placeholder="Sucursal">
            <span class="input-group-addon"><i class="fa fa-map-o"></i></span>
          </div-->
          <div class="col-md-12">&nbsp;</div>
          <div class="input-group">
            <select name="id_cargo" id="id_cargo" class="form-control">
              <option value="">Seleccione Cargo</option>
              <?php
              $rsCa = null;
              if (($rsCa = $link->cargos()) === false) {
                  $rsCa = null;
              }
              if ($rsCa->data_seek(0) === true) {
                while($rowCa = $rsCa->fetch_array(MYSQLI_ASSOC)){  ?>
                  <option value="<?=$rowCa['id_cargo']?>" <?php if ($link->rowU['id_cargo']==$rowCa['id_cargo']): ?> selected <?php endif ?>><?=$rowCa['cargo']?></option>
                  <?php
                }
              } ?>
            </select>
            <span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
          </div>
          <div class="col-md-12">&nbsp;</div>
          <div class="input-group" style="display:none;">
            <input type="text" class="form-control" id="perfil" readonly placeholder="Perfil" value="<?=$link->rowU['tipo']?>">
            <input type="hidden" name="cambio_psswd" id="cambio_psswd" value="<?=$link->rowU['cambio_psswd']?>">
            <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
          </div>
          <?php if ($link->rowU['cambio_psswd']==0): ?>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12" style="border: 2px solid #E0E0E0;">
              <div class="col-md-12">&nbsp;</div>
              <div class="col-md-12" style="text-align:center; color:#B8B8B8;">Defina Nueva Contrase&ntilde;a</div>
              <div class="col-md-12">&nbsp;</div>
              <div class="input-group">
                <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Nueva Contrase&ntilde;a" value="">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              </div>
              <div class="col-md-12">&nbsp;</div>
              <div class="input-group">
                <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Repita Contrase&ntilde;a" value="">
                <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
              </div>
              <div class="mensaje" style="font-size:7pt;"></div>
              <br> 
            </div>
          <?php else: ?>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">
              <a href="index.php" class="form-control btn btn-default"><span class="fa fa-chevron-circle-left"></span> Volver</a>
            </div>  
          <?php endif ?>
          <div class="col-md-12">&nbsp;</div>
          <div>
            <button name="ingresar" type="submit" id="bt-next">Guardar</button>
          </div>  
          <div class="messages"></div>
        </div>
        
      </form>
    </div>
    <div class="cta"><a href="http://www.coboser.com" target="_black"> <i class="fa fa-globe fa-2x"></i> Coboser</a></div>
  </div>

  <!-- jQuery 2.1.4 -->
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="js/jquery-ui.min.js" type="text/javascript"></script>

  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!--script type="text/javascript">
    var asc = '';
    <?php
    foreach ($aSucursales as $key => $value) { ?>
      asc[<?=$key?>] = <?='"'.$value.'"'?>;
        <?php
    }
    ?>
    $('#id_agencia').change(function(){
      var id = $('#id_agencia').val();
      alert(asc[id]);
      //$("#moneda-bc option[value='Bs']").attr("selected",true);
      $("#sucursal").val(asc[id]);
    });
  </script-->

  <script type="text/javascript">
    $(document).ready(function(e) {
      $("#bt-next").click(function(e) {
        e.preventDefault();
        var error     =false;
        var num       = /^[0-9]*$/;
        //var tex       = /^[A-Za-z- -á-Á-é-É-í-Í-ó-Ó-ú-Ú-ñ-Ñ]*$/;
        var tex       = /^[A-Za-z- ]*$/;
        var mai       = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var alfanum   = /^[0-9-A-Za-z]*$/;
        var alfanumsg = /^[0-9A-Za-z]*$/;
        var numdec    = /^[0-9.]*$/;
        var numesp    = /^[0-9 ]*$/;
        if ($('#nombre').val()==''){
          $('#nombre').addClass('input-error');
          $('#nombre').focus();
          error=true;
        }else{
          $('#nombre').removeClass('input-error');
        }
        if ($('#email').val()==''){
          $('#email').addClass('input-error');
          $('#email').focus();
          error=true;
        }else{
          if ( !mai.test($('#email').val()) ) {
            $('#email').addClass('input-error');
            $('#email').focus();
            error=true;
          }else{
            var mail_completo = $('#email').val();
            var correo = mail_completo.split('@');
            if (correo[1].indexOf('crecer') != -1) {
              $('#email').removeClass('input-error');
            }else{
              $('#email').addClass('input-error');
              $('#email').focus();
              error=true;
            }
          }
        }
        if ($('#id_agencia').val()==''){
          $('#id_agencia').addClass('input-error');
          $('#id_agencia').focus();
          error=true;
        }else{
          $('#id_agencia').removeClass('input-error');
        }
        if ($('#id_cargo').val()==''){
          $('#id_cargo').addClass('input-error');
          $('#id_cargo').focus();
          error=true;
        }else{
          $('#id_cargo').removeClass('input-error');
        }
        var p1 = $('#pass1').val();
        var p2 = $('#pass2').val();
        if (p1 != p2){
          $('#pass1').addClass('input-error');
          $('#pass2').addClass('input-error');
          $('.mensaje').html('Las contrase&ntilde;as no coinciden');
          error=true;
        }else{
          if ($('#pass1').val()=='' || $('#pass1').val().length < 6){
            $('#pass1').addClass('input-error');
            $('#pass1').focus();
            $('.mensaje').html('La contrase&ntilde;a debe tener como minimo 6 caracteres.');
            error=true;
          }else{
            $('#pass1').removeClass('input-error');
          }
          if ($('#pass2').val()=='' || $('#pass2').val().length < 6){
            $('#pass2').addClass('input-error');
            $('#pass2').focus();
            $('.mensaje').html('La contrase&ntilde;a debe tener como minimo 6 caracteres');
            error=true;
          }else{
            $('#pass2').removeClass('input-error');  
          }
        }
        if (error==false) {
          var formData = new FormData($(".formulario")[0]);
          $.ajax({
              url: 'usuario-guardar.php',  
              type: 'POST',
              // Form data
              //datos del formulario
              data: formData,
              dataType:'json',
              //necesario para subir archivos via ajax
              cache: false,
              contentType: false,
              processData: false,
              //mientras enviamos el archivo
              beforeSend: function(){
                  message = $("<span class='before' style='font-size:8pt;'><i class='fa fa-circle-o-notch fa-spin fa-2x fa-fw margin-bottom' style='color:#00A65A;'></i> Procesando Informaci&oacute;n</span>");
                  showMessage(message) ;
              },
              //una vez finalizado correctamente
              success: function(result){
                  if (result['error']==0) {
                    var myarr = result['detalle'].split("|");
                    message = $("<span class='before text-success' style='font-size:8pt; color:#36AC03;'><i class='fa fa-check fa-2x text-success'></i> Datos Guardados Correctamente </span>");
                    showMessage(message) ;
                    //alert('index.php?pg=<?=md5("AF_F")?>&ref='+myarr[1]);
                    $(location).attr('href','index.php?pg=<?=md5("INI")?>');
                  }else{
                    message = $("<span class='before' style='font-size:8pt;'><span class='fa-stack fa-lg'><i class='fa fa-user fa-stack-1x'></i><i class='fa fa-ban fa-stack-2x text-danger'></i></span> <span class='text-danger'>"+result['detalle']+"</span></span>");
                    showMessage(message) ;
                  }
              },
              //si ha ocurrido un error
              error: function(){
                  message = $("<span class='before' style='font-size:8pt;'><span class='fa-stack fa-lg'><i class='fa fa-database fa-stack-1x'></i><i class='fa fa-ban fa-stack-2x text-danger'></i></span> <span class='text-danger'> Error General</span></span>");
                showMessage(message);
              }
          });
        }else{
          //alert('Error??!');
        }
      });
    });
    function showMessage(message){
        $(".messages").html("").show();
        $(".messages").html(message);
    }
    function showMessage2(message){
        $(".messages2").html("").show();
        $(".messages2").html(message);
    }
  </script>
</body>
</html>