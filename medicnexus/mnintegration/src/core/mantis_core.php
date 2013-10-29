<?php
include_once $GLOBALS ['MNI_CONNECTION'];

/**
 * Class to manage all services related with Mantis.
 * bug tracker.
 *
 * @author Manuel Morejón
 *
 */
class MantisCore {
	private $currentUser;
	private $currentPassword;
	private $proxySoap;
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
	 * Se obtiene la opción de mantis.
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
	 * Se establece el usuario actual que va a consumir los servicios.
	 *
	 * @param string $username
	 */
	public function login($username, $realname, $email) {
		$this->currentUser = "z_" . $username;
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

				// se adiciona el usuario al proyecto por defecto
				// $this->addAccountToProject (PROJECT_1);
				// $this->addAccountToProject (PROJECT_2);
				// $this->addAccountToProject (PROJECT_3);
			}
		} catch ( Exception $e ) {
		}
	}

	/**
	 * Busca si existe un nombre de usuario.
	 *
	 * @param string $username
	 * @return boolean
	 */
	private function existAccountByUsername($username) {
		// se obtienen todos los usuario
		try {
			$exist = false;
			$query = str_replace ( '%value%', '"' . $username . '"', getQuery ( 'findAccountByUsername' ) );
			$result = $this->proxyMySql->query ( $query );
			if ($result->fetch_object ()) {
				$exist = true;
			}
		} catch ( Exception $e ) {
		}
		return $exist;
	}

	/**
	 * Se adiciona el usuario registrado al proyecto por defecto.
	 */
	private function addAccountToProject($projectId) {
		try {
			// se obtiene el identificador del usuario
			$userData = $this->proxySoap->mc_login ( $this->currentUser, $this->currentPassword );
			$idUser = $userData->account_data->id;

			// se inserta en la base de datos
			$values = $projectId . ',' . $idUser . ',' . MANTIS_INFORMER_ACCESS;
			$query = str_replace ( '%values%', $values, getQuery ( 'addAccountToProject' ) );
			$this->proxyMySql->query ( $query );
		} catch ( Exception $e ) {
		}
	}

	/**
	 * Pregunta si existe una incidencia a partir del identificador.
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
	 * Se obtiene la descripcion completa de las incidencias del usuario registrado.
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
	public function addIssue($summary, $description, $projectId) {
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
			$issueNote = new stdClass ();
			$issueNote->text = $issueNoteData;
			$result = $this->proxySoap->mc_issue_note_add ( $this->currentUser, $this->currentPassword, $issueId, $issueNote );
		} catch ( Exception $e ) {
		}
		return $result;
	}

	/**
	 * Se obtiene un adjunto a partir de su identificador.
	 *
	 * @param int $issueAttachmentId
	 * @return
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
		$retult = '';
		try {
			$retult = $this->proxySoap->mc_issue_attachment_add ( $this->currentUser, $this->currentPassword, $issueId, $name, $fileType, $content );
		} catch ( Exception $e ) {
		}
		return $retult;
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
			$project = new stdClass();
			while ( $data = $result->fetch_object () ) {
				$project->id = $projectId;
				$project->name = $data->name;	
			}
		} catch (Exception $e) {
		}
		return $project;
	}

	/**
	 * Se obtienen los sub proyectos asociados a un proyecto a partir del identificador
	 * del proyecto padre.
	 * @param int $projectId
	 * @return array
	 */
	public function getSubProjects() {
		$retult = '';
		try {
			$retult = $this->proxySoap->mc_project_get_all_subprojects( $this->currentUser, $this->currentPassword, getProjectId());
		} catch (Exception $e) {
		}
		return $retult;
	}
	
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
				$user->realname = $data->realname;
				$users->append($user);
			}
		} catch (Exception $e) {
		}
		return $users;
	}

	/**
	 * Se listan todas las categorías pertenecientes al proyecto seleccionado.
	 *
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
				$category->name = $data->name;
				$categories->append ( $category );
			}
		} catch ( Exception $e ) {
		}
		return $categories;
	}

	/**
	 * Se elimina una categoria de usuario
	 *
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
	 * a una categoría pasada por parámetro
	 *
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
				$user->realname = $data->realname;
				$users->append ( $user );
			}
		} catch (Exception $e) {
		}
		return $users;
	}

	/**
	 * Se obtienen todos los desarrolladores (medicos) que no están asignados
	 * a una categoría pasada por parámetro
	 *
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
				$user->realname = $data->realname;
				$users->append ( $user );
			}
		} catch (Exception $e) {
		}
		return $users;
	}

	/**
	 * Se adiciona un desarrollador (medico) a una categoría
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
	 * Se elimina un desarrollador (medico) a una categoría
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
	 * Salva la información necesaria para crear una incidencia.
	 * @param string $summary
	 * @param string $description
	 * @param string $projectId
	 * @return string $result
	 */
	public function saveIssueCreateData($summary, $description, $projectId) {
		$idData = 0;
		try {
			$data  = 'summary=' . $summary;
			$data .= "&description=" . $description;
			$data .= "&projectId=" . $projectId;
			$idData = $this->saveTempData($data);
		} catch (Exception $e) {
		}
		return $idData;
	}
	
	/**
	 * Salva la información en la tabla temporal del sistema
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
	 * Obtiene la información existente en la tabla temporal del sistema
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
	
	public function removeTempData($idData) {
		try {
			$query = str_replace ( '%idData%', $idData, getQuery ( 'removeTemporalData' ) );
			$resultQuery = $this->proxyMySql->query ( $query );
		} catch (Exception $e) {
		}
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