<?php
// se obtinen todas los encabezados de las incidencias del usuario registrado.
$issuesByUser = $mantisCore->getIssueHeaders ();
?>

<div id="client_zone">
        
	<!-- se incluye el encabezado con los proyectos -->
	<?php include_once $GLOBALS['MNI_PROJECTS_HEADER_ACTION'];?>

	<h1 align="left">
	<?php echo getProjectName(); echo ' - '; getValue('label_reports');?>
	</h1>
	<div id="issue_report" onclick="redirectToAddIssue()">
		<ul>
			<li><a><?php getValue('label_report_consultation');?> </a>
			</li>
			<li><img src="images/medicnexus/client/add_img.gif" border="0" />
			</li>
		</ul>
	</div>
	
	<table width="100%" cellpadding="1" cellspacing="1"
		style="float: left;">
		<tr class="managed-table-th">
			<td width="20%" align="left"><h1>
			<?php getValue('label_lastUpdate');?>
				</h1></td>
			<td><h1>
			<?php getValue('label_summary');?>
				</h1></td>
			<td width="25%" align="left"><h1>
			<?php getValue('label_speciality');?>
				</h1></td>
			<td width="10%" align="left"><h1>
			<?php getValue('label_attached');?>
				</h1></td>
			<td width="10%" align="left"><h1>
			<?php getValue('label_notes');?>
				</h1></td>
		</tr>
		<?php
		for($i = 0; $i < count ( $issuesByUser ); $i ++) {
			$issue = $issuesByUser [$i];
			$issueProject = $mantisCore->getProject($issue->project);
			$totalHistoriesBugTag = $mantisCore->getHistoiesBugTag($issue->id);
			$isIssueRead = TRUE;
			if (bcmod($totalHistoriesBugTag, 2) != 0) {
				$isIssueRead = FALSE;
			}
			if ($i % 2 == 0) {
				?>
		<tr class="managed-table-tr" onclick="data(<?php echo $issue->id;?>)"
			style="cursor: pointer;">
			<?php } else {?>
		
		
		<tr class="managed-table-tr-alternate"
			onclick="data(<?php echo $issue->id;?>)" style="cursor: pointer;">
			<?php }?>
			<td><?php if (!$isIssueRead) {
				echo '<strong>' . getDateFormat($issue->last_updated) . '</strong>';
			} else { echo getDateFormat($issue->last_updated);}?>
			</td>
			<td><?php if (!$isIssueRead) { echo '<strong>' . $issue->summary . '</strong>';}
					else {echo $issue->summary;}?>
			</td>
			<td><?php if (!$isIssueRead) { echo '<strong>' . getValueByString($issueProject->name) . '</strong>';}
					else {getValueByString($issueProject->name);}?>
			</td>
			<td align="center"><?php if (!$isIssueRead) { echo '<strong>' . $issue->attachments_count . '</strong>';}
							else {echo $issue->attachments_count;}?>
			</td>
			<td align="center"><?php if (!$isIssueRead) { echo '<strong>' . $issue->notes_count . '</strong>' ;}
						else {echo $issue->notes_count;}?>
			</td>
		</tr>
		<?php
		}
		if (count ( $issuesByUser ) == 0) {
			?>
		<tr class="empty-data-table">
			<td colspan="5"><i><?php getValue('label_empty_list');?> </i></td>
		</tr>
		<?php
		}
		?>

	</table>
	<div id="issue_report" onclick="redirectToAddIssue()">
		<ul>
			<li><a><?php getValue('label_report_consultation');?> </a>
			</li>
			<li><img src="images/medicnexus/client/add_img.gif" border="0" />
			</li>
		</ul>
	</div>
</div>

<!-- formularios para activar las opciones del panel -->
<form id="addIssueForm" name="addIssueForm" action="#" method="post">
	<input type="hidden" name="flow" id="flow" value="addIssue">
</form>

<form id="detailsForm" name="detailsForm" action="#" method="post">
	<input type="hidden" name="issueId" id="issueId"> <input type="hidden"
		name="flow" id="flow" value="detailsIssue"><input type="hidden"
		id="issueAction" name="issueAction" value="detailsIssueAction">
</form>

<!-- scripts  -->
<script type="text/javascript">
function data(id){
	document.detailsForm.issueId.value = id;
	document.forms["detailsForm"].submit();
}

function redirectToAddIssue() {
	document.forms["addIssueForm"].submit();
}
</script>
