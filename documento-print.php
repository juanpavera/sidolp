<?php


if(@$_GET['doc'] == 1){
	require_once('funciones.class.php');

	$link = new Sidolp(); 
	$c    = 1;

	if (($rsGE = $link->gestion_act('act')) !== false) {
	  $rowGE = $rsGE->fetch_array(MYSQLI_ASSOC);
	  $gestion = $rowGE['gestion'];
	}

	

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

	$link->sqlf = 'SELECT do.correlativo, do.dirigido, do.referencia, do.tipo, do.fecha_creacion, us.nombre, us.cargo, us.ci, us.extension, ge.gestion
		FROM si_documento AS do
		INNER JOIN ad_usuario AS us ON do.ad_usuario_id = us.id_usuario
		INNER JOIN ad_gestion AS ge ON do.ad_gestion_id = ge.id_gestion
		WHERE do.id_documento = "'.$_GET['id'].'";';

	    if (($rsa = $link->query($link->sqlf)) !== false) {
	        $rowa = $rsa->fetch_array(MYSQLI_ASSOC);

	        $f = explode('-', $rowa['fecha_creacion']);
	        $di = explode('|', $rowa['dirigido']);


			header("Content-type: application/vnd.ms-word"); /* Indica que tipo de archivo es que va a descargar */
			
			header("Pragma: no-cache");
			header("Expires: 0");

		    $data = '<page class="cuerpo" style="width:100%;">';

				if($_GET['tipo'] == 'CA'){
					header("Content-Disposition: attachment;filename=Carta CITE ".$rowa['correlativo']."-".$f[0].".doc"); /* El nombre del archivo y la extensiòn */

					$data .= '<div style="width:100%; text-align justify;">
					   			<div style="width:30%; font-weight:bold; " align="right">
					   				La Paz, '.$f[2].' de '.$link->nombre_mes($f[1]).' de '.$f[0].'<br>
					   				CITE '.$rowa['correlativo'].' / '.$rowa['gestion'].'
					   			</div>
					   			<div class="cuerpo" style="width:30%;" align="left">
					   				Se&ntilde;or/a: <br>
				   					'.$di[0].' <br>
				   					'.$di[1].' <br>
				   					'.$di[2].'
					   			</div>
					   			<div style="width:70%; font-weight:bold; " align="right">
					   				<span style="border-bottom: 1px solid #000;" >Ref. '.$rowa['referencia'].'</span>
					   			</div><br><br>

					   			<div class="cuerpo" style="width:100%;" align="left">
					   				Distinguido / a:<br><br>

									A tiempo de saludarle y hacerle llegar mis saludos cordiales me dirijo a su persona para <b>[Escriba el motivo]</b>.<br><br>

									<b>[Escriba el cuerpo de la carta]</b><br><br>

									Reciba un cordial saludo.
					   			</div><br><br><br><br>';

				}elseif($_GET['tipo'] == 'IN'){
					header("Content-Disposition: attachment;filename=Informe No ".$rowa['correlativo']."-".$f[0].".doc"); /* El nombre del archivo y la extensiòn */
					$data .= '<div style="width:100%; text-align center;">
					   			<div style="width:100%; font-weight:bold; font-size:12pt;" align="center">
					   				INFORME '.$rowa['correlativo'].' / '.$rowa['gestion'].'
					   			</div><br>
					   			<div class="cuerpo" style="width:40%; margin-left: 200px; text-align:left;">
					   				A: &nbsp;&nbsp;&nbsp;&nbsp; '.$di[0].' <br>
				   					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$di[1].'</b> <br>
				   					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$di[2].'</b> <br><br>
				   					DE: &nbsp;&nbsp; '.$rowa['nombre'].' <br>
				   					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$rowa['cargo'].'</b> <br>
				   					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asociacion Obrera Deportiva de La Paz</b> <br><br>
				   					<b>Ref. '.$rowa['referencia'].'<br><br>
					   				La Paz, '.$f[2].' de '.$link->nombre_mes($f[1]).' de '.$f[0].'</b>
					   			</div>
					   			<hr><br>

					   			<div class="cuerpo" style="width:100%;" align="left">
					   				Distinguido / a:<br><br>

									El motivo de la presente es para informarle <b>[Escriba el motivo]</b>.<br><br>

									<b>[Escriba el cuerpo del informe]</b><br><br>

									Es cuanto puedo informar.
					   			</div><br><br><br><br>';

				}

			   	$data .= '<div class="cuerpo" style="width:100%; text-align:center;">
			   				'.$rowa['nombre'].'<br>
							<b>'.$rowa['cargo'].'</b>
			   			</div>
			   		</div>

			   		<table><tr><td>&nbsp;</td></tr></table>
				</page>';
			
		}

	
	echo $data;

	
}else{
	
	echo'<a href="documento-print.php?doc=1&id='.$_GET['id'].'&tipo='.$_GET['tipo'].'" class="btn btn-primary" ><span class="fa fa-file-word-o"></span> Generar</a>';
}
?>
