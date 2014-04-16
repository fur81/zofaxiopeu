<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados


include_once $GLOBALS ['MNI_CONNECTION'];

/**
 * Esta clase gestiona todos los servicios de comnucación relacioandos
 * con el sistema Mantis. Las instancias de esta clase son las utilizadas
 * dentro de las vistas (páginas) de la aplicación para hacer uso de los
 * servicios implementados.
 * 
 * Se establecen dos tipos de conexiones:
 * - Servicios Web
 * - Driver MYSQL
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 * 
 * @uses connection.php
 */


class MantisCore {
	
	/**
	 * Usuario autenticado en el sitio.
	 * @var string
	 */
	private $currentUser;
	/**
	 * Constraseña del usuario autenticado en el sitio.
	 * @var string
	 */
	private $currentPassword;
	/**
	 * Identificador del usuario en Mantis.
	 * @var int
	 */
	private $currentId;
	/**
	 * Puente de conexión para los consumir los servicios web del Mantis.
	 * @var soap
	 */
	private $proxySoap;
	/**
	 * Puente de conexión para obtener información de la base de datos en mysql
	 * @var unknown_type
	 */
	private $proxyMySql;

	/**
	 * Constructor de la clase.
	 */
	public function __construct() {
		$connection = new Connection ();
		$this->proxySoap = $connection->getProxySoap ();
		$this->proxyMySql = $connection->getProxyMySql ();
	}

	/**
	 * Se obtiene la versión del sistema Mantis.
	 */
	public function getMantisVersion() {
		$result = '';
		try {
			$result = $this->proxySoap->mc_version ();
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se autentica el usuario en el sitio y se almacenan sus valores.
	 * En el caso de que los usuarios no se encuentren registrados se
	 * les crea una cuenta.
	 *
	 * @param string $username
	 * @param string $realname
	 * @param string $email
	 */
	public function login($username, $realname, $email) {
		// se establece el usuario
		$this->currentUser = "z_" . $username;
		// se establece la contraseña con el patrón establecido
		$this->currentPassword = $this->currentUser . "_%&";

		// si no existe se crea
		$this->createAccount ( $this->currentUser, $realname, $email );
	}
	
	/**
	 * Crea una nueva cuenta de usuario.
	 *
	 * @param string $username
	 * @param strig $realname
	 * @param string $email
	 */
	private function createAccount($username, $realname, $email) {
		try {
			// se chequea que el usuario ya tenga creada una cuenta
			$existUser = $this->existAccountByUsername ( $username );
			if (! $existUser) {
				// se recopilan los datos para crear una cuenta
				$password = md5 ( $this->currentPassword );
				$enabled = 1;
				$protected = 0;
				$accessLevel = 25;
				$loginCount = 0;
				$lostPasswordRequestCount = 0;
				$failLoginCount = 0;
				$cookieString = time ();
				$lastVisit = time ();
				$dateCreated = time ();
				// se concatenan los valores a utilizar en la consulta
				$values = '"' . $username . '","' . $realname . '","' . $email . '","' . $password . '",' . $enabled . ',';
				$values .= $protected . ',' . $accessLevel . ',' . $loginCount . ',' . $lostPasswordRequestCount . ',';
				$values .= $failLoginCount . ',' . $cookieString . ',' . $lastVisit . ',' . $dateCreated;
				// se ejecuta la consulta
				$query = str_replace ( '%values%', $values, getQuery ( 'createAccount' ) );
				$this->proxyMySql->query ( $query );
			}
		} catch ( Exception $e ) {
		}
	}

	/**
	 * Busca si existe un nombre de usuario en la base de datos.
	 *
	 * @param string $username
	 * @return boolean
	 */
	private function existAccountByUsername($username) {
		try {
			$exist = false;
			$query = str_replace ( '%value%', '"' . $username . '"', getQuery ( 'findAccountByUsername' ) );
			$result = $this->proxyMySql->query ( $query );
			if ($data = $result->fetch_object ()) {
				$this->currentId = $data->id;
				$exist = true;
			}
		} catch ( Exception $e ) {
		}
		return $exist;
	}

	/**
	 * Obtiene toda la información del usuario almacenada en el sitio Mantis.
	 * @return stdClass userData
	 * @deprecated
	 */
	public function getUserData() {
		$result = '';
		try {
			// se obtiene la información del usuario
			$userData = $this->proxySoap->mc_login ( $this->currentUser, $this->currentPassword );
			$result = $userData->account_data;
		} catch (Exception $e) {
		}
		return $result;
	}

	/**
	 * Al usurio registrado se le adicionan todos aquellos
	 * proyectos en los cuales no se encuentra asignado.
	 * 
	 * @param string $projectId
	 */
	public function addAccountToProject() {
		try {
			// se obtiene el identificador del usuario
			$idUser = $this->currentId;
			// se obtienen todos los proyectos donde no esta incluido
			$query = str_replace( '%value%', $idUser, getQuery ( 'getProjectNoAsigned' ) );
			$result = $this->proxyMySql->query ( $query );
			while ( $data = $result->fetch_object () ) {
				$proyectId = $data->id;
				// se inserta en la base de datos
				$values = $proyectId . ',' . $idUser . ',' . MANTIS_INFORMER_ACCESS;
				$query = str_replace ( '%values%', $values, getQuery ( 'addAccountToProject' ) );
				$this->proxyMySql->query ( $query );
			}
		} catch (Exception $e) {
		}
	}

	/**
	 * Pregunta si existe una incidencia a partir del identificador de la incidencia.
	 *
	 * @param integer $issue_id
	 * @return boolean
	 */
	public function existIssue($issueId) {
		$result = 0;
		try {
			$result = $this->proxySoap->mc_issue_exists ( $this->currentUser, $this->currentPassword, $issueId );
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se obtiene una incidencia a partir del identificador.
	 *
	 * @param int $idIssue
	 * @return string
	 */
	public function getIssueById($issueId) {
		$result = '';
		try {
			if ($this->existIssue ( $issueId )) {
				$result = $this->proxySoap->mc_issue_get ( $this->currentUser, $this->currentPassword, $issueId );
			}
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se obtiene los encabezados de las incidencias del usuario registrado.
	 */
	public function getIssueHeaders() {
		return $this->proxySoap->mc_project_get_issue_headers ( $this->currentUser, $this->currentPassword, getProjectId(), PAGE_NUMBER, ELEMENTS_PER_PAGE );
	}

	/**
	 * Se obtiene la cantidad de incidencias que tiene un proyecto sin leer.
	 * 
	 * @param int $projectId
	 * @return number total
	 */
	public function getIssuesWithHistoryCount($projectId) {
		$total = 0;
		try {
			$query = str_replace( '%projectId%', $projectId, getQuery ( 'getIssuesByUser' ) );
			$query = str_replace( '%username%', $this->currentUser, $query );
			$result = $this->proxyMySql->query ( $query );
			while ( $data = $result->fetch_object () ) {
				$issueId = $data->id;
				// se chequea si la incidencia ha sido leída
				$isIssueRead = $this->isIssueRead($issueId);
				if (!$isIssueRead) {
					// como no ha sido leída se suma al total
					$total++;
				}
			}
		} catch (Exception $e) {
		}
		return $total;
	}

	/**
	 * Se obtiene la descripcion completa de las incidencias del usuario registrado.
	 * 
	 * @return ArrayObject $incidencias
	 */
	public function getIssuesDetail() {
		$result = '';
		try {
			$result = $this->proxySoap->mc_project_get_issues ( $this->currentUser, $this->currentPassword, getProjectId (), PAGE_NUMBER, ELEMENTS_PER_PAGE );
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se adiciona una incidencia con los datos por defecto.
	 *
	 * @param string $summary
	 * @param string $description
	 * @return id
	 */
	public function addIssue($summary, $description, $projectId, $specialistId) {
		$result = '';
		try {
			$issueData = new stdClass();
			// proyecto
			$issueData->project = $this->getProject($projectId);
			// categoria
			$issueData->category = 'General';
			// informador
			$issueData->summary = $summary;
			// descripción
			$issueData->description = $description;
			// asignación a un especialista si es pasado por parámetros
			if ($specialistId != null) {
				$issueData->handler = new stdClass();
				$issueData->handler->id = $specialistId;
			}
			// se crea la incidencia
			$result = $this->proxySoap->mc_issue_add ( $this->currentUser, $this->currentPassword, $issueData );
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se adiciona una nota a una incidencia.
	 *
	 * @param int $issueId
	 * @param string $issueNote
	 */
	public function addIssueNote($issueId, $issueNoteData) {
		$result = '';
		try {
			// se crea la nota
			$issueNote = new stdClass ();
			$issueNote->text = $issueNoteData;
			// se adiciona la nota al usuario registrado
			$result = $this->proxySoap->mc_issue_note_add ( $this->currentUser, $this->currentPassword, $issueId, $issueNote );
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se obtiene el último registro de historia asociado a una incidencia.
	 * pasada por parámetro.
	 * @param int $issuId
	 * @return stdClass historyBug
	 */
	public function getLastHistoryBug($issueId) {
		$result = '';
		// se crea un registro histórico vacío
		$historyBug = new stdClass();
		try {
			$query = str_replace ( '%value%', $issueId, getQuery ( 'getLastHistoryBug' ) );
			$result = $this->proxyMySql->query ( $query );
			// se llena el registro histórico a partir de los datos obtenidos en la consulta
			while ( $data = $result->fetch_object () ) {
				$historyBug->id = $data->id;
				$historyBug->userId = $data->user_id;
				$historyBug->bugId = $data->bug_id;
				$historyBug->oldValue = utf8_encode($data->old_value);
				$historyBug->type = $data->type;
			}
		} catch (Exception $e) {
		}
		return $historyBug;
	}

	/**
	 * Se inserta un registro dentro del historial de la incidencia. Se utiliza principalmente para
	 * adicionar y eliminar etiquetas de los mensajes y poder conocer en qué momento el usuario ha
	 * leído o revisado la incidencia.
	 * 
	 * @param unknown_type $historyBug
	 */
	private function addHistoryBug($historyBug) {
		try {
			// Se colocan los datos para realizar la inserción.
			$values =  $historyBug->userId . ',';
			$values .= $historyBug->bugId . ', "" ,';
			$values .= '"'. $historyBug->oldValue . '", "",';
			$values .= $historyBug->type . ',';
			$values .= date_timestamp_get(new DateTime());

			// se sustituyen los valores
			$query = str_replace ( '%values%', $values, getQuery ( 'addHistoryBug' ) );

			// se ejecuta la consulta
			$this->proxyMySql->query ( $query );

		} catch (Exception $e) {
		}
	}

	/**
	 * Se cuentan todas las historias de tipo etiquetas relacionadas a una
	 * incidencia.
	 * 
	 * @param int $issuId
	 * @return int $totalRows
	 */
	public function getHistoiesBugTag($issueId) {
		$totalRows = 0;
		try {
			// se sustituyen los valores
			$query = str_replace ( '%value%', $issueId, getQuery ( 'getHistoriesBugTag' ) );

			// se ejecuta la consulta
			$result = $this->proxyMySql->query ( $query );
			while ( $data = $result->fetch_object () ) {
				$totalRows = $data->totalRows;
			}
		} catch (Exception $e) {
		}
		return $totalRows;
	}

	/**
	 * Chequea si la incidencia ha sido leída o no. Primero se chequea que pertenezca al mismo usuario
	 * registrado. Si coincide significa que no se ha leído. De ser así se inserta el registro de historia
	 * para quitar la marca de incidencia leída si es que este no es el último registro.
	 * Si coincide pues no hay que hacer nada.
	 * 
	 * @param int $issueId
	 * @return boolean
	 */
	public function isIssueRead($issueId) {
		$result = '';
		$lastModificationUserId = '';
		$isIssueRead = TRUE;
		try {
			// se obtiene el ultimo historial
			$historyBug = $this->getLastHistoryBug($issueId);

			// se chequea que no pertenezca al mismo usuario registrado
			if ( $historyBug->userId == NULL || $this->currentId != $historyBug->userId) {
				$isIssueRead = FALSE;
				
				// se quita la etiqueta de leido solo si todavia existe
				$totalHistoriesBugTag = $this->getHistoiesBugTag($issueId);
				if (bcmod($totalHistoriesBugTag, 2) == 0) {
					// se inserta un history bug
					$historyBug->oldValue = utf8_decode(MANTIS_READ_LABEL_HISTORY);
					$historyBug->type = MANTIS_REMOVE_TYPE_HISTORY;
					$this->addHistoryBug($historyBug);
				}
			}
		} catch (Exception $e) {
		}
		return $isIssueRead;
	}

	/**
	 * Se crea un registro de la historia de la incidencia para marcar a la incidencia como leída.
	 * 
	 * @param int $issueId
	 */
	public function createHistoryBug($issueId) {

		// se obtiene el id del usuario registrado en este momento
		$idUser = $this->currentId;
			
		// se ponen los valores del elemento a adicionar
		$historyBug = new stdClass();
		$historyBug->userId = $idUser;
		$historyBug->bugId = $issueId;
		$historyBug->oldValue = utf8_decode(MANTIS_READ_LABEL_HISTORY);
		$historyBug->type = MANTIS_ADD_TYPE_HISTORY;
		// se adiciona el registro histórico
		$this->addHistoryBug($historyBug);
	}

	/**
	 * Se obtiene un adjunto a partir de su identificador.
	 *
	 * @param int $issueAttachmentId
	 * @return string $id
	 */
	public function getAttachmentById($attachmentId) {
		$result = '';
		try {
			$result = $this->proxySoap->mc_issue_attachment_get ( $this->currentUser, $this->currentPassword, $attachmentId );
		} catch ( Exception $e ) {
			error_log ( $e );
		}
		return $result;
	}

	/**
	 * Agrega un adjunto a la incidencia cuyo identificador es pasado por parámetro.
	 *
	 * @param int $issueId
	 * @param string $name
	 * @param string $fileType
	 * @param $binary $content
	 * @return Ambiguous
	 */
	public function addAttachment($issueId, $name, $fileType, $content) {
		$result = '';
		try {
			$result = $this->proxySoap->mc_issue_attachment_add ( $this->currentUser, $this->currentPassword, $issueId, $name, $fileType, $content );
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se obtiene los datos de un proyecto a partir de su identificador.
	 *
	 * @param int $projectId
	 * @return stdClass
	 */
	public function getProject($projectId) {
		try {
			$value = $projectId;
			$query = str_replace ( '%value%', $value, getQuery ( 'getProjectName' ) );
			$result = $this->proxyMySql->query ( $query );
			// se crea el proyecto vacío
			$project = new stdClass();
			// se llenan sus datos a partir del resultado de la consulta
			while ( $data = $result->fetch_object () ) {
				$project->id = $projectId;
				$project->name = utf8_encode($data->name);
			}
		} catch (Exception $e) {
		}
		return $project;
	}

	/**
	 * Se obtienen los sub proyectos asociados al proyecto actualmente seleccionado.
	 * 
	 * @param int $projectId
	 * @return array
	 */
	public function getSubProjects() {
		$result = '';
		try {
			$result = $this->proxySoap->mc_project_get_all_subprojects( $this->currentUser, $this->currentPassword, getProjectId());
		} catch (Exception $e) {
		}
		return $result;
	}
	
	/**
	 * Se obtienen los sub proyectos asociados a un proyecto a partir del identificador
	 * pasado por parámetro.
	 * 
	 * @param int $projectId
	 * @return array
	 */
	public function getAllSubProjects($projectId) {
		$result = '';
		try {
			$value = $projectId;
			$query = str_replace ( '%value%', $value, getQuery ( 'getSubprojects' ) );
			$response = $this->proxyMySql->query ( $query );
			$result = new ArrayObject();
			while ( $data = $response->fetch_object () ) {
				$result->append($data->subprojectId);
			}
		} catch (Exception $e) {
		}
		return $result;
	}

	/**
	 * Se obtienen los desarrolladores que se encuentran asignados a un proyecto.
	 * 
	 * @deprecated
	 * @param int $projectId
	 * @return ArrayObject $users
	 */
	public function getDeveloperUsersByProject($projectId) {
		$result = '';
		try {
			$value = $projectId;
			$query = str_replace ( '%value%', $value, getQuery ( 'getDeveloperUsersByProject' ) );
			$result = $this->proxyMySql->query ( $query );
			$users = new ArrayObject();
			while ( $data = $result->fetch_object () ) {
				$user = new stdClass();
				$user->id = $data->user_id;
				$user->realname = utf8_encode($data->realname);
				$users->append($user);
			}
		} catch (Exception $e) {
		}
		return $users;
	}

	/**
	 * Se obtienen todos los datos de un usuario a partir de su identificador.
	 * 
	 * @param int $userId
	 * @return stdClass user
	 */
	public function getUserById($userId) {
		$result = '';
		try {
			$query = str_replace ( '%value%', $userId, getQuery ( 'getUserById' ) );
			$result = $this->proxyMySql->query ( $query );
			// se crea un usuario vación
			$user = new stdClass();
			// se llena el usuario con los datos obtenidos en la consulta
			while ( $data = $result->fetch_object () ) {
				$user->id = $data->id;
				$user->username = utf8_encode($data->username);
				$user->realname = utf8_encode($data->realname);
				$user->email = $data->email;
				$user->access_level = $data->access_level;
				$user->login_count = $data->login_count;
				$user->last_visit = $data->last_visit;
			}
		} catch (Exception $e) {
		}
		return $user;
	}

	/**
	 * Se listan todas las categorías pertenecientes al proyecto seleccionado.
	 * 
	 * @deprecated
	 * @return array
	 */
	public function getCategoriesByProject() {
		$result = '';
		try {
			$result = $this->proxySoap->mc_project_get_categories ( $this->currentUser, $this->currentPassword, getProjectId () );
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se adiciona una categoria para los usuarios existenes en el sistema.
	 * 
	 * @deprecated
	 * @param string $name
	 */
	public function addUserCategory($name) {
		try {
			if (strlen ( $name ) > 0) {
				// se inserta en la base de datos
				$values = '"' . $name . '"';
				$query = str_replace ( '%values%', $values, getQuery ( 'addUserCategory' ) );
				$this->proxyMySql->query ( $query );
			}
		} catch ( Exception $e ) {
		}
	}

	/**
	 * Se listan las categorías de los usuarios
	 * 
	 * @deprecated
	 * @return stdClass
	 */
	public function getUserCategories() {
		$result = '';
		try {
			$query = getQuery ( 'getUserCategories' );
			$result = $this->proxyMySql->query ( $query );
			$categories = new ArrayObject ();
			while ( $data = $result->fetch_object () ) {
				$category = new stdClass ();
				$category->id = $data->id;
				$category->name = utf8_encode($data->name);
				$categories->append ( $category );
			}
		} catch ( Exception $e ) {
		}
		return $categories;
	}

	/**
	 * Se elimina una categoria de usuario.
	 * 
	 * @deprecated
	 * @param int $userCategoryId
	 */
	public function removeUserCategory($userCategoryId) {
		try {
			$value = $userCategoryId;
			$query = str_replace ( '%value%', $value, getQuery ( 'removeUserCategory' ) );
			$this->proxyMySql->query ( $query );
		} catch ( Exception $e ) {
		}
	}

	/**
	 * Se obtienen todos los desarrolladores (medicos) que no están asignados
	 * a una categoría pasada por parámetro.
	 * 
	 * @deprecated
	 * @param int $userCategoryId
	 * @return ArrayObject
	 */
	public function getUsersNotInCategory($userCategoryId) {
		try {
			$value = $userCategoryId;
			$query = str_replace ( '%value%', $value, getQuery ( 'getUsersNotInCategory' ) );
			$result = $this->proxyMySql->query ( $query );
			$users = new ArrayObject ();
			while ( $data = $result->fetch_object () ) {
				$user = new stdClass ();
				$user->id = $data->id;
				$user->realname = utf8_encode($data->realname);
				$users->append ( $user );
			}
		} catch (Exception $e) {
		}
		return $users;
	}

	/**
	 * Se obtienen todos los desarrolladores (medicos) que no están asignados
	 * a una categoría pasada por parámetro.
	 * 
	 * @deprecated
	 * @param int $userCategoryId
	 * @return ArrayObject
	 */
	public function getUsersInCategory($userCategoryId) {
		try {
			$value = $userCategoryId;
			$query = str_replace ( '%value%', $value, getQuery ( 'getUsersInCategory' ) );
			$result = $this->proxyMySql->query ( $query );
			$users = new ArrayObject ();
			while ( $data = $result->fetch_object () ) {
				$user = new stdClass ();
				$user->id = $data->id;
				$user->realname = utf8_encode($data->realname);
				$users->append ( $user );
			}
		} catch (Exception $e) {
		}
		return $users;
	}

	/**
	 * Se adiciona un desarrollador (medico) a una categoría.
	 * 
	 * @deprecated
	 * @param int $userId
	 * @param int $categoryId
	 */
	public function addUserToCategory($userId, $categoryId) {
		try {
			$values =  $userId . ' , ';
			$values .= $categoryId;
			$query = str_replace ( '%values%', $values, getQuery ( 'addUserToCategory' ) );
			$this->proxyMySql->query ( $query );
		} catch (Exception $e) {
		}
	}

	/**
	 * Se elimina un desarrollador (medico) a una categoría.
	 * 
	 * @deprecated
	 * @param int $userId
	 * @param int $categoryId
	 */
	public function removeUserToCategory($userId, $categoryId) {
		try {
			$query = str_replace ( '%userId%', $userId, getQuery ( 'removeUserToCategory' ) );
			$query = str_replace ( '%categoryId%', $categoryId, $query);
			$this->proxyMySql->query ( $query );
		} catch (Exception $e) {
		}
	}

	/**
	 * Salva la información necesaria para crear una incidencia. Se encarga
	 * de estructura la información de forma adecuada para poder almacenarla.
	 * 
	 * @param string $summary
	 * @param string $description
	 * @param string $projectId
	 * @return string $result
	 */
	public function saveIssueCreateData($summary, $description, $projectId, $specialistId, $paymentType) {
		$idData = 0;
		try {
			$data  = 'summary=' . $summary;
			$data .= "&description=" . $description;
			$data .= "&projectId=" . $projectId;
			$data .= "&specialistId=" . $specialistId;
			$data .= "&paymentType=" . $paymentType;
			$idData = $this->saveTempData($data);
		} catch (Exception $e) {
		}
		return $idData;
	}

	/**
	 * Salva la información en la tabla temporal del sistema.
	 * 
	 * @param string $data
	 */
	private function saveTempData($data) {
		$queryId = 0;
		try {
			$query = str_replace ( '%value%', $data, getQuery ( 'createTemporalData' ) );
			$result = $this->proxyMySql->query ( $query );
			if ($result == TRUE) {
				$queryId = $this->proxyMySql->insert_id;
			}
		} catch (Exception $e) {
		}
		return $queryId;
	}

	/**
	 * Obtiene la información existente en la tabla temporal del sistema.
	 * 
	 * @return string $result
	 */
	public function loadTempData($idData) {
		try {
			$query = str_replace ( '%idData%', $idData, getQuery ( 'getTemporalData' ) );
			$resultQuery = $this->proxyMySql->query ( $query );
			while ( $result = $resultQuery->fetch_object () ) {
				$result = $result->data;
				parse_str($result, $results);
			}
		} catch (Exception $e) {
		}
		return $results;
	}

	/**
	 * Elimina la información existente en la tabla temporal del sistema.
	 * 
	 * @param int $idData
	 */
	public function removeTempData($idData) {
		try {
			$query = str_replace ( '%idData%', $idData, getQuery ( 'removeTemporalData' ) );
			$resultQuery = $this->proxyMySql->query ( $query );
		} catch (Exception $e) {
		}
	}
	
	/**
	 * Envia mensajes al usuario una vez que ha sido creada la consulta
	 * con los datos de pago que ha enviado.
	 * 
	 * @param string $summary
	 * @param string $description
	 * @param int $projectId
	 * @param int $specialistId
	 * @param string $payName
	 * @param string $payPrice
	 * @param string $payTax
	 * @param string $payTotalAmount
	 */
	public function sendEmail($summary, $description, $projectId, $specialistId, $payName,
							$payPrice, $payTax, $payTotalAmount) {
		// se obtiene el nombre de la especialidad
		$project = $this->getProject($projectId);	
		// se obtiene el nombre del médico
		$specialist = $this->getUserById($specialistId);						
		// se obtienen las configuraciones generales de Joomla
		$config = JFactory::getConfig();
		// se obtienen los datos del usuario
		$user = JFactory::getUser();
		// se crean los campos principales del mensaje
		$from = $config->get( 'mailfrom' );
		$fromName = $config->get( 'fromname' );
		$recipient = $user->email;
		$subject = getValueIn('email_titleCreateConsult');
		// se crea el cuerpo del mensaje
		$body = getValueIn('email_bodyCreateConsult') . "\n";
		$body .= getValueIn('label_user') . ': ' . $user->username . "\n";
		$body .= getValueIn('label_service') . ': ' . $payName . "\n";
		$body .= getValueIn('label_speciality') . ': ' . $project->name . "\n";
		$body .= getValueIn('label_specialist') . ': ' . $specialist->realname . "\n";
		$body .= getValueIn('label_summary') . ': ' . $summary . "\n";
		$body .= getValueIn('label_description') . ': ' . $description . "\n";
		$body .= getValueIn('label_price') . ': ' . $payPrice . "\n";
		$body .= getValueIn('label_tax') . ': ' . $payTax . "\n";
		$body .= getValueIn('label_total_amount') . ': ' . $payTotalAmount . "\n\n";
		$body .= getValueIn('email_bodyFooter');
		// se envía el mensaje		
		JMail::getInstance()->sendMail($from, $fromName, $recipient, $subject, $body);
	}

	/**
	 * [attachments] =>
	 * stdClass Object (
	 * [id] => 1
	 * [filename] => hansel.pdf
	 * [size] => 51894
	 * [content_type] => application/pdf
	 * [date_submitted] => 2013-09-13T04:17:19-04:30
	 * [download_url] => http://localhost/cero/mninside/file_download.php?file_id=1&type=bug
	 * [user_id] => 2 )
	 */
	/**
	 * stdClass Object (
	 * [id] => 1
	 * [reporter] => stdClass Object (
	 * [id] => 2
	 * [name] => mmorejon
	 * [real_name] => Manuel Morejón Espinosa
	 * [email] => manuel.morejon.85@gmail.com )
	 * [text] => Se va a atender la solicitud.
	 * [view_state] => stdClass Object (
	 * [id] => 10
	 * [name] => público )
	 * [date_submitted] => 2013-09-13T01:09:57-04:30
	 * [last_modified] => 2013-09-13T01:09:57-04:30
	 * [time_tracking] => 0
	 * [note_type] => 0
	 * [note_attr] =>
	 */

	/**
	 * stdClass Object (
	 * [id] => 3
	 * [view_state] => stdClass Object (
	 * [id] => 10
	 * [name] => público )
	 * [last_updated] => 2013-09-11T02:28:24-04:30
	 * [project] => stdClass Object (
	 * [id] => 1
	 * [name] => Medicnexus )
	 * [category] => General
	 * [priority] => stdClass Object (
	 * [id] => 30
	 * [name] => normal )
	 * [severity] => stdClass Object (
	 * [id] => 50
	 * [name] => menor )
	 * [status] => stdClass Object (
	 * [id] => 50
	 * [name] => asignada )
	 * [reporter] => stdClass Object (
	 * [id] => 4
	 * [name] => marcos
	 * [real_name] => Marcos
	 * [email] => manuelminfo@gmail.com )
	 * [summary] => Tercera
	 * [reproducibility] => stdClass Object (
	 * [id] => 70
	 * [name] => no se ha intentado )
	 * [date_submitted] => 2013-09-11T02:28:24-04:30
	 * [sponsorship_total] => 0
	 * [handler] => stdClass Object (
	 * [id] => 2
	 * [name] => mmorejon
	 * [real_name] => Manuel Morejón Espinosa
	 * [email] => manuel.morejon.85@gmail.com )
	 * [projection] => stdClass Object (
	 * [id] => 10
	 * [name] => ninguna )
	 * [eta] => stdClass Object (
	 * [id] => 10
	 * [name] => ninguno )
	 * [resolution] => stdClass Object (
	 * [id] => 10
	 * [name] => abierta )
	 * [description] => Mi tercera incidencia.
	 * [attachments] => Array ( )
	 * [due_date] =>
	 * [monitors] => Array ( )
	 * [sticky] =>
	 * [tags] => Array ( ) )
	 */

	/**
	 * Obtiene todas funciones disponibles en el servicio web
	 */
	function getFunctions() {
		$arrayFunctions = $this->proxySoap->__getFunctions ();
		for($i = 0; $i < 64; $i ++) {
			print $arrayFunctions [$i];
			echo '<br>';
		}
	}
}
?>