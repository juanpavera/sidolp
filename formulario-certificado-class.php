<?php
class Fomularios{
	private $type, $category, $cat, $idtarjetapersona, $idcompania, $usuario_sesion, $gestion;
	private $cx, $select1, $res1, $datos, $select3, $res3, $regi3, $select44, $res44, $regi44, $select, $res4, $regi4, $select55, $res55, $regi55, $select5, $res5, $regi5, $select6, $res6, $regi6, $rsDet, $dataCert, $dataDet, $queryCt, $rsCt, $dataCt, $queryCopy, $url, $title, $subject_mail;
	public $error, $select2;
	
	function Fomularios($type, $category, $gestion, $conexion){
		$this->type          = $type;
		$this->category      = $category;
		$this->gestion       = $gestion;
		$this->cx            = $conexion;
		
		if(strpos($_SERVER['HTTP_HOST'],'asociacion-obrera') === FALSE){
			$this->url = 'http://'.$_SERVER['HTTP_HOST'].'/sidolp/';
		}else{
			$this->url = 'http://'.$_SERVER['HTTP_HOST'].'/';
		}
		
		//$this->subject_mail = 'Poliza No. '.$this->cat.'-'.$this->id_cotiza;
		
		/*if($this->category == 'ECOS'){
			
			$this->error = $this->set_query_cert_SIN();
			$this->title = 'Fortaleza';
			$this->subject_mail .= ' Fortaleza';
		}*/
		
		switch ($this->category) {
			case 'PS':
				require_once 'formulario-pase.php';
				break;
			case 'FI':
				require_once 'formulario-inscripcion.php';
				break;
			case 'NC':
				require_once 'formulario-nuevo-club.php';
				break;
			case 'CA':
				require_once 'documento-carta.php';
				break;
			case 'IN':
				require_once 'documento-informe.php';
				break;
		}
		


		$this->error = $this->set_query_cert_FORM();		
	}

	
	private function set_query_cert_FORM(){
		$this->select1="SELECT *
		FROM si_formulario AS fo
		INNER JOIN ad_gestion AS ge ON fo.ad_gestion_id = ge.id_gestion
		WHERE fo.tipo = '".$this->category."' AND 
		fo.ad_gestion_id = ".$this->gestion."
		ORDER BY fo.id_formulario DESC 
		LIMIT 1
		;";
		if($this->res1 = mysql_query($this->select1,$this->cx)){
		    $this->datos = mysql_fetch_array($this->res1); 
			mysql_free_result($this->res1);
			return TRUE;
		}else{
		   return FALSE;	
		}
		
	}

	public function get_formulario_PRINT(){
		$this->get_style();
		$this->get_script();
		$this->get_content_html();
		
		$content = '<div id="imprimir-certificados">';
		switch ($this->category) {
			case 'PS':
				$content .= formulario_pase($this->type,$this->datos,$this->url,$this->cx);
				break;
			case 'FI':
				$content .= formulario_inscripcion($this->type,$this->datos,$this->url,$this->cx);
				break;
			case 'NC':
				$content .= formulario_nuevo_club($this->type,$this->datos,$this->url,$this->cx);
				break;
			case 'CA':
				$content .= documento_carta($this->type,$this->datos,$this->url,$this->cx);
				break;
			case 'IN':
				$content .= documento_informe($this->type,$this->datos,$this->url,$this->cx);
				break;
		}
		$content .= '</div>';
		echo $content;
	}


	private function get_style(){
		?>
		<style type="text/css">
			.link-cert{
				display: inline-block;
				*display: inline;
				_display: inline;
				width: 50px;
				height: 50px;
				margin: 3px 5px;
				padding: 0;
				border: 0 none;
				text-decoration: none;
				vertical-align: top;
				zoom: 1;
			}

			.link-cert img{
				border: 0 none;
			}

			.loading-resp{
				display: inline-block;
				*display: inline;
				_display: inline;
				width: 350px;
				height: 0px;
				background: url(images/loading-01.gif) top center no-repeat;
				vertical-align: top;
				font: bold 90% Arial, Helvetica, sans-serif;
				text-align: center;
				zoom: 1;
			}
			#view-form input[type="text"]{
				display: inline-block;
				padding: 7px 10px;
				margin: 3px 0px;
				border: 1px solid #bababa;
				width: 200px;
				font-size: 10px;
			}
			#view-form #enviar{
				display: inline-block;
				width: 100px;
				padding: 5px 5px;
				margin: 3px auto 0 auto;
				border: 0 none;
				background: #0075aa;
				color: #FFFFFF;
				cursor: pointer;
			}

			#view-form #enviar:hover{
				background: #1a834c;
			}
		</style>
		<?php
	}
	
	private function get_script(){
		?>
		<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#send-print").click(function(e){

					e.preventDefault();
					var rel = $(this).prop("rel");
					//$(".attached-link").hide();
					//$(".container-logo").hide();
					
					var ficha = document.getElementById(rel);
					var ventimp = window.open(' ','popimpr');
					ventimp.document.write(ficha.innerHTML);
					ventimp.document.close();
					ventimp.print();
					ventimp.close();
					//ventimp.document.onbeforeunload = confirmExit();*/
				});
				
			});

			function confirmExit(){
				$(".attached-link").show();
				$(".container-logo").show();
			}
		</script>
		<?php
	}

	private function get_content_html(){
		?>
		<div class="col-md-2 col-xs-6">
			<div class="rows">
				<div class="col-md-6">
					<a href="#" title="Imprimir" class="link-cert" rel="imprimir-certificados" id="send-print">
						<img src="<?=$this->url;?>images/printer.png" alt="Imprimir" />
					</a>
				</div>				
			</div>
		</div>
		<div class="col-md-10 col-xs-6" style="text-align:right;">
			<span style="padding: 10px 10px 10px 10px; font-size:12pt; font-weight:bold; color:#555;"> Formulario <span style="color:#00A65A;">SIDOLP</span></span> &nbsp;
		</div>
		<?php
		echo '<hr />';
	}
}
?>