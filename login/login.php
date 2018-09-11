<head>
  <title>SIDOLP | AODLP</title>
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.4 -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome -->
  <link href="../css/font-awesome.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins-->
  <link rel="stylesheet" href="css/style.css">
</head>
<body link="#fffff" vlink="#ffffff" alink="#ffffff">

  <div class="pen-title">
    <h4><span style="font-size:32pt; font-weight:bold;">SIDOLP</span></h4><span>
    <i class='fa fa-paint-brush'></i> + <i class='fa fa-code'></i> by <a href='#'>AODLP</a></span><br>
  </div>
  <div class="module form-module pen-body">
    <div class="toggle"><i class="fa fa-user"></i>
    </div>
    <div class="form">
      <h2 align="center">Accede a tu cuenta</h2>
      <!--form action="" method="POST" class="formulario"-->
        <form class="contactform" action="acceso_login.php" method="POST">
        <div id="login_usuario">
          <div align="center">
            <span class="fa fa-id-badge fa-5x"></span><br><br>
          </div>
          <input type="text" name="user" id="user" placeholder="Usuario" required autofocus autocomplete="off"/>
          <input type="password" name="password" id="password" placeholder="Contrase&ntilde;a" required/>
          
          <?php if (isset($_GET['msg'])): ?>
            <div style="color: #D8000C; background-color: #FFF3F3; text-align:center; font-size:9pt;">
              <span class="fa fa-info-circle fa-2x"></span> Intente de Nuevo, 
              <?php if ($_GET['msg']==base64_encode('2')): ?>
                 Error en Conexion
              <?php else: ?>
                Error en Datos
              <?php endif ?>
            </div><br>
          <?php else: ?>
            <br>     
          <?php endif ?>

          <div>
            <button name="ingresar" type="submit" id="ingresar">Ingresar</button>
          </div>  
        </div>
        
      </form>
    </div>
    <div class="cta"><a href="http://www.asociacion-obrera.org" target="_black"> <i class="fa fa-globe fa-2x"></i> AODLP</a></div>
  </div>

  <!-- jQuery 2.1.4 -->
  <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../js/jquery-ui.min.js" type="text/javascript"></script>

  <!-- Bootstrap 3.3.2 JS -->
  <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</body>