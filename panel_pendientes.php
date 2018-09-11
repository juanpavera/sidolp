<?php
$dis_sin = 'none';
$dis_afi = 'none';
if (isset($_GET[md5('sin')])) {
  $dis_sin = '';
  $dis_afi = 'none';
}
if (isset($_GET[md5('afi')])) {
  $dis_afi = '';
  $dis_sin = 'none';
}
?>
<section class="content-header">
  <h1>
    Sistema Documental Obrero La Paz 
  </h1>
  <!--ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Mailbox</li>
  </ol-->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
    </div>      
    <div class="col-md-9">      
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
