
<div id="client_zone_options">
	<div id="client_service_box" onclick="redirectToProject('<?php echo PROJECT_RAPID_CONSULTATION;?>')" 
    title="<?php getValue('label_project_rapid_consultation_title');?>"	style="cursor: pointer;">
        <?php 
        	$totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_RAPID_CONSULTATION);
        	//echo $totalIssueForRead;
        	
           	if (getProjectId() == PROJECT_RAPID_CONSULTATION) {
           		if ($totalIssueForRead > 0) {
					echo '<div class="service_icon" id="quick_consult_service_unread_icon_active"></div>';           			
           		}else {
	        		echo '<div class="service_icon" id="quick_consult_service_icon_active"></div>';
           		}
        	}else {
        		if ($totalIssueForRead > 0) {
        			echo '<div class="service_icon" id="quick_consult_service_unread_icon"></div>';
        		}else {
        			echo '<div class="service_icon" id="quick_consult_service_icon"></div>';
        		}
        	}
        ?>
		<h1>
		<?php 
			getValue('label_project_rapid_consultation_title');
			if ($totalIssueForRead > 0) {
				echo ' (' . $totalIssueForRead . ')';
			}
		?>
		</h1>
	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box" onclick="redirectToProject('<?php echo PROJECT_VIRTUAL_CONSULTATION;?>')"
			title="<?php getValue('label_project_virtual_consultation_title');?>"
			style="cursor: pointer;">
		<?php 
			$totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_VIRTUAL_CONSULTATION);
        	
           	if (getProjectId() == PROJECT_VIRTUAL_CONSULTATION) {
          	 	if ($totalIssueForRead > 0) {
					echo '<div class="service_icon" id="virtual_consult_service_unread_icon_active"></div>';           			
           		}else {
	        		echo '<div class="service_icon" id="virtual_consult_service_icon_active"></div>';
           		}
        	}else {
        		if ($totalIssueForRead > 0) {
        			echo '<div class="service_icon" id="virtual_consult_service_unread_icon"></div>';
        		}else {
        			echo '<div class="service_icon" id="virtual_consult_service_icon"></div>';
        		}
        	}
        ?>
		<h1>
		<?php 
			getValue('label_project_virtual_consultation_title');
			if ($totalIssueForRead > 0) {
				echo ' (' . $totalIssueForRead . ')';
			}
		?>
		</h1>

	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box" onclick="redirectToProject('<?php echo PROJECT_SECOND_OPINION;?>')"
			title="<?php getValue('label_project_second_opinion_title');?>"
			style="cursor: pointer;">
		<?php 
			$totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_SECOND_OPINION);
        	
           	if (getProjectId() == PROJECT_SECOND_OPINION) {
           		if ($totalIssueForRead > 0) {
					echo '<div class="service_icon" id="second_opinion_service_unread_icon_active"></div>';           			
           		}else {
	        		echo '<div class="service_icon" id="second_opinion_service_icon_active"></div>';
           		}
        	}else {
        		if ($totalIssueForRead > 0) {
        			echo '<div class="service_icon" id="second_opinion_service_unread_icon"></div>';
        		}else {
        			echo '<div class="service_icon" id="second_opinion_service_icon"></div>';
        		}
        	}
        ?>
        <h1>
		<?php 
			getValue('label_project_second_opinion_title');
			if ($totalIssueForRead > 0) {
				echo ' (' . $totalIssueForRead . ')';
			}
		?>
		</h1>

	</div>
	<div class="client_options_separator"></div>
	<div id="client_service_box" onclick="redirectToProject('<?php echo PROJECT_HEALTH_PROGRAM;?>')"
			title="<?php getValue('label_project_health_program_title');?>"
			style="cursor: pointer;">
			<?php 
			$totalIssueForRead = $mantisCore->getIssuesWithHistoryCount(PROJECT_HEALTH_PROGRAM);
        	
           	if (getProjectId() == PROJECT_HEALTH_PROGRAM) {
         	  	if ($totalIssueForRead > 0) {
					echo '<div class="service_icon" id="health_programs_service_unread_icon_active"></div>';           			
           		}else {
	        		echo '<div class="service_icon" id="health_programs_service_icon_active"></div>';
           		}
        	}else {
        		if ($totalIssueForRead > 0) {
        			echo '<div class="service_icon" id="health_programs_service_unread_icon"></div>';
        		}else {
        			echo '<div class="service_icon" id="health_programs_service_icon"></div>';
        		}
        	}
        ?>
        <h1>
		<?php 
			getValue('label_project_health_program_title');
			if ($totalIssueForRead > 0) {
				echo ' (' . $totalIssueForRead . ')';
			}
		?>
		</h1>
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