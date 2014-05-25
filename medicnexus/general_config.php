<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * En este fichero se almacenan las variables de configuración
 * generales del sistema Medicnexus completo. Garantiza que todos
 * los sistemas que funcionan intenernamente cuenten con la misma 
 * información y que de ser necesario una modificación pues se realice
 * solamente en este fichero.
 */


#################################
#     Variables para MySQL      #
#################################

	/**
	 * Define el nombre del servidor de producción
	 */
	define('MN_HOST', 'mysql.medicnexus.com');
	/**
	 * Define el usuario establecido para acceder a MYSQL
	 */
	define('MN_MYSQL_USER', 'vacio');
	/**
	 * Define la contraseña establecida para acceder a MYSQL
	 */
	define('MN_MYSQL_PASSWORD', 'vacio');	
	
#################################
#     Variables para Mantis     #
#################################

	/**
	 * Define el usuario de administración de Mantis
	 */
	define('MN_MANTIS_ROOT_USERNAME', 'mninside');
	/**
	 * Define la contraseña del usuario de administración de Mantis
	 */
	define('MN_MANTIS_ROOT_PASSWORD', 'MedicnexuS2013');
	/**
	 * Define el nombre de la base de datos utilizado en Mantis
	 */
	define('MN_MANTIS_DATABASE', 'mninside');
	/**
	 * Define el tamaño máximo para los ficheros adjuntos
	 */
	define('MN_MANTIS_FILE_MAX_SIZE', 5120000 );  # in bytes
	/**
	 * Define la unidad de medida para los ficheros adjuntos
	 */
	define('MN_MANTIS_FILE_UNITY_SIZE', 'MB' );  #posibles valores KB y MB

	
#################################
#     Variables para Joomla     #
#################################	

	/**
	 * Define el usuario de administración para el sitio Joomla
	 */
	define('MN_JOOMLA_ROOT_USERNAME', 'cero_mn');
	/**
	 * Define la contraseña del usuario de administración para el sitio Joomla
	 */
	define('MN_JOOMLA_ROOT_PASSWORD', 'MedicnexuS2013');
	/**
	 * Define el nombre de la base de datos en el sitio Joomla
	 */
	define('MN_JOOMLA_DATABASE', 'cero_mn');
	/**
	 * Define el prefijo utilizado para las tablas existentes en la base de datos Joomla
	 */
	define('MN_JOOMLA_DATABASE_PREFIX', 'cero_');
	/**
	 * Variable para el camino reslativo del sitio
	 */
	define('SUB_PROJECT_PATH','');	
	/**
	 * Defien el correo del sitio
	 */
	define('MN_JOOMLA_EMAIL_FROM', 'no-reply@medicnexus.com' );
	/**
	 * Defien el contraseña del correo del sitio
	 */
	define('MN_JOOMLA_EMAIL_PASSWORD_FROM', 'nonono' );