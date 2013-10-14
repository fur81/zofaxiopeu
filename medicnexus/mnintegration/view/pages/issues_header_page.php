<?php
// se obtinen todas los encabezados de las incidencias del usuario registrado.
$issuesByUser = $mantisCore->getIssueHeaders ();
?>
<script>
function data(id){
	document.detailsForm.issueId.value = id;
	document.forms["detailsForm"].submit();
}
</script>
<table style="width: 100%;">
	<tr align="center">
		<td>
			<form id="headersIssueForm" name="headersIssueForm" action="#"
				method="post">
				<input class="btn" type="submit" value="Consulta Rápida"
					title="Segunda Opinión" name="headersIssue"> <input type="hidden"
					name="flow" id="flow" value="headersIssue"> <input type="hidden"
					id="projectId" name="projectId" value="<?php echo PROJECT_RAPID_CONSULTATION;?>"><input
					type="hidden" id="issueAction" name="issueAction"
					value="projectSelectionAction">
			</form>
		</td>
		<td>
			<form id="headersIssueForm" name="headersIssueForm" action="#"
				method="post">
				<input class="btn" type="submit" value="Segunda Opinión"
					title="Segunda Opinión" name="headersIssue"> <input type="hidden"
					name="flow" id="flow" value="headersIssue"> <input type="hidden"
					id="projectId" name="projectId" value="<?php echo PROJECT_SECOND_OPINION;?>"><input
					type="hidden" id="issueAction" name="issueAction"
					value="projectSelectionAction">
			</form>
		</td>
		<td>
			<form id="headersIssueForm" name="headersIssueForm" action="#"
				method="post">
				<input class="btn" type="submit" value="Consulta Virtual"
					title="Consulta Virtual" name="headersIssue"> <input type="hidden"
					name="flow" id="flow" value="headersIssue"> <input type="hidden"
					id="projectId" name="projectId" value="<?php echo PROJECT_VIRTUAL_CONSULTATION;?>"><input
					type="hidden" id="issueAction" name="issueAction"
					value="projectSelectionAction">
			</form>
		</td>
		<td>
			<form id="headersIssueForm" name="headersIssueForm" action="#"
				method="post">
				<input class="btn" type="submit" value="Programa de salud"
					title="Programa de salud" name="headersIssue"> <input type="hidden"
					name="flow" id="flow" value="headersIssue"> <input type="hidden"
					id="projectId" name="projectId" value="<?php echo PROJECT_HEALTH_PROGRAM;?>"><input
					type="hidden" id="issueAction" name="issueAction"
					value="projectSelectionAction">
			</form>
		</td>
	</tr>
</table>
<table style="width: 100%;">
	<tr align="right">
		<td>
			<form id="addIssueForm" name="addIssueForm" action="#" method="post">
				<fieldset>
					<input class="btn" type="submit" value="Reportar Incidencia"
						title="Adicionar Incidencia" name="addIssue"> <input type="hidden"
						name="flow" id="flow" value="addIssue">
				</fieldset>
			</form>
		</td>
	</tr>
</table>
<?php 
$projectName = getProjectName();
echo '<h4>' . $projectName . '</h4>';
?>
<table style="width: 100%;">
	<tr>
		<td class="article-info-term" style="width: 7%;"><h5>
		<?php getValue('label_lastUpdate');?>
			</h5></td>
		<td style="width: 10%;"><h5>
		<?php getValue('label_summary');?>
			</h5></td>
		<td style="width: 10%;"><h5>Especialidad</h5></td>
		<td style="width: 15%;"><h5>Numero de Adjuntos</h5></td>
		<td style="width: 15%;"><h5>Numero de Notas</h5></td>
	</tr>
	<?php
	for($i = 0; $i < count ( $issuesByUser ); $i ++) {
		$issue = $issuesByUser [$i];
		$issueProject = $mantisCore->getProject($issue->project);
		?>
	<tr>
		<td align="left"><h6>
		<?php echo substr($issue->last_updated, 0, 10);?>
			</h6></td>
		<td align="left"><h6>
				<a href="#" onclick="data(<?php echo $issue->id;?>)"><?php echo $issue->summary;?>
				</a>
			</h6></td>
		<td align="left"><h6>
		<?php echo $issueProject->name;?>
			</h6></td>
		<td align="left"><h6>
		<?php echo $issue->attachments_count;?>
			</h6></td>
		<td align="left"><h6>
		<?php echo $issue->notes_count;?>
			</h6></td>
	</tr>
	<?php
	}
	?>
</table>
<form id="detailsForm" name="detailsForm" action="#" method="post">
	<input type="hidden" name="issueId" id="issueId"> <input type="hidden"
		name="flow" id="flow" value="detailsIssue"><input type="hidden"
		id="issueAction" name="issueAction" value="detailsIssueAction">
</form>
