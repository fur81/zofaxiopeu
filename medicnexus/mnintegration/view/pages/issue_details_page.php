<?php
$issueId = $_SESSION ['issueId'];
$issue = $mantisCore->getIssueById ( $issueId );
?>

<div id="client_zone">
	<!-- se agrega el encabezado con los proyectos -->
   <?php include_once $GLOBALS['MNI_PROJECTS_HEADER_ACTION'];?>

	<table width="100%" cellpadding="1" cellspacing="1" border="0"
		style="float: left;">
		<tr>
			<td colspan="4">
				<h1>Detalles de la Incidencia</h1>
			</td>
		</tr>
		<tr>
			<td width="20%"><label>Asignado a: </label></td>
			<td colspan="3"><?php echo $issue->handler->real_name;?></td>
		</tr>
		<tr>
			<td width="20%"><label>Especialidad: </label></td>
			<td colspan="3"><?php echo $issue->project->name;?></td>
		</tr>
		<tr>
			<td width="20%"><label>Resumen: </label></td>
			<td colspan="3"><?php echo $issue->summary;?></td>
		</tr>
		<tr>
			<td width="20%"><label>Descripción: </label></td>
			<td colspan="3"><?php echo $issue->description;?></td>
		</tr>
		<tr>
			<td><label>Adjuntos: </label></td>
			<form enctype="multipart/form-data" method="post" action="#">
				<td><input class="btn" type="file" id="fileAttached"
					name="fileAttached" /></td>
				<td colspan="2"><input class="btn" type="submit" name="uploadFile"
					value="Upload File"></td> <input type="hidden" name="issueAction"
					value="uploadAttachedAction"> <input type="hidden" name="flow"
					id="flow" value="detailsIssue" /> <input type="hidden"
					name="issueId" id="issueId" value="<?php echo $issueId;?>">
			</form>
		</tr>
	</table>

	<table>
	<?php
	for($i = 0; $i < count ( $issue->attachments ); $i ++) {
		?>
		<form method="post" action="#">
		<?php
		$attached = $issue->attachments [$i];
		echo '<b>' . substr ( $attached->date_submitted, 0, 10 ) . ' ';
		echo substr ( $attached->date_submitted, 12, 4 ) . ' </i></b>: ';
		?>
			<a href="#" onclick="parentNode.submit();return false;"><?php echo $attached->filename;?>
			</a> <input type="hidden" name="issueAction"
				value="downloadAttachedAction"> <input type="hidden"
				name="attachedId" value="<?php echo $attached->id;?>"> <input
				type="hidden" name="attachedFileName"
				value="<?php echo $attached->filename;?>"> <input type="hidden"
				name="flow" id="flow" value="detailsIssue" />
		</form>
		<?php
	}
	?>
	</table>

	<div align="left">

		<label><b>Adjuntos:</b> </label>
		<?php
		for($i = 0; $i < count ( $issue->attachments ); $i ++) {
			?>
		<form method="post" action="#">
		<?php
		$attached = $issue->attachments [$i];
		echo '<b>' . substr ( $attached->date_submitted, 0, 10 ) . ' ';
		echo substr ( $attached->date_submitted, 12, 4 ) . ' </i></b>: ';
		?>
			<a href="#" onclick="parentNode.submit();return false;"><?php echo $attached->filename;?>
			</a> <input type="hidden" name="issueAction"
				value="downloadAttachedAction"> <input type="hidden"
				name="attachedId" value="<?php echo $attached->id;?>"> <input
				type="hidden" name="attachedFileName"
				value="<?php echo $attached->filename;?>"> <input type="hidden"
				name="flow" id="flow" value="detailsIssue" />
		</form>
		<?php
		}
		?>

		<form enctype="multipart/form-data" method="post" action="#">
			<input class="btn" type="file" id="fileAttached" name="fileAttached" />
			<input class="btn" type="submit" name="uploadFile"
				value="Upload File"> <input type="hidden" name="issueAction"
				value="uploadAttachedAction"> <input type="hidden" name="flow"
				id="flow" value="detailsIssue" /> <input type="hidden"
				name="issueId" id="issueId" value="<?php echo $issueId;?>">
		</form>

		<label><b>Notas:</b> </label>
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
				<textarea name="noteTextArea" rows="3" style="width: 100%"></textarea>
				<input class="btn" type="submit" value="Adicionar Nota"
					title="Adicionar Nota" name="addNoteIssue" /> <input type="hidden"
					name="issueId" id="issueId" value="<?php echo $issueId;?>"> <input
					type="hidden" id="issueAction" name="issueAction"
					value="addIssueNoteAction"> <input type="hidden" name="flow"
					id="flow" value="detailsIssue" />
			</form>
		</div>
	</div>

</div>
