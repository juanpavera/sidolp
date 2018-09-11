<?php
function cabecera(){ ?>
	<head>
	    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">  
	    <title>SIDOLP | AODLP</title>
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
      <style>
        /*@font-face {
          
          src: url(fonts/Source Sans Pro/SourceSansPro-Black.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-BlackItalic.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-Bold.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-BoldItalic.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-ExtraLight.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-ExtraLightItalic.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-Italic.ttf);

          src: url(fonts/Source Sans Pro/SourceSansPro-Light.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-LightItalic.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-Regular.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-Semibold.ttf);
          src: url(fonts/Source Sans Pro/SourceSansPro-SemiboldItalic.ttf);
        }*/
      </style>
	    <!-- Tell the browser to be responsive to screen width -->
	    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <!-- Bootstrap 3.3.4 -->
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	    <!-- FontAwesome -->
	    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
	    <!-- Theme style -->
	    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	    <!-- AdminLTE Skins. Choose a skin from the css/skins
	         folder instead of downloading all of them to reduce the load. -->
	    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	    <!-- iCheck for checkboxes and radio inputs -->
		  <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
	    <!-- Morris chart -->
	    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
	    <!-- jvectormap -->
	    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
	    <!-- Date Picker -->
	    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
	    <!-- Daterange picker -->
	    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
	    <!-- bootstrap wysihtml5 - text editor -->
	    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
		<!-- Fancy Box -->
		<link href ="plugins/fancybox/source/jquery.fancybox.css?v=2.1.5" rel = "stylesheet" type = "text/css"  media = "screen"  /> 
		<!-- SweetAlert -->
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
		<!-- mystyle -->
		<link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Data Tables-->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!--Calendario-->
    <link rel="stylesheet" href="css/pikaday.css">
    <!-- Slick Slides -->
    <link rel="stylesheet" type="text/css" href="css/slicknav.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
  	</head>
	<?php
}

function pie(){
	?>
	<!-- jQuery 2.1.4 -->
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="js/jquery-ui.min.js" type="text/javascript"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script type="text/javascript">
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- daterangepicker -->
  <script src="js/moment.js" type="text/javascript"></script>
  <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
  <!-- datepicker -->
  <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
  <!-- Slimscroll -->
  <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js" type="text/javascript"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js" type="text/javascript"></script>
  <!-- My Scrtip -->
  <script src="js/ajaxupload.js" type="text/javascript"></script>
  <script src="js/script.js" type="text/javascript"></script>
	<script src="js/sweetalert.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="plugins/iCheck/icheck.js" type="text/javascript"></script>
  <!-- FancyBox -->
	<script src = "plugins/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"   type = "text/javascript"></script>
  <script src = "plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"   type = "text/javascript"  ></script>
  
  <!-- DATA TABES SCRIPT -->
  <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
  
  <script src="js/moment.js"></script>
  <!-- Pikaday -->
  <script src="js/pikaday.js"></script>

  <!-- Chained -->
  <script type="text/javascript" src="js/jquery.chained.min.js"></script>
  
  <!-- Slick Slides -->
  <script type="text/javascript" src="js/slick.min.js"></script>

  

  <script type="text/javascript">
    	$(document).ready(function() {
      	$(".fancybox").fancybox();
        $('.slideini').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
        });
    	});
	</script>
  

	<script type="text/javascript">
		$(function () {
      $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
        //checkboxClass: 'icheckbox_polaris',
        //radioClass: 'iradio_polaris'
      });
      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
        //checkboxClass: 'icheckbox_polaris',
        //radioClass: 'iradio_polaris'
      });
      $('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
  	});
 	</script>
  
	<?php
}
?>