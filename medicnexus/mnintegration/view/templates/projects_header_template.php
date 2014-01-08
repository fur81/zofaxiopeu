
<div id="client_zone_options">
	<div id="client_service_box" onclick="redirectToProject('<?php echo PROJECT_RAPID_CONSULTATION;?>')" 
    title="<?php getValue('label_project_rapid_consultation_title');?>"	style="cursor: pointer;">
        <?php 
           	if (getProjectId() == PROJECT_RAPID_CONSULTATION) {
        		echo '<div id="quick_consult_service_icon_active"></div>';
        	}else {
        		echo '<div id="quick_consult_service_icon"></div>';
        	}
        ?>
		<h1><?php getValue('label_project_rapid_consultation_title');?></h1>
	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box" onclick="redirectToProject('<?php echo PROJECT_VIRTUAL_CONSULTATION;?>')"
			title="<?php getValue('label_project_virtual_consultation_title');?>"
			style="cursor: pointer;">
		<?php 
           	if (getProjectId() == PROJECT_VIRTUAL_CONSULTATION) {
        		echo '<div id="virtual_consult_service_icon_active"></div>';
        	}else {
        		echo '<div id="virtual_consult_service_icon"></div>';
        	}
        ?>
		<h1><?php getValue('label_project_virtual_consultation_title');?></h1>

	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box" onclick="redirectToProject('<?php echo PROJECT_SECOND_OPINION;?>')"
			title="<?php getValue('label_project_second_opinion_title');?>"
			style="cursor: pointer;">
		<?php 
           	if (getProjectId() == PROJECT_SECOND_OPINION) {
        		echo '<div id="second_opinion_service_icon_active"></div>';
        	}else {
        		echo '<div id="second_opinion_service_icon"></div>';
        	}
        ?>
		<h1><?php getValue('label_project_second_opinion_title');?></h1>

	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box" onclick="redirectToProject('<?php echo PROJECT_HEALTH_PROGRAM;?>')"
			title="<?php getValue('label_project_health_program_title');?>"
			style="cursor: pointer;">
		<img src="images/medicnexus/home/health_programs_service_icon.gif"
			name="health_programs_service_icon" width="50" height="45" border="0" id="health_programs_service_icon"
			alt="<?php getValue('label_project_health_program_title');?>"/>
		<h1><?php getValue('label_project_health_program_title');?></h1>
	</div>
</div>
<div id="client_options_divider"></div>

<!-- formulario para obtener las incidencias de un reporte -->
<form id="headersIssueForm" name="headersIssueForm" action="#" method="post">
	<input type="hidden" name="flow" id="flow" value="headersIssue"> <input type="hidden"
	id="projectId" name="projectId"><input type="hidden" id="issueAction" name="issueAction" 
	value="projectSelectionAction">
</form>

<!-- script para pasar el id del proyecto y obtener las incidencias -->
<script type="text/javascript">
	function redirectToProject(projectId)
	{
		document.getElementById('projectId').value = projectId;
		document.forms["headersIssueForm"].submit();
	}
</script>