<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados


// se adicionan las variables globales del sistema
include_once 'configuration.php';

/**
 * Clase para gestionar las conexiones dentro del sistema. Establece la conexión
 * para los servicios web y para las consultas directamente a la base de datos
 * a través de MySql.
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @uses configuration.php
 */
class Connection {

	public static $instance;
	private $proxySoap;
	private $proxyMySql;
	private $dataBase = MN_MANTIS_DATABASE;
	private $user = MN_MANTIS_ROOT_USERNAME;
	private $password = MN_MANTIS_ROOT_PASSWORD;
	private $server = MN_HOST;
	private $mantisWebServiceDir = MANTIS_WEBSERVICES_DIR;
	
	// para incluir en el joomla este fichero
	// include( $_SERVER['DOCUMENT_ROOT'] . "/mantis-client/src/mantis_core.php");

	
	/**
	 * Constuctor de la clase haciendo uso del patrón Singletón
	 * @return Connection
	 */
	public function __construct() {
		if (!self::$instance) {
			$this->loadProxyMySql();
			$this->loadProxySoap();
			self::$instance = $this;
		}
		return self::$instance;
	}
	
	/**
	 * Establece una conexión MySQL
	 */
	private function loadProxyMySql() {
		$this->proxyMySql = new mysqli($this->server, $this->user, $this->password, $this->dataBase);
		if (mysqli_connect_errno()) {
			echo("Failed to connect, the error message is : ". mysqli_connect_error());
			exit();
		}
	}
	
	/**
	 * Establece una conexión con los servicios web de mantis.
	 */
	private function loadProxySoap() {
		$this->proxySoap = new SoapClient($this->mantisWebServiceDir);
		if ($this->proxySoap == null) {
			echo('Faild to connect to the web service');
			exit();
		}
	}
	
	/**
	 * Se obtiene una instancia de la conexión del servicio web.
	 * @return SoapClient
	 */
	public function getProxySoap() {
		return $this->proxySoap;
	}
	
	/**
	 * Se obtiene una instancia de la conexión a la base de datos MySQL.
	 * @return mysqli
	 */
	public function getProxyMySql() {
		return $this->proxyMySql;
	}
}
?>