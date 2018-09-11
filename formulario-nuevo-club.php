<?php
//require_once('funciones.class.php');
//Funcion que genera Condiciones Particulares
function formulario_nuevo_club($type,$datos,$url,$conexion){
	
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
				   				<td style="width: 20%; text-align: center;" rowspan="6">
				   					<img src="images/logo.png" style="width:100%;">
				   				</td>
				   				<td style=" text-align:center; font-weight:bold; font-size:17pt; width:80%;" colspan="5" >
				   					ASOCIACIÓN OBRERA DEPORTIVA DE LA PAZ
				   				</td>
				   			</tr>   			
				   			<tr>
				   				<td style=" text-align:center; font-weight:bold; font-size:16pt; width: 75%;" colspan="5">
				   					FORMULARIO UNICO DEPORTIVO
				   				</td>
				   			</tr>
				   			
				   			<tr><td style="width: 75%;" colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 15%; font-size: 12pt; font-weight: bold;">&nbsp;&nbsp; Nro. Copia</td>
								<td style="width: 10%; text-align: center; border-bottom: 1px solid #000;"><?=$print?></td>
								<td style="width: 20%;">&nbsp;</td>
								<td style="width: 20%; font-size: 11pt; font-weight: bold;">Registro Único No.</td>
								<td style="width: 10%; border-bottom: 1px solid #000;">&nbsp;</td>
				   			</tr>

				   			<tr><td style="width: 75%;" colspan="5">&nbsp;</td></tr>

				   			<tr><td style="width: 75%; text-align: center; font-weight: bold; font-size: 15pt;" colspan="5">Gestion <?=$datos['gestion'];?></td></tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%; font-weight: bold;">
				   			<tr>
				   				<td style="width:40%;"><label><b>Nombre Completo de la Insitución o Club:</b></label></td>
				   				<td style="width:60%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>
				 
				   			<tr>
				   				<td style="width:40%;"><label><b>Fecha de Afiliacion o inscripciona la A.O.D.L.P.:</b></label></td>
				   				<td style="width:60%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%; font-weight: bold;">	
				   			<tr>
				   				<td style="width:15%;"><label><b>Direccion:</b></label></td>
				   				<td style="width:35%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   				<td style="width:10%;"><label><b>Teléfono:</b></label></td>
				   				<td style="width:40%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>

				   			<tr>
				   				<td style="width:15%;"><label><b>Disciplinas:</b></label></td>
				   				<td style="width:85%; border-bottom: 1px solid #000;" colspan="3">
				   					&nbsp;
				   				</td>
				   			</tr>
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%; font-weight: bold;">	
				   			<tr><td colspan="4">&nbsp;</td></tr>
				   			<tr><td colspan="4">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width:20%;"><label><b>Color Uniforme:</b></label></td>
				   				<td style="width:80%;"  colspan="3">&nbsp;</td>
				   			</tr>
							
							<tr><td colspan="4">&nbsp;</td></tr>

							<tr>
				   				<td style="width:20%; font-weight: normal;"><label><b>Camiseta Oficial:</b></label></td>
				   				<td style="width:80%; border-bottom: 1px solid #000;" colspan="3">
				   					&nbsp;
				   				</td>
				   			</tr>
				
				   			<tr>
				   				<td style="width:20%; font-weight: normal;"><label><b>Pantalón Corto:</b></label></td>
				   				<td style="width:30%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   				<td style="width:8%; font-weight: normal;"><label><b>Medias:</b></label></td>
				   				<td style="width:42%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>
				   	
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%;">
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 20%;" rowspan="4" valign="top">Directorio Ejecutivo</td>
				   			</tr>
				   			<tr>
				   				<td style="width: 10%; ">Presidente:</td>
				   				<td style="width: 45%; border-bottom: 1px solid #000;" >&nbsp;</td>
				   				<td style="width: 5%; ">C.I.:</td>
				   				<td style="width: 20%; border-bottom: 1px solid #000;" >&nbsp;</td>
				   			</tr>

				   			<tr>
				   				<td style="width: 80%;" colspan="4">
									<table class="cuerpo" style="text-align:justify; width:100%;">
										<tr>
							   				<td style="width: 25%; ">Secretario General:</td>
							   				<td style="width: 44%; border-bottom: 1px solid #000;" >&nbsp;</td>
							   				<td style="width: 5%; ">C.I.:</td>
							   				<td style="width: 26%; border-bottom: 1px solid #000;" >&nbsp;</td>
							   			</tr>

							   			<tr>
							   				<td style="width: 25%; ">Secretario Deportes:</td>
							   				<td style="width: 44%; border-bottom: 1px solid #000;" >&nbsp;</td>
							   				<td style="width: 5%; ">C.I.:</td>
							   				<td style="width: 26%; border-bottom: 1px solid #000;" >&nbsp;</td>
							   			</tr>
									</table>
				   				</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%; font-size: 8pt;">
				   			<tr>
				   				<td style="width: 39%; ">Adjuntamos por derecho de Afiliacion la suma de Bs.:</td>
				   				<td style="width: 13%; border-bottom: 1px solid #000;" >&nbsp;</td>
				   				<td style="width: 10%; ">Factura Nro.:</td>
				   				<td style="width: 15%; border-bottom: 1px solid #000;" >&nbsp;</td>
				   				<td style="width: 8%; ">De fecha:</td>
				   				<td style="width: 15%; border-bottom: 1px solid #000;" >&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="6">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 39%; ">Por concepto de inscripcion la suma de Bs.:</td>
				   				<td style="width: 13%; border-bottom: 1px solid #000;" >&nbsp;</td>
				   				<td style="width: 10%; ">Factura Nro.:</td>
				   				<td style="width: 15%; border-bottom: 1px solid #000;" >&nbsp;</td>
				   				<td style="width: 8%; ">De fecha:</td>
				   				<td style="width: 15%; border-bottom: 1px solid #000;" >&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%;">
				   			<tr>
				   				<td style="width: 15%;">&nbsp;</td>
				   				<td style="width: 20%; text-align: center; border-top: 1px solid #000;">PRESIDENTE</td>
				   				<td style="width: 20%;">&nbsp;</td>
				   				<td style="width: 30%; text-align: center; border-top: 1px solid #000;">SECRETARIO GENERAL</td>
				   				<td style="width: 15%;">&nbsp;</td>
				   			</tr>
							
							<tr><td colspan="5">&nbsp;</td></tr>
							<tr><td colspan="5">&nbsp;</td></tr>
							<tr><td colspan="5">&nbsp;</td></tr>

							<tr>
								<td style="width: 100%; text-align: center;" colspan="5">SELLO</td>
							</tr>

							<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 55%;" colspan="3">&nbsp;</td>
				   				<td style="width: 45%; text-align: right;" colspan="2">La Paz, ______ de __________ del <?=$datos['gestion'];?></td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 20%; text-align: center;" colspan="5">Secretaria. Estadística y Computación</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   		</table>
				   	</td>

				   	<td style="width: 2%;">&nbsp</td>
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