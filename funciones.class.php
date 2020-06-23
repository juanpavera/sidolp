<?php
require 'configuration.class.php';
class Sidolp extends MySQLi
{
	private $config, $host, $user, $password, $db, $sql, $rs, $row;
	
	public 
		$typeForm = array(
            0 => 'PS|Formulario de Pases', 
            1 => 'FI|Formulario de Inscripción', 
            2 => 'NC|Formulario de Nuevo Club',
            3 => 'CA|Carta',
			4 => 'IN|Informe'
		)        
    ;
	
	public function Sidolp()
	{
		$this->config   = new ConfigurationSidolp();
		$this->host     = $this->config->host;
		$this->user     = $this->config->user;
		$this->password = $this->config->password;
		$this->db       = $this->config->db;
		
		parent::__construct($this->host, $this->user, $this->password, $this->db);
		
		if(mysqli_connect_error()){
			die('Error de Conexion (' .mysqli_connect_errno().' ) '.mysqli_connect_error());
		}
	}
	//
	public function content_menu(){
		?>
		<header class="main-header">
	        <!-- Logo -->
	        <a href="index.php" class="logo">
	          <!-- mini logo for sidebar mini 50x50 pixels -->
	          <!--span class="logo-mini"><b>C</b>R</span-->
	          <span class="logo-mini"><img src="images/aodlp_img.png" width="80%"></span>
	          <!-- logo for regular state and mobile devices -->
	          <!--span class="logo-lg"><b>Crecer</b></span-->
	          <span class="logo-lg"><img src="images/aodlp_txt.png"></span>
	        </a>
	        <!-- Header Navbar: style can be found in header.less -->
	        <nav class="navbar navbar-static-top" role="navigation">
	          <!-- Sidebar toggle button-->
	          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	            <span class="sr-only">Toggle navigation</span>
	          </a>
	          <div class="navbar-custom-menu">
	            <ul class="nav navbar-nav">
	            <!-- User Account: style can be found in dropdown.less -->
	              <?php if (!isset($_SESSION['usuario'])): ?>
	              	<li class="dropdown user user-menu">
		                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		                  <span class="fa fa-id-badge"></span>
		                  <span class="hidden-xs">Ingresar</span>
		                </a>
	                	<ul class="dropdown-menu">
		                  <!-- User image -->
		                  <li class="user-header" style="height:100px;">
		                    <span class="fa fa-id-badge fa-4x"></span>
		                  </li>
		                  <!-- Menu Footer-->
		                  <li class="user-footer">
		                    <div class="pull-left">
		                      <a href="login/login.php" class="btn btn-default">Acceder</a>
		                    </div>
		                  </li>
		                </ul>
	              	</li>
	          	  <?php else: ?>
	          	  	<li class="dropdown user user-menu">
		                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		                  <img src="dist/img/user_incognit.png" class="user-image" alt="User Image" />
		                  <span class="hidden-xs"><?=$_SESSION['nombre_usuario']?></span>
		                </a>
		                <ul class="dropdown-menu">
		                  <!-- User image -->
		                  <li class="user-header">
		                    <img src="dist/img/user_incognit.png" class="img-circle" alt="User Image" />
		                    <p>
		                      <?=$_SESSION['nombre_usuario']?> <br><?=$_SESSION['tipo']?>
		                      <small><?=date('d /m / Y')?></small>
		                    </p>
		                  </li>
		                  <!-- Menu Footer-->
		                  <li class="user-footer">
		                    <div class="pull-left">
		                      <a href="usuario-formulario.php" class="btn btn-default btn-flat">Perfil</a>
		                    </div>
		                    <div class="pull-right">
		                      <a href="login/acceso_login.php?salir" class="btn btn-default btn-flat">Salir</a>
		                    </div>
		                  </li>
		                </ul>
	              	</li>
	              <?php endif ?>
	            </ul>
	          </div>
	        </nav>
      	</header>
		<?php
	}

    //Funciones que devuelve información del menu
	public function menu($user){
    	?>
    	<aside class="main-sidebar">
	       
	        <section class="sidebar">
				<?php if ($user!=''): ?>
		          	<div class="user-panel">
			            <div class="pull-left image">
			              <img src="dist/img/user_incognit.png" class="img-circle" alt="User Image" />
			            </div>
			            <div class="pull-left info">
			            	
			            		<p><?=$user;?></p>
			              		<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			            </div>
		          	</div>
				<?php endif ?>
	          <?php if ($user!='' && isset($_SESSION['usuario'])): ?>
	          	<hr>
	          	<ul class="sidebar-menu">
		            <li class="header">MENU PRINCIPAL</li>
		            	<li class="treeview">
			              <a href="#">
			                <i class="fa fa-address-book-o"></i> <span>Formularios</span> <i class="fa fa-angle-left pull-right"></i>
			              </a>
			              <ul class="treeview-menu">
			              	<li><a href="index.php?pg=<?=md5('FO_PS')?>"><i class="fa fa-edit"></i> Pases</a></li>
			              	<li><a href="index.php?pg=<?=md5('FO_FI')?>"><i class="fa fa-columns"></i> Formularios de Inscripción</a></li>
			              	<li class=""><a href="index.php?pg=<?=md5('FO_NC')?>"><i class="fa fa-list-alt"></i> Formulario Nuevo Club</a></li>
			              </ul>
			            </li>		            	
		            
		            
					
			            <li class="treeview">
			              <a href="#">
			                <i class="fa fa-book"></i> <span>Documentos</span> <i class="fa fa-angle-left pull-right"></i>
			              </a>
			              <ul class="treeview-menu">
			              	
			              	<li><a href="index.php?pg=<?=md5('DC_CA')?>"><i class="fa fa-file-word-o"></i> Cartas</a></li>
			              	<li><a href="index.php?pg=<?=md5('DC_IN')?>"><i class="fa fa-file-powerpoint-o"></i> Informes</a></li>
			              </ul>
			            </li>
			        

			        	<li class="treeview">
			              <a href="#">
			                <i class="fa fa-files-o"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
			              </a>
			              <ul class="treeview-menu">
			              	<li><a href="index.php?pg=<?=md5('RP_FO')?>"><i class="fa fa-address-book-o"></i> Formularios</a></li>
			              	<li><a href="index.php?pg=<?=md5('RP_DO')?>"><i class="fa fa-newspaper-o"></i> Documentos</a></li>
			              	<li><a href="index.php?pg=<?=md5('RP_AF')?>"><i class="fa fa-folder-open"></i> Afiliaciones Equipos</a></li>
			              </ul>
			            </li>

			            <li class="treeview">
			              <a href="#">
			                <i class="fa fa-gear"></i> <span>Administración</span> <i class="fa fa-angle-left pull-right"></i>
			              </a>
			              <ul class="treeview-menu">
			              	<!--<li><a href="index.php?pg=<?=md5('AD_US')?>"><i class="fa fa-address-book-o"></i> Usuarios</a></li>-->
			              	<li><a href="index.php?pg=<?=md5('AD_AF')?>"><i class="fa fa-address-book-o"></i> Afiliaciones</a></li>
			              </ul>
			            </li>
	          	</ul>
	          <?php else: ?>
	          	<div class="col-md-12">
	          		<img src="images/Logo.png" width="100%"><hr>
	          		</span>
	          	</div>
	          <?php endif ?>
	          
	        </section>

      	</aside>
    	<?php
    }
    //Funcion que crea variables de session
	public function control_login($login, $password){
		$pass = md5($password);
		$this->sql = "SELECT us.*
		FROM ad_usuario AS us
		WHERE us.usuario LIKE '".$login."' AND us.password='".$pass."'
		LIMIT 1;";

		if (($this->rs = $this->query($this->sql, MYSQLI_STORE_RESULT)) !== false) {
			if ($this->rs->num_rows == 1) {
				$this->row = $this->rs->fetch_array(MYSQLI_ASSOC);
				$_SESSION['usuario']        = $this->row['usuario'];
				$_SESSION['nombre_usuario'] = $this->row['nombre'];
				$_SESSION['tipo']           = $this->row['tipo'];
				$_SESSION['id_usuario']     = $this->row['id_usuario'];
				if ($this->row['cambio_psswd']=='0') {
					return 11;
				}else{
					return 1;
				}
			}else{
				return 0;
			}
		}else{
			return 2;
		}	
	}

	//Funcion que devuelve las AGENCIAS Registradas
	public function gestion_act($tipo){
		if($tipo == 'act'){
			$cond = ' WHERE ge.activo = 1;';
		}else{
			$cond = ';';
		}

		$this->sql = "SELECT ge.*
		FROM ad_gestion AS ge 
		".$cond;
		if (($this->rs = $this->query($this->sql, MYSQLI_STORE_RESULT))) {
            if ($this->rs->num_rows > 0) {
                return $this->rs;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
	}

	function calcular_anios($fecha, $gestion){
		$fecha_ges = $gestion.'-01-01';
	  	$fecha_nac = new DateTime(date('Y/m/d',strtotime($fecha))); // Creo un objeto DateTime de la fecha ingresada
	  	$fecha_hoy =  new DateTime(date('Y/m/d',strtotime($fecha_ges))); // Creo un objeto DateTime de la fecha de hoy
	  	$dif = date_diff($fecha_hoy,$fecha_nac); // La funcion ayuda a calcular la diferencia, esto seria un objeto
	 	return $dif;
	}

	function nombre_mes($month){
		switch ($month):
	        case '01': return 'Enero';
	        case '02': return 'Febrero';
	        case '03': return 'Marzo';
	        case '04': return 'Abril';
	        case '05': return 'Mayo';
	        case '06': return 'Junio';
	        case '07': return 'Julio';
	        case '08': return 'Agosto';
	        case '09': return 'Septiembre';
	        case '10': return 'Octubre';
	        case '11': return 'Noviembre';
	        case '12': return 'Diciembre';
	    endswitch;
	}

    function nm($month){
        switch ($month):
            case '01': return 'Enero';
            case '02': return 'Febrero';
            case '03': return 'Marzo';
            case '04': return 'Abril';
            case '05': return 'Mayo';
            case '06': return 'Junio';
            case '07': return 'Julio';
            case '08': return 'Agosto';
            case '09': return 'Septiembre';
            case '10': return 'Octubre';
            case '11': return 'Noviembre';
            case '12': return 'Diciembre';
        endswitch;
    }

    function as($month){
        switch ($month):
            case '01': return 'Enero';
            case '02': return 'Febrero';
            case '03': return 'Marzo';
            case '04': return 'Abril';
            case '05': return 'Mayo';
            case '06': return 'Junio';
            case '07': return 'Julio';
            case '08': return 'Agosto';
            case '09': return 'Septiembre';
            case '10': return 'Octubre';
            case '11': return 'Noviembre';
            case '12': return 'Diciembre';
        endswitch;
    }
}
?>