<?php
//require_once('funciones.class.php');
//Funcion que genera Condiciones Particulares
function formulario_pase($type,$datos,$url,$conexion){
	
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
				   					FORMULARIO DE PASE DE JUGADOR
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
				   			<tr><td colspan="4">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width:25%;"><label><b>Disciplina:</b></label></td>
				   				<td style="width:75%; border-bottom: 1px solid #000;" colspan="3">
				   					&nbsp;
				   				</td>
				   			</tr>

				   			<tr>
				   				<td style="width:25%;"><label><b>Club de Origen:</b></label></td>
				   				<td style="width:75%; border-bottom: 1px solid #000;" colspan="3">
				   					&nbsp;
				   				</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width:25%;"><label><b>Concede pase al jugador:</b></label></td>
				   				<td style="width:75%; border-bottom: 1px solid #000;" colspan="3">
				   					&nbsp;
				   				</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width:25%;"><label><b>Con Nro. de registro:</b></label></td>
				   				<td style="width:25%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   				<td style="width:10%;"><label><b>Al club:</b></label></td>
				   				<td style="width:40%; border-bottom: 1px solid #000;">
				   					&nbsp;
				   				</td>
				   			</tr>

				   			<tr><td colspan="4">&nbsp;</td></tr>
				   			
				   			<tr>
				   				<td style="width:25%;"><label><b>Que milita en la división de:</b></label></td>
				   				<td style="width:75%;"  colspan="3">&nbsp;</td>
				   			</tr>
				   	
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%;">
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Primera de Honor</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>

				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Primera de Ascenso</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Segunda de Ascenso</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Seniors</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Juvenil</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Pre-Juvenil</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Menores (V)</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Infantil</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Mascotas</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Mosquitos</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Bichitos</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Damas</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 20%;">Varones Especial</td>
				   				<td style="width: 5%;" >&nbsp;</td>
				   				<td style="width: 5%; text-align: left; border: 1px solid #000;">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 30%; border-bottom: 1px solid #000;" colspan="3">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: center;" colspan="3">Firma del Jugador</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;" colspan="3">C.I._______________________________</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: left;" colspan="3">La Paz, ______ de __________ del <?=$datos['gestion'];?></td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			
				   			<tr><td colspan="5">Para uso exclusivo de Asociación Obrera Deportiva de La Paz</td></tr>
				   			<tr><td colspan="5">Conforme:</td></tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   			<tr><td colspan="5">&nbsp;</td></tr>

				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 30%; border-bottom: 1px solid #000;" colspan="3">&nbsp;</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>
				   			<tr>
				   				<td style="width: 30%;" >&nbsp;</td>
				   				<td style="width: 30%; text-align: center;" colspan="3">Strio. Estadistica y Computación</td>
				   				<td style="width: 40%;" >&nbsp;</td>
				   			</tr>

				   			<tr><td colspan="5">&nbsp;</td></tr>
				   		</table>

				   		<table class="cuerpo" style="text-align:justify; width:100%;">
							<tr>
								<td style="width: 15%; font-size: 12pt; font-weight: bold;">Nro. Copia</td>
								<td style="width: 10%; text-align: center; border-bottom: 1px solid #000;"><?=$print?></td>
								<td style="width: 50%;">&nbsp;</td>
								<td style="width: 15%; font-size: 12pt; font-weight: bold;">Nro. Recibo</td>
								<td style="width: 10%; border-bottom: 1px solid #000;">&nbsp;</td>
							</tr>
				   		</table>
				   	</td>

				   	<td style="width: 2%;">&nbsp</td>
				</tr>

				<tr>
					<td style="width: 100%;" colspan="3">&nbsp</td>
				</tr>
			</table>	

		</page>

		<!--<div style="page-break-before: always;">&nbsp;</div>-->
	<?php

	$print++;
	}
    //$cdet = ob_get_clean();
	//return $cdet; 
	return  ob_get_clean();
} 

?>