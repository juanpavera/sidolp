<?php
$err_search = '';
?>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<style>
	.tags {
	  list-style: none;
	  margin: 0;
	  overflow: hidden; 
	  padding: 0;
	}

	.tags li {
	  float: left; 
	}

	.tag {
	  background: #F9FFB6;
	  border-radius: 3px 0 0 3px;
	  color: #7E5E5E;
	  display: inline-block;
	  height: 26px;
	  line-height: 26px;
	  padding: 0 20px 0 23px;
	  position: relative;
	  margin: 0 10px 10px 0;
	  text-decoration: none;
	  -webkit-transition: color 0.2s;
	}

	.tag::before {
	  background: #fff;
	  border-radius: 10px;
	  box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
	  content: '';
	  height: 6px;
	  left: 10px;
	  position: absolute;
	  width: 6px;
	  top: 10px;
	}

	.tag::after {
	  background: #fff;
	  border-bottom: 13px solid transparent;
	  border-left: 10px solid #F9FFB6;
	  border-top: 13px solid transparent;
	  content: '';
	  position: absolute;
	  right: 0;
	  top: 0;
	}

	.tag:hover {
	  background-color: #00A65A;
	  color: white;
	}

	.tag:hover::after {
	   border-left-color: #00A65A; 
	}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success" style="background:#F9F9F9;">
            <div class="box-header">
            	<i class="fa fa-edit"></i>
              	<h3 class="box-title"><?=$title?></h3>
            </div>
            <div class="box-body">
            	<form id="for-ge" name="for-ge" action="" method="post" class="form-doc">
	            	<div class="col-md-12">
	            		<div class="row">
	            		<div class="col-md-3 hidden-xs">&nbsp;</div>
		            	<div class="col-md-6 " id="buscador">
		            		<div class="box box-success">
		            			<div class="box-header">
					            	<i class="fa fa-sort-numeric-asc"></i>
					              	<h3 class="box-title">Número de Copias</h3>
					            </div>
					            <div class="box-body">
					            	<div class="col-md-8">
					            		<input type="hidden" name="usuario" id="usuario" value="<?=$_SESSION['id_usuario'];?>">
					            		<input type="hidden" name="tipo" id="tipo" value="<?=$short;?>">
					            		<input type="hidden" name="gestion" id="gestion" value="<?=$gestion;?>">
					            		<input type="text" class="form-control" name="cantidad" id="cantidad" value="" placeholder="Copias">
					            		<div style="font-size:8pt;">
								            Solo ingrese Números
								        </div>
					            	</div>
					            	<div class="col-md-4">

					            		<button class="btn btn-success" type="submit" id="gen-fo" name="gen-fo"><span class="fa fa-search"></span> Generar</button>
					            		<div class="mess-err-sc"><?=$err_search;?></div>
					            	</div>
					            </div>
				            </div>
		            	</div>
		            	</div>
	            	</div>
	            </form>

            	<div class="col-md-4 col-xs-12"><div class="messages"></div></div>
	            <div class="col-md-2" id="documento">
	        		<a class="fancybox fancybox.ajax btn btn-success" href="formulario-detalle-certificado.php?type=PRINT&cat=<?=base64_encode($short)?>)?>&ges=<?=base64_encode($gestion)?>)?>" style="width:100%; text-align:center;"> Ver Documento &nbsp;<span class="fa fa-files-o"></span></a>
				</div>
				<div class="col-md-2 hidden-xs">
					<button class="btn btn-info" type="submit" id="clean-fo" name="clean-fo"><span class="fa fa-recycle"></span> Limpiar</button>
				</div>
				<div class="col-md-4 hidden-xs">&nbsp;</div>

			</div>
        </div>
    </div>
</div>
<script type="text/javascript">	
	$(document).ready(function(e) {
		$('#documento').hide();
        $('#clean-fo').hide();
        //Boton Guardar
		$("#gen-fo").click(function(e) {

			e.preventDefault();
			
			var error     = false;
	        var num       = /^[0-9]*$/;
	        
	        if ($('#cantidad').val()==''){
		            $('#cantidad').addClass('input-error');
		            $('#cantidad').focus();
		            error=true;
		        }else{
				if ( !num.test($('#cantidad').val()) ) {
	                $('#cantidad').addClass('input-error');
	                $('#cantidad').focus();
	                error=true;
	            }else{
	            	$('#cantidad').removeClass('input-error');
	            }
	        }

	        if (error==false) {
				
				var formData = new FormData($(".form-doc")[0]);		
				//alert(formData);	
				$.ajax({
					url: 'formulario-guardar.php',  
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
		                message = $("<span class='before' style='font-size:8pt;'><i class='fa fa-circle-o-notch fa-spin fa-2x fa-fw margin-bottom' style='color:#00A65A;'></i> Procesando Información</span>");
		                showMessage(message) ;
		                $('#gen-fo').hide();
		            },
		            //una vez finalizado correctamente
		            success: function(result){
		                if (result['error']==0) {
		                	//var myarr = result['detalle'].split("|");
							message = $("<span class='before text-success' style='font-size:8pt; color:#36AC03;'><i class='fa fa-check fa-2x text-success'></i> Datos Guardados Correctamente </span>");
		                	showMessage(message) ;
		                	
		                	$('#documento').show();
							$('#clean-fo').show();
		                }else{
		                	message = $("<span class='before' style='font-size:8pt;'><span class='fa-stack fa-lg'><i class='fa fa-user fa-stack-1x'></i><i class='fa fa-ban fa-stack-2x text-danger'></i></span> <span class='text-danger'>"+result['detalle']+"</span></span>");
		                	showMessage(message) ;
		                	$('#gen-fo').show();
		                }
		            },
		            //si ha ocurrido un error
		            error: function(){
		                message = $("<span class='before' style='font-size:8pt;'><span class='fa-stack fa-lg'><i class='fa fa-database fa-stack-1x'></i><i class='fa fa-ban fa-stack-2x text-danger'></i></span> <span class='text-danger'> Error General</span></span>");
		            	showMessage(message) ;
		            	$('#gen-fo').show();
		            }
		        });
		        /*$('#documento').show();
				$('#clean-fo').show();*/
			}
			
		});

		//Boton Borrar
		$("#clean-fo").click(function(e) {
			$("#cantidad").val("");
			$("#gen-fo").show();
			$("#documento").hide();
			$("#clean-fo").hide();
			$(".messages").html("");
		});
		
	});
	function showMessage(message){
	    $(".messages").html("").show();
	    $(".messages").html(message);
	}
	
</script>
<!--<script src="js/ajaxupload.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>-->