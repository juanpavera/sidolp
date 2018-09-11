<?php
//require_once('funciones.class.php');
//Funcion que genera Condiciones Particulares
function formulario_inscripcion($type,$datos,$url,$conexion){
	
	ob_start(); 
	
	?>
	<style>
		/*@font-face {
			font-family: 'Roboto';
			src: url(fonts/Roboto/Roboto-Regular.ttf);
		}*/
		.cuerpo{
			font-size: 10pt;
			background: #FFFFFF;
			font-family: Arial;
			/*font-family: 'Roboto', 'sans-serif';
			src: url(fonts/Roboto/Roboto-Regular.ttf);*/
		}
		.firma{
			width: 120px;
			height: auto;
		}
		.to_right{
			text-align: right;
		}
		.to_center{
			text-align: center;
		}
	</style>
	<?php
	$print = $datos['cantidad_ant'];
	while($print <= $datos['cantidad_new']){
		?>
		<page class="cuerpo" style="width:100%;">			
			<table class="cuerpo" style="width:100%; border: 3px solid #000; border-radius: 15px;">
				<tr>
					<td style="width: 100%;" colspan="3">&nbsp</td>
				</tr>	

				<tr>
					<td style="width: 2%;">&nbsp</td>

					<td style="width: 96%;">
		
				   		<table class="cuerpo" style="width:100%;">
				   			<tr>
				   				<td style="width: 20%; text-align: center;" rowspan="5">
				   					<img src="images/logo.png" style="width:100%;">
				   				</td>
				   				<td style=" text-align:center; font-weight:bold; font-size:17pt; width:80%;" colspan="2" >
				   					ASOCIACIÓN OBRERA DEPORTIVA DE LA PAZ
				   				</td>
				   			</tr>   			
				   			<tr>
				   				<td style=" text-align:center; font-weight:bold; font-size:16pt;" colspan="2">
				   					FORMULARIO DE INSCRIPCIÓN
				   				</td>
				   			</tr>
				   			<tr>
				   				<td style=" width: 65%;"> &nbsp; </td>
				   				<td style=" width: 35%; text-align:right; font-weight:bold; font-size:14pt; border: 2px solid #000000;" >
				   					20 BS
				   				</td>
				   			</tr>

				   			<tr><td style="width: 100%;" colspan="3">&nbsp;</td></tr>
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%; font-weight: bold;">
				   			<tr><td colspan="2">&nbsp;</td></tr>
				   			
				   			<tr>
				   				<td style="width:35%;"><label><b>El Club:</b></label></td>
				   				<td style="width:65%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>
				 
				   			<tr>
				   				<td style="width:35%;"><label><b>Se inscribe en la Disciplina de:</b></label></td>
				   				<td style="width:65%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>

				   			<tr>
				   				<td style="width:35%;"><label><b>Categoria:</b></label></td>
				   				<td style="width:65%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width:35%;"><label><b>Habiendo Depositado la suma de:</b></label></td>
				   				<td style="width:65%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>				   			

				   			<tr>
				   				<td style="width:35%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   				<td style="width:65%;"><label><b>Bolivianos, como derecho de inscripción.</b></label></td>	   				
				   			</tr>
				   			
				   			<tr>
				   				<td style="width:35%;"><label><b>Bajo Factura Nro.:</b></label></td>
				   				<td style="width:65%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>

				   			<tr><td colspan="2">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width:100%; text-align: right;" colspan="2"><label><b>La Paz, ____________ de ____________ del <?=$datos['gestion'];?></b></label></td>	   				
				   			</tr>
				   	
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%;">
				   			
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 10%;" >&nbsp;</td>
				   				<td style="width: 30%; border-top: 1px solid #000; text-align: center;">Presidente del Club</td>
				   				<td style="width: 20%;" >&nbsp;</td>
				   				<td style="width: 30%; border-top: 1px solid #000; text-align: center;">Secretrio General del Club</td>
				   				<td style="width: 10%;" >&nbsp;</td>
				   			</tr>

				   			<tr>
				   				<td style="width: 10%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;">Nombre</td>
				   				<td style="width: 20%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;">Nombre</td>
				   				<td style="width: 10%;" >&nbsp;</td>
				   			</tr>
				   			<tr>
				   				<td style="width: 10%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;">C.I.</td>
				   				<td style="width: 20%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;">C.I.</td>
				   				<td style="width: 10%;" >&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 10%;" >&nbsp;</td>
				   				<td style="width: 30%; border-top: 1px solid #000; text-align: center;">Delegado Titular</td>
				   				<td style="width: 20%;" >&nbsp;</td>
				   				<td style="width: 30%; border-top: 1px solid #000; text-align: center;">Delegado Suplente</td>
				   				<td style="width: 10%;" >&nbsp;</td>
				   			</tr>

				   			<tr>
				   				<td style="width: 10%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;">Nombre</td>
				   				<td style="width: 20%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;">Nombre</td>
				   				<td style="width: 10%;" >&nbsp;</td>
				   			</tr>
				   			<tr>
				   				<td style="width: 10%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;">C.I.</td>
				   				<td style="width: 20%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;">C.I.</td>
				   				<td style="width: 10%;" >&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 40%;" colspan="2">&nbsp;</td>	   				
				   				<td style="width: 20%; text-align: center;" >Sello del Club</td>
				   				<td style="width: 40%;" colspan="2">&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			
				   			<tr><td colspan="5">Para uso exclusivo de Asociación Obrera Deportiva de La Paz</td></tr>
				   			<tr><td colspan="5">Conforme:</td></tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			
				   			<tr>
				   				<td style="width: 40%;" colspan="2">&nbsp;</td>
				   				<td style="width: 20%; border-top: 1px solid #000; text-align: center;">Strio. Estadistica y Computación</td>
				   				<td style="width: 40%;" colspan="2">&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%;">
							<tr>
								<td style="width: 15%; font-size: 12pt; font-weight: bold;">Nro. Copia</td>
								<td style="width: 10%; text-align: center; border-bottom: 1px solid #000;"><?=$print?></td>
								<td style="width: 50%;">&nbsp;</td>
								<td style="width: 10%; font-size: 12pt; font-weight: bold;">Nro. Recibo</td>
								<td style="width: 15%; border-bottom: 1px solid #000;">&nbsp;</td>
							</tr>
				   		</table>
				   	</td>
				</tr>

				<tr>
					<td style="width: 100%;" colspan="3">&nbsp</td>
				</tr>
			</table>	
		</page>

		<div style="page-break-before: always;">&nbsp;</div>
	<?php

	$print++;
	}
    //$cdet = ob_get_clean();
	//return $cdet; 
	return  ob_get_clean();
} 

?>