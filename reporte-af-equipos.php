<?php


if(@$_GET['xls'] == 1){
	require_once('funciones.class.php');

	$link = new Sidolp(); 
	$c    = 1;

	if (($rsGE = $link->gestion_act('act')) !== false) {
	  $rowGE = $rsGE->fetch_array(MYSQLI_ASSOC);
	  $gestion = $rowGE['gestion'];
	}

	header("Content-type: application/vnd.ms-excel"); /* Indica que tipo de archivo es que va a descargar */
	header("Content-Disposition: attachment;filename=Equipos_Afiliados_".$gestion.".xls"); /* El nombre del archivo y la extensiòn */
	header("Pragma: no-cache");
	header("Expires: 0");

	$link->sqlf = 'SELECT eq.nombre, eq.fecha_afiliacion, eq.fecha_fundacion, eq.direccion, eq.telefono, eq.presidente_act
	    FROM ad_equipo AS eq 
	    ORDER BY eq.fecha_afiliacion ASC;';

	    $data = '<table>
	    		<tr>
					<td colspan="8" style="font-size:15pt; text-align:center;">ASOCIACION OBRERA DEPORTIVA DE LA PAZ</td>
	    		</tr>
	    		
	    		<tr>
					<td colspan="8" style="font-size:12pt; text-align:center;">Lista de Clubes afiliados</td>
	    		</tr>
	    		
	    		<tr>
					<td colspan="8" style="font-size:15pt; text-align:center;">Gestion '.$gestion.'</td>
	    		</tr>

	    		<tr><td colspan="8">&nbsp</td></tr>

	              <tr style="color:#FFF; font-weight:bold; border:1px solid #FFF;">
		              <td style="background:#10387c;">NRO REGISTRO</td>
		              <td style="background:#10387c;">NOMBRE DEL CLUB</td>
		              <td style="background:#10387c;">ANTIGUEDAD</td>
		              <td style="background:#10387c;">FECHA AFILIACION</td>
		              <td style="background:#10387c;">FECHA DE FUNDACION</td>
		              <td style="background:#10387c;">DIRECCION</td>
		              <td style="background:#10387c;">TELEFONO</td>
		              <td style="background:#10387c;">PRESIDENTE ACTUAL</td>
		           </tr>';

	        if (($rsa = $link->query($link->sqlf)) !== false) {
	            while($rowa = $rsa->fetch_array(MYSQLI_ASSOC)){
	              
	              /**/$tiempo = $link->calcular_anios($rowa['fecha_afiliacion'], $gestion);

	              $data .= '
	                    <tr>
	                      <td style="border:1px solid #000; text-align:center;">'.$c.'</td>
	                      <td style="border:1px solid #000;">'.$rowa['nombre'].'</td>
	                      <td style="border:1px solid #000; text-align:center;">'.$tiempo->format('%Y').'</td>
	                      <td style="border:1px solid #000;">'.$rowa['fecha_afiliacion'].'</td>
	                      <td style="border:1px solid #000;">'.$rowa['fecha_fundacion'].'</td>
	                      <td style="border:1px solid #000;">'.$rowa['direccion'].'</td>
	                      <td style="border:1px solid #000;">'.$rowa['telefono'].'</td>
	                      <td style="border:1px solid #000;">'.$rowa['presidente_act'].'</td>
	                  </tr>';
	            $c++;
	            }
	        }

	        $data .='</table>';

	
	echo $data;

	
}else{
	
	echo'<a href="reporte-af-equipos.php?xls=1" class="btn btn-primary" ><span class="fa fa-file-excel-o"></span> Exportar</a>';
}
?>
