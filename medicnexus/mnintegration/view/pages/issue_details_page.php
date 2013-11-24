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
				<h3>
				<?php getValue('label_consultation_details');?>
				</h3>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="right"><a onclick="redirectToBack()"
				style="cursor: pointer;"><?php getValue('label_back');?> </a>
			</td>
		</tr>
		<tr>
			<td width="15%"><label><?php getValue('label_assigned_to');?>:</label>
			</td>
			<td colspan="3" class="client_data"><?php echo $issue->handler->real_name;?>
			</td>
		</tr>
		<tr>
			<td><label><?php getValue('label_speciality');?>:</label></td>
			<td colspan="3" class="client_data"><?php echo $issue->project->name;?>
			</td>
		</tr>
		<tr>
			<td><label><?php getValue('label_summary');?>:</label></td>
			<td colspan="3" class="client_data"><?php echo $issue->summary;?></td>
		</tr>
		<tr>
			<td><label><?php getValue('label_description');?>:</label></td>
			<td colspan="3" class="client_data"><?php echo $issue->description;?>
			</td>
		</tr>
		<tr>
			<td><label><?php getValue('label_attached');?>:</label></td>
			<td width="50%">
				<form enctype="multipart/form-data" method="post" action="#">
					<input class="btn" type="file" id="fileAttached"
						name="fileAttached" /><input type="hidden" name="issueAction"
						value="uploadAttachedAction"> <input type="hidden" name="flow"
						id="flow" value="detailsIssue" /> <input type="hidden"
						name="issueId" id="issueId" value="<?php echo $issueId;?>"> <input
						class="btn-client" type="submit" name="uploadFile"
						value="<?php getValue('label_upload_file');?>">
				</form>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<div id="attachment_info">
					<table width="100%" cellpadding="1" cellspacing="1"
						style="float: left;">
						<tr align="left" class="managed-table-th">
							<td width="15%">
								<h1>
								<?php getValue('label_upload_date');?>
								</h1>
							</td>
							<td>
								<h1>
								<?php getValue('label_name');?>
								</h1>
							</td>
							<td>
								<h1>
								<?php getValue('label_size');?>
								</h1>
							</td>
							<td>
								<h1>
								<?php getValue('label_upload_by');?>
								</h1>
							</td>
							<td>
								<h1></h1>
							</td>
						</tr>
						<?php
						for($i = 0; $i < count ( $issue->attachments ); $i ++) {
							$attached = $issue->attachments [$i];
							?>
						<tr class="managed-table-tr">
							<td><?php
							echo substr ( $attached->date_submitted, 0, 10 ) . ' ';
							echo substr ( $attached->date_submitted, 12, 4 );
							?>
							</td>
							<td><?php echo $attached->filename;?></td>
							<td><?php echo $attached->size/1000;?> KB</td>
							<td><?php 
							$user = $mantisCore->getUserById($attached->user_id);
							echo $user->realname;?>
							</td>
							<td><a
								onclick="downloadAttached(<?php echo $attached->id;?>, '<?php echo $attached->filename;?>')"
								style="cursor: pointer;"><?php getValue('label_download');?> </a>
							</td>
						</tr>
						<?php }

						if (count ( $issue->attachments ) == 0) {
							?>
						<tr class="empty-data-table">
							<td colspan="5"><i><?php getValue('label_empty_list');?> </i></td>
						</tr>
						<?php }?>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="4"><label><?php getValue('label_notes_history');?> </label>
			</td>
		</tr>
		<?php
		if (isset($issue->notes)) {

			for($i = 0; $i < count ($issue->notes); $i++) {
				$note = new stdClass();
				$note = $issue->notes [$i];
				// solo se muestran las notas públicas
				if ($note->view_state->id == 10) {
					if ($issue->reporter->id == $note->reporter->id) {
						echo'<tr><td class="managed-notes-td-alternate">';
					}else {
						echo'<tr><td class="managed-notes-td">';
					}
					echo $note->reporter->real_name . ':';
					echo '</td>';
					if ($issue->reporter->id == $note->reporter->id) {
						echo '<td class="managed-chat-td-alternate" colspan="3">';
					}else{
						echo '<td class="managed-chat-td" colspan="3">';
					}
					echo $note->text . '<br />';
					echo '</td>';
					echo'</tr>';
					echo'<tr align="right">';
					if ($issue->reporter->id == $note->reporter->id) {
						echo '<td class="managed-chatdate-td-alternate" colspan="4">';
					}else{
						echo '<td class="managed-chatdate-td" colspan="4">';
					}
					echo '( ' . substr ( $note->date_submitted, 12, 4 ) . ' ';
					echo '<b>' . substr ( $note->date_submitted, 0, 10 ) . ' )';
					echo '</td>';
					echo'</tr>';
				}
			}
		}
		?>
		<tr>
			<td colspan="4">
				<form id="addNoteIssueForm" name="addNoteIssueForm" action="#"
					method="post">
					<textarea name="noteTextArea" rows="3" style="width: 100%"
						class="managed-chat-td"></textarea>
					<input type="hidden" name="issueId" id="issueId"
						value="<?php echo $issueId;?>"> <input type="hidden"
						id="issueAction" name="issueAction" value="addIssueNoteAction"> <input
						type="hidden" name="flow" id="flow" value="detailsIssue" />
				</form>
			</td>
		</tr>
		<tr align="right">
			<td colspan="4">
				<ul>
					<li><a onclick="addNoteIssue()" style="cursor: pointer;"><?php getValue('label_insert_note');?>
					</a>
					</li>
					<li style="color: #1aa9b8; font-size: 11px;">|</li>
					<li><a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?>
					</a>
					</li>
				</ul>
			</td>
		</tr>
	</table>
</div>

<!-- formularios para ser utilizados en el javascript -->
<form id="headersIssueForm" name="headersIssueForm" action="#"
	method="post">
	<input type="hidden" name="flow" id="flow" value="headersIssue"><input type="hidden"
	id="projectId" name="projectId">
</form>

<form id="downloadAttachedForm" name="downloadAttachedForm"
	method="post" action="#">
	<input type="hidden" name="issueAction" value="downloadAttachedAction">
	<input type="hidden" name="attachedId"> <input type="hidden"
		name="attachedFileName"> <input type="hidden" name="flow" id="flow"
		value="detailsIssue" />
</form>

<!-- scripts para el funcionamiento de la página -->
<script type="text/javascript">
	function redirectToBack() {
		document.getElementById('projectId').value = <?php echo $_SESSION['projectId'];?>;
		document.forms["headersIssueForm"].submit();
	}

	function addNoteIssue() {
		document.forms["addNoteIssueForm"].submit();
	}

	function downloadAttached(id, filename) {
		document.forms["downloadAttachedForm"].attachedId.value = id;
		document.forms["downloadAttachedForm"].attachedFileName.value = filename;
		document.forms["downloadAttachedForm"].submit();
	}
</script>
