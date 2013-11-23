<?php
// se obtinen todas los encabezados de las incidencias del usuario registrado.
$issuesByUser = $mantisCore->getIssueHeaders ();
?>

<div id="client_zone">
	<!-- se incluye el encabezado con los proyectos -->
	<?php include_once $GLOBALS['MNI_PROJECTS_HEADER_ACTION'];?>

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
			<td width="130px" align="left"><h1>
			<?php getValue('label_lastUpdate');?>
				</h1></td>
			<td><h1>
			<?php getValue('label_summary');?>
				</h1></td>
			<td width="110px" align="left"><h1>
			<?php getValue('label_speciality');?>
				</h1></td>
			<td width="50px" align="left"><h1>
			<?php getValue('label_attached');?>
				</h1></td>
			<td width="50px" align="left"><h1>
			<?php getValue('label_notes');?>
				</h1></td>
		</tr>
		<?php
		for($i = 0; $i < count ( $issuesByUser ); $i ++) {
			$issue = $issuesByUser [$i];
			$issueProject = $mantisCore->getProject($issue->project);
			if ($i % 2 == 0) {
				?>
		<tr class="managed-table-tr" onclick="data(<?php echo $issue->id;?>)">
		<?php } else {?>
		
		
		<tr class="managed-table-tr-alternate"
			onclick="data(<?php echo $issue->id;?>)">
			<?php }?>
			<td><?php echo substr($issue->last_updated, 0, 10);?>
			</td>
			<td><?php echo $issue->summary;?>
			</td>
			<td><?php echo $issueProject->name;?>
			</td>
			<td align="center"><?php echo $issue->attachments_count;?>
			</td>
			<td align="center"><?php echo $issue->notes_count;?>
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
