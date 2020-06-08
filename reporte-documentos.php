<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Main content -->
<section class="content">
  <div class="box box-primary" style="background:#F9F9F9;">
    <div class="box-header">
      <i class="fa fa-address-book-o"></i>
        <h2 class="box-title"><?=$title?></h2>
    </div>
    <form id="f-sin" name="f-sin" action="" method="post" class="formulario">
    <div class="box-body">
      <div class="col-md-2">Gestion</div>
      <div class="col-md-4">
        <div class="input-group">
            <select name="gestion" id="gestion" class="form-control">
              <option value="">TODOS</option>
              <?php
              if (($rsGE = $sidolp->gestion_act('all')) !== false) {
                while ($rowGE = $rsGE->fetch_array(MYSQLI_ASSOC)) {
                  ?>
                  <option value="<?=$rowGE['id_gestion'];?>"><?=$rowGE['gestion'];?></option>
                  <?php
                }
              }
              ?>
            </select>
            <span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
        </div>
      </div>
      <div class="col-md-2">Tipo Documento</div>
      <div class="col-md-4">    
        <select id="tipo_doc" name="tipo_doc" class="form-control">
            <option value="">Seleccione...</option>
            <?php
            $arr_typeForm = $sidolp->typeForm;
            for($i = 3; $i < 5; $i++){
                $typeForm = explode('|',$arr_typeForm[$i]);                
                echo '<option value="'.$typeForm[0].'">'.$typeForm[1].'</option>';
            }
            ?>
        </select>
      </div>    

      <div class="col-md-12">&nbsp;</div>
      <div class="col-md-2">Rango de Fechas</div>
      <div class="col-md-6">
        <div class="col-md-6">
          <div class="input-group">
            <input type="text" class="form-control" name="fecha_ini" id="fecha_ini" readonly placeholder="Fecha Inicio">
            <span class="input-group-addon" id="fecha_ini_ico"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group">
            <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" readonly placeholder="Fecha Fin">
            <span class="input-group-addon" id="fecha_fin_ico"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="col-md-4">&nbsp;</div>

      <div class="col-md-12 pull-right" style="text-align:right;"><hr>
        <input type="hidden" name="buscar" id="buscar" value="ok">
        <button class="btn btn-primary" id="bt-search" name="bt-search"><span class="fa fa-search"></span> Buscar</button>
      </div>
    </div>
    </form>
  </div>
  <div class="messages">
    
  </div>
</section><!-- /.content -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!--script type="text/javascript" src="js/jquery.chained.min.js"></script-->
<script type="text/javascript">
  $(document).ready(function(e) {
    $("#bt-search").click(function(e) {
      e.preventDefault();
      var formData = new FormData($(".formulario")[0]);
      $.ajax({
        url: 'reporte-documentos-buscar.php',  
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
            message = $("<span class='before' style='font-size:8pt;'><i class='fa fa-circle-o-notch fa-spin fa-2x fa-fw margin-bottom' style='color:#00A65A;'></i> Buscando Información</span>");
            showMessage(message) ;
        },
        //una vez finalizado correctamente
        success: function(result){
            

            if (result['error']==0) {
              message = $(""+result['detalle']+"");
              showMessage(message) ;
              
            }else{
              message = $("<span class='before' style='font-size:8pt;'><span class='fa-stack fa-lg'><i class='fa fa-user fa-stack-1x'></i><i class='fa fa-ban fa-stack-2x text-danger'></i></span> <span class='text-danger'>"+result['detalle']+"</span></span>");
              showMessage(message) ;
            }
        },
        //si ha ocurrido un error
        error: function(){
            message = $("<span class='before' style='font-size:8pt;'><span class='fa-stack fa-lg'><i class='fa fa-database fa-stack-1x'></i><i class='fa fa-ban fa-stack-2x text-danger'></i></span> <span class='text-danger'> Error General</span></span>");
          showMessage(message) ;
        }
    });
    });
  });
  function showMessage(message){
      $(".messages").html("").show();
      $(".messages").html(message);
  }
</script>
<script src="js/moment.js"></script>
<!-- Pikaday -->
<script src="js/pikaday.js"></script>
<script>
  var startDate,
        endDate,
        nacDate,
        ingDate,
        adqDate,
    updateStartDate = function() {
            startPicker.setStartRange(startDate);
            endPicker.setStartRange(startDate);
            endPicker.setMinDate(startDate);
        },
    updateEndDate = function() {
        startPicker.setEndRange(endDate);
        startPicker.setMaxDate(endDate);
        endPicker.setEndRange(endDate);
    };
    var startPicker = new Pikaday(
    {
        field: document.getElementById('fecha_ini'),
        trigger: document.getElementById('fecha_ini_ico'),
        format: 'YYYY-MM-DD',
        minDate: new Date(2016, 04, 14),
        maxDate: new Date(2035,01,01),
        yearRange: [2016,2035],
        onSelect: function() {
            console.log(this.getMoment().format('Do MMMM YYYY'));
            startDate = this.getDate();
            updateStartDate();
        }
    });

    var endPicker = new Pikaday(
    {
        field: document.getElementById('fecha_fin'),
        trigger: document.getElementById('fecha_fin_ico'),
        format: 'YYYY-MM-DD',
        minDate: new Date(document.getElementById('fecha_ini').value),          
        maxDate: new Date(2035,01,01),
        yearRange: [2016,2035],
        onSelect: function() {
            console.log(this.getMoment().format('Do MMMM YYYY'));
            endDate = this.getDate();
            updateEndDate();
        }
    });
</script>