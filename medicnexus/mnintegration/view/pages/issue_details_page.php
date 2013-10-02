<?php
$issueId = $_SESSION ['issueId'];
$issue = $mantisCore->getIssueById ( $issueId );
?>
<?php 
$projectName = getProjectName();
echo '<h4>' . $projectName . '</h4>';
?>
<div align="left">
	<h4>Detalles de la Incidencia</h4>
	<div align="right">
		<fieldset>
			<table>
				<tr>
					<td>
						<form id="headersIssueForm" name="headersIssueForm" action="#"
							method="post">
							<input class="btn" type="submit" value="Ver Incidencias"
								title="Volver al Inicio" name="headersIssue"> <input
								type="hidden" name="flow" id="flow" value="headersIssue">
						</form>
					</td>
				</tr>
			</table>
		</fieldset>
	</div>
	<p>
		<label><b>Asignado a: </b></label><?php echo $issue->handler->real_name;?>
	</p>
	<p>
		<label><b>Especialidad: </b></label><?php echo $issue->project->name;?>
	</p>
	<p>
		<label><b>Resumen:</b></label><?php echo $issue->summary;?>
	</p>
	<p>
		<label><b>Descripción:</b></label><?php echo $issue->description;?>
	</p>
	<label><b>Adjuntos:</b></label>
	<?php
	for($i = 0; $i < count ( $issue->attachments ); $i ++) {
		?>
		<form method="post" action="#">
		<?php 
		$attached = $issue->attachments [$i];
		echo '<b>' . substr ( $attached->date_submitted, 0, 10 ) . ' ';
		echo substr ( $attached->date_submitted, 12, 4 ) . ' </i></b>: ';
		?>
			<a href="#" onclick="parentNode.submit();return false;"><?php echo $attached->filename;?></a>
			<input type="hidden" name="issueAction" value="downloadAttachedAction">
			<input type="hidden" name="attachedId" value="<?php echo $attached->id;?>">
			<input type="hidden" name="attachedFileName" value="<?php echo $attached->filename;?>">	
			<input type="hidden" name="flow" id="flow" value="detailsIssue" />
		</form>
		<?php 
	}
	?>
	
	<form enctype="multipart/form-data" method="post" action="#">
		<input class="btn" type="file" id="fileAttached"  name="fileAttached"/>
		<input class="btn" type="submit" name="uploadFile" value="Upload File">
		<input type="hidden" name="issueAction" value="uploadAttachedAction">
		<input type="hidden" name="flow" id="flow" value="detailsIssue" />
		<input type="hidden" name="issueId" id="issueId" value="<?php echo $issueId;?>">
	</form>
	
	<label><b>Notas:</b></label>
	<?php
	for($i = 0; $i < count ( $issue->notes ); $i ++) {
		$note = $issue->notes [$i];
		// solo se muestran las notas públicas
		if ($note->view_state->id == 10) { 
			echo '<b>' . substr ( $note->date_submitted, 0, 10 ) . ' ';
			echo substr ( $note->date_submitted, 12, 4 ) . ' ';
			echo '<i>' . $note->reporter->real_name . '</i></b>: ';
			echo $note->text . '<br>';
		}
	}
	?>
	<div align="right">
		<form id="addNoteIssueForm" name="addNoteIssueForm" action="#"
			method="post">
			<textarea name="noteTextArea" rows="3"
				style="width: 100%"></textarea>
			<input class="btn" type="submit" value="Adicionar Nota"
				title="Adicionar Nota" name="addNoteIssue" /> <input type="hidden"
				name="issueId" id="issueId" value="<?php echo $issueId;?>"> <input
				type="hidden" id="issueAction" name="issueAction"
				value="addIssueNoteAction"> <input type="hidden" name="flow"
				id="flow" value="detailsIssue" />
		</form>
	</div>
</div>