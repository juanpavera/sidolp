<?php
require 'configuration.class.php';
class SidolpDB extends MySQLi
{
	private $config, $host, $user, $password, $db, $sql, $rs, $row, $con;
	
	public function SidolpDB()
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
	public function connectDB(){
		if(!($this->con = @mysql_connect($this->host,$this->user,$this->password))){
			echo 'No se puede conectar al servidor';
			exit();
		}
		elseif(!@mysql_select_db($this->db,$this->con)){
			echo 'No se puede conectar a la base de datos';
			exit();
		}
		return $this->con;
	}
}
?>