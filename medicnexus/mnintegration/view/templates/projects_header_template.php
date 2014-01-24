<?php
/**
 * Muestra la imagen correspondiente al estado actual del proyecto.
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
	<div id="client_service_box"
		onclick="redirectToProject('<?php echo PROJECT_RAPID_CONSULTATION;?>')"
		title="<?php getValue('label_project_rapid_consultation_title');?>"
		style="cursor: pointer;">
		<?php
		$totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_RAPID_CONSULTATION);
		showImageHeader(PROJECT_RAPID_CONSULTATION, 'quick_consult',
				'label_project_rapid_consultation_title', $totalIssueForRead);
		?>
	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box"
		onclick="redirectToProject('<?php echo PROJECT_VIRTUAL_CONSULTATION;?>')"
		title="<?php getValue('label_project_virtual_consultation_title');?>"
		style="cursor: pointer;">
		<?php
		$totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_VIRTUAL_CONSULTATION);
		showImageHeader(PROJECT_VIRTUAL_CONSULTATION, 'virtual_consult',
				'label_project_virtual_consultation_title', $totalIssueForRead);
		?>
	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box"
		onclick="redirectToProject('<?php echo PROJECT_SECOND_OPINION;?>')"
		title="<?php getValue('label_project_second_opinion_title');?>"
		style="cursor: pointer;">
		<?php
		$totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_SECOND_OPINION);
		showImageHeader(PROJECT_SECOND_OPINION, 'second_opinion',
				'label_project_second_opinion_title', $totalIssueForRead);
		?>
	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box"
		onclick="redirectToProject('<?php echo PROJECT_HEALTH_PROGRAM;?>')"
		title="<?php getValue('label_project_health_program_title');?>"
		style="cursor: pointer;">
		<?php
		$totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_HEALTH_PROGRAM);
		showImageHeader(PROJECT_HEALTH_PROGRAM, 'health_programs',
				'label_project_health_program_title', $totalIssueForRead);
		?>
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
