<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/medicnexus/mnintegration/src/core/configuration.php';
include_once $GLOBALS ['MNI_CORE'];
include_once $GLOBALS ['MNI_UTILS'];
$mantisCore = new MantisCore ();

$mantisCore->login ( $GLOBALS ['CURRENT_USERNAME'], $GLOBALS ['CURRENT_USERFULLNAME'], $GLOBALS ['CURRENT_USEREMAIL'] );

// se identifica la acción que será realizada
if (isset ( $_POST ['flow'] )) {
	
	// se establece el flujo en la sessión
	$_SESSION ['flow'] = $_POST ['flow'];
	
	// se define la acción
	if (isset ( $_POST ['issueAction'] )) {
		switch ($_POST ['issueAction']) {
			case 'addUserCategoryAction' :
				// se adiciona una categoria de usuario
				include_once $GLOBALS ['MNI_USER_CATEGORY_ADD_ACTION'];
				break;
			
			case 'removeUserCategoryAction' :
				// se elimina una categoria de usuario
				include_once $GLOBALS ['MNI_USER_CATEGORY_REMOVE_ACTION'];
				break;
			
			case 'selectUserCategoryAction' :
				// se selecciona una categoria de usuario
				include_once $GLOBALS ['MNI_USER_CATEGORY_SELECTION_ACTION'];
				break;
				
			case 'addUserCategoryRelationAction' :
				// se adiciona un usuario a una categoria
				include_once $GLOBALS ['MNI_USER_CATEGORY_ADD_RELATION_ACTION'];
				break;
				
			case 'removeUserCategoryRelationAction' :
				// se elimina un usuario a una categoria
				include_once $GLOBALS ['MNI_USER_CATEGORY_REMOVE_RELATION_ACTION'];
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
		
		case 'userCategoryList' :
			include_once $GLOBALS ['MNI_USER_CATEGORY_LIST'];
			break;
		
		case 'userCategoryAssignment' :
			include_once $GLOBALS ['MNI_USER_CATEGORY_ASSIGNMENT'];
			break;
		
		default :
			include_once $GLOBALS ['MNI_MANAGEMENT_WELCOME'];
			break;
	}
} else {
	include_once $GLOBALS ['MNI_MANAGEMENT_WELCOME'];
}
?>