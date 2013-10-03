<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/medicnexus/mnintegration/src/core/configuration.php';
include_once $GLOBALS ['MNI_CORE'];
include_once $GLOBALS ['MNI_UTILS'];
$mantisCore = new MantisCore ();

$mantisCore->login ( $GLOBALS ['CURRENT_USERNAME'], $GLOBALS ['CURRENT_USERFULLNAME'], $GLOBALS ['CURRENT_USEREMAIL'] );
//$mantisCore->getFunctions ();

// se identifica la acción que será realizada
if (isset ( $_POST ['flow'] )) {
	
	// se establece el flujo en la sessión
	$_SESSION ['flow'] = $_POST ['flow'];
	
	// se define la acción
	if (isset ( $_POST ['issueAction'] )) {
		switch ($_POST ['issueAction']) {
			case 'detailsIssueAction' :
				// detalles de una incidencia
				include_once $GLOBALS ['MNI_ISSUE_DETAILS_ACTION'];
				break;
			
			case 'createIssueAction' :
				// adicionar una nueva incidencia
				include_once $GLOBALS ['MNI_ISSUE_CREATE_ACTION'];
				break;
			
			case 'addIssueNoteAction' :
				// adicionar una nueva nota a la incidencia
				include_once $GLOBALS ['MNI_ISSUE_ADD_NOTE_ACTION'];
				break;
			
			case 'downloadAttachedAction' :
				// descarga un fichero
				include_once $GLOBALS ['MNI_ATTACHED_DOWNLOAD_ACTION'];
				break;
			
			case 'uploadAttachedAction' :
				// cargar un fichero
				include_once $GLOBALS ['MNI_ATTACHED_UPLOAD_ACTION'];
				break;
				
			case 'subprojectSelectionAction' :
				// cargar un fichero
				include_once $GLOBALS ['MNI_SUBPROJECT_SELECTION_ACTION'];
				break;
			
			case 'projectSelectionAction' :
				// seleccionar un proyecto
				include_once $GLOBALS ['MNI_PROJECT_SELECTION_ACTION'];
				break;
		}
	}
	
	unset ( $_POST ['flow'] );
	unset ( $_POST ['issueAction'] );
	header ( 'Location: #' );
	exit ();
} 

// se identifica la vista que será mostrada
else if (isset ( $_SESSION ['flow'] )) {
	
	switch ($_SESSION ['flow']) {
		case 'headersIssue' :
			// para ver los encabezados de las incidencias
			include_once $GLOBALS ['MNI_ISSUES_HEADER'];
			break;
		
		case 'detailsIssue' :
			// para ver los detalles de una incidencia
			include_once $GLOBALS ['MNI_ISSUE_DETAILS'];
			break;
		
		case 'addIssue' :
			// para adicionar una nueva incidencia
			include_once $GLOBALS ['MNI_ISSUE_ADD'];
			break;
		
		default:
			// para ver los encabezados de las incidencias
			include_once $GLOBALS ['MNI_ISSUES_WELCOME'];
			break;
	}
	
} else {
	// para ver los encabezados de las incidencias
	include_once $GLOBALS ['MNI_ISSUES_WELCOME'];
}
?>