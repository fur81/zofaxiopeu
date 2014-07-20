<?php
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Plantilla para establecer el encabezado de proyecto que visualiza
 * el usuario registrado. Se muestran los proyectos y la cantidad de 
 * consultas que le faltan por revisar.
 * 
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 * 
 */


/**
 * Muestra la imagen correspondiente al estado actual del proyecto.
 * 
 * @param int $projectId
 * @param string $serviceTypeName
 * @param string $textLabel
 */
function showImageHeader($projectId, $serviceTypeName, $textLabel, $totalIssueForRead) {
	$unread = '';
	$value = '';
	if ($totalIssueForRead > 0) {
		$unread = '_unread';
		$value = ' (' . $totalIssueForRead . ')';
	}
	$active = '';
	if (getProjectId() == $projectId) {
		$active = '_active';
	}
	echo '<div class="service_icon" id="'. $serviceTypeName .'_service'. $unread .'_icon'. $active .'">
		<span class="title_client_zone_menu">';
	getValue($textLabel); echo $value;
	echo '</span></div>';
}
?>

<div id="client_zone_options">
	<div class="client_service_box_cz"
		onclick="redirectToProject('<?php echo PROJECT_RAPID_CONSULTATION;?>')"
		title="<?php getValue('label_project_rapid_consultation_title');?>"
		style="cursor: pointer;">
		<?php if ( getProjectId() == PROJECT_RAPID_CONSULTATION || !isset($_SESSION['project_rapid_consultation'])): ?>
			<?php $totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_RAPID_CONSULTATION); ?>
			<?php $_SESSION['project_rapid_consultation'] = $totalIssueForRead;?>
		<?php endif;?>
		<?php showImageHeader(PROJECT_RAPID_CONSULTATION, 'quick_consult', 
				'label_project_rapid_consultation_title', $_SESSION['project_rapid_consultation']);?>
	</div>
	<div class="client_options_separator"></div>
	<div class="client_service_box_cz"
		onclick="redirectToProject('<?php echo PROJECT_VIRTUAL_CONSULTATION;?>')"
		title="<?php getValue('label_project_virtual_consultation_title');?>"
		style="cursor: pointer;">
		<?php if ( getProjectId() == PROJECT_VIRTUAL_CONSULTATION || !isset($_SESSION['project_virtual_consultation'])): ?>
			<?php $totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_VIRTUAL_CONSULTATION);?>
			<?php $_SESSION['project_virtual_consultation'] = $totalIssueForRead;?>
		<?php endif;?>		
		<?php showImageHeader(PROJECT_VIRTUAL_CONSULTATION, 'virtual_consult',
				'label_project_virtual_consultation_title', $_SESSION['project_virtual_consultation']);?>
	</div>
	<div class="client_options_separator"></div>
	<div class="client_service_box_cz"
		onclick="redirectToProject('<?php echo PROJECT_SECOND_OPINION;?>')"
		title="<?php getValue('label_project_second_opinion_title');?>"
		style="cursor: pointer;">
		<?php if ( getProjectId() == PROJECT_SECOND_OPINION || !isset($_SESSION['project_second_opinion'])): ?>
			<?php $totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_SECOND_OPINION);?>
			<?php $_SESSION['project_second_opinion'] = $totalIssueForRead;?>
		<?php endif;?>		
		<?php showImageHeader(PROJECT_SECOND_OPINION, 'second_opinion',
				'label_project_second_opinion_title', $_SESSION['project_second_opinion']);?>
	</div>
	<div class="client_options_separator"></div>
	<div class="client_service_box_cz"
		onclick="redirectToProject('<?php echo PROJECT_HEALTH_PROGRAM;?>')"
		title="<?php getValue('label_project_health_program_title');?>"
		style="cursor: pointer;">
		<?php if ( getProjectId() == PROJECT_HEALTH_PROGRAM || !isset($_SESSION['project_health_program'])): ?>
			<?php $totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_HEALTH_PROGRAM);?>
			<?php $_SESSION['project_health_program'] = $totalIssueForRead;?>
		<?php endif;?>
		<?php showImageHeader(PROJECT_HEALTH_PROGRAM, 'health_programs',
				'label_project_health_program_title', $_SESSION['project_health_program']);?>
	</div>
</div>
<div id="client_options_divider"></div>

<!-- formulario para obtener las incidencias de un reporte -->
<form id="headersIssueForm" name="headersIssueForm" action="#"
	method="post">
	<input type="hidden" name="flow" id="flow" value="headersIssue"> <input
		type="hidden" id="projectId" name="projectId"><input type="hidden"
		id="issueAction" name="issueAction" value="projectSelectionAction">
</form>

<!-- script para pasar el id del proyecto y obtener las incidencias -->
<script type="text/javascript">
	function redirectToProject(projectId)
	{
		document.getElementById('projectId').value = projectId;
		document.forms["headersIssueForm"].submit();
	}
</script>
