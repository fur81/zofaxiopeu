<?php
$issueId = $_SESSION ['issueId'];
$issue = $mantisCore->getIssueById ( $issueId );
?>

<div id="consultation_details">
	<div class="back_option">
		<a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?>
		</a> <img style="cursor: pointer;" onclick="redirectToBack()"
			src="templates/medicnexus/images/back_option_bg.gif" />
	</div>
	<div>
		<div>
			<div class="consultation_detail_icon">
				<img src="templates/medicnexus/images/consult_detail_icon.gif" />
			</div>
			<div class="consultation_detail_title">
			<?php getProjectName(); echo ' - ';   getValue('label_consultation_details');?>
			</div>
		</div>
		<div class="consultation_detail_body">
			<table width="100%" cellpadding="3" cellspacing="0">
				<tr valign="top">
					<td width="110px" class="consult_det_title_td"><label><?php getValue('label_assigned_to');?>:</label>
					</td>
					<td width="600px" class="consult_det_info_td"><?php 
					if ('Especialista General' != $issue->handler->real_name) {
						echo $issue->handler->real_name;
					}else {
						getValueByString($issue->handler->real_name);
					}
					?>
					</td>
				</tr>
				<tr valign="top">
					<td class="consult_det_title_td"><label><?php getValue('label_speciality');?>:</label>
					</td>
					<td class="consult_det_info_td"><?php getValueByString($issue->project->name);?>
					</td>
				</tr>
				<tr valign="top">
					<td class="consult_det_title_td"><label><?php getValue('label_summary');?>:</label>
					</td>
					<td class="consult_det_info_td"><?php echo $issue->summary;?>
					
					<td>
				
				</tr>
				<tr valign="top">
					<td class="consult_det_title_td"><label><?php getValue('label_description');?>:</label>
					</td>
					<td class="consult_det_info_td"><?php echo $issue->description;?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div>
		<div>
			<div class="consultation_detail_icon">
				<img src="templates/medicnexus/images/document_attachment_icon.gif" />
			</div>
			<div class="consultation_detail_title">
			<?php getValue('label_attached_documents');?>
			</div>
		</div>
		<div class="consultation_detail_body">
			<div class="controls">
				<table width="100%" cellpadding="3" cellspacing="0">
				<?php
				for($i = 0; $i < count ( $issue->attachments ); $i ++) {
					$attached = $issue->attachments [$i];
					?>
					<tr valign="top" class="active_text">
						<td width="180px" class="consult_det_title_td" valign="top"><?php 
						$user = $mantisCore->getUserById($attached->user_id);
						echo $user->realname;
						?> <br /> <?php
						echo '(' . getDateFormat($attached->date_submitted) . ')';
						?>
						</td>
						<td width="200px" class="consult_det_info_td"><?php echo $attached->filename;?>
						</td>
						<td width="330px"><a
							onclick="downloadAttached(<?php echo $attached->id;?>, '<?php echo $attached->filename;?>')"
							style="cursor: pointer;"> <img
								src="templates/medicnexus/images/download_icon.gif" /> </a>
						</td>
					</tr>
					<?php }
					if (count ( $issue->attachments ) == 0) :
					?>
					<tr class="empty-data-table">
						<td width="710px;" colspan="2" class="empty-data-table"><?php getValue('label_empty_list');?>
						</td>
					</tr>
					<?php endif;?>
				</table>
				<br>
				<table width="100%" cellpadding="3" cellspacing="0">
					<tr valign="top">
						<td class="controls" valign="top" style="width: 370px;">
							<form enctype="multipart/form-data" method="post" action="#"
								id="uploadFileForm" name="uploadFileForm" >
								<input class="nicefileinput nice" type="file" id="fileAttached"
									name="fileAttached" width=""> <input type="hidden"
									name="issueAction" value="uploadAttachedAction"> <input
									type="hidden" name="flow" id="flow" value="detailsIssue" /> <input
									type="hidden" name="issueId" id="issueId"
									value="<?php echo $issueId;?>">
							</form> <span class="consult_det_title_td"><?php getValue('label_uploadSize');?></span>
						</td>
						<td >
							<button type="button" onclick="uploadFile()" name="uploadFile"
								style="vertical-align: top !important; cursor: pointer;">
								<?php getValue('button_upload_file');?>
							</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div>
		<div>
			<div class="consultation_detail_icon">
				<img src="templates/medicnexus/images/notes_history_icon.gif" />
			</div>
			<div class="consultation_detail_title">
			<?php getValue('label_notes_history');?>
			</div>
		</div>
		<div class="consultation_detail_body">
			<table width="100%" cellpadding="3" cellspacing="0">

			<?php
			if (isset($issue->notes)) {
					
				for($i = 0; $i < count ($issue->notes); $i++)
				{

					$note = new stdClass();
					$note = $issue->notes [$i];

					// solo se muestran las notas públicas
					if ($note->view_state->id == 10)
					{
							
						if ($issue->reporter->id == $note->reporter->id)
						{
							echo'<tr valign="top" class="active_text"><td width="200px" class="consult_det_title_td">';
						}
						else
						{
							echo'<tr valign="top"><td width="200px" class="consult_det_title_td">';
						}
							
						echo $note->reporter->real_name . ':';
						echo '<br />';
						echo '(' . getDateFormat($note->date_submitted) . ')';
						echo '</td><td width="560px" class="consult_det_info_td">';
						echo $note->text;
						echo '</td></tr><tr><td colspan="2" height="20px">';
						echo '<img src="templates/medicnexus/images/notes_separator.gif"  /></td></tr>';
					}
				}
			}
			?>
			</table>
		</div>
		<div class="notes_form controls">
			<table width="100%" cellpadding="2" cellspacing="2">
				<tr>
					<td width="710px" class="new_note"><?php getValue('label_new_note');?>
					</td>
				</tr>
				<tr>
					<td width="710px">

						<form id="addNoteIssueForm" name="addNoteIssueForm" action="#"
							method="post">
							<textarea name="noteTextArea" rows="3" style="width: 100%"
								class="managed-chat-td"></textarea>
							<input type="hidden" name="issueId" id="issueId"
								value="<?php echo $issueId;?>"> <input type="hidden"
								id="issueAction" name="issueAction" value="addIssueNoteAction">
							<input type="hidden" name="flow" id="flow" value="detailsIssue" />
						</form>
					</td>
				</tr>
				<tr>
					<td width="710px">
						<button name="Submit" type="button" onclick="addNoteIssue()">
						<?php getValue('button_send');?>
						</button>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="back_option">
		<a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?>
		</a> <img style="cursor: pointer;" onclick="redirectToBack()"
			src="templates/medicnexus/images/back_option_bg.gif" />
	</div>
</div>

<!-- formularios para ser utilizados en el javascript -->

<form id="downloadAttachedForm" name="downloadAttachedForm"
	method="post" action="#">
	<input type="hidden" name="issueAction" value="downloadAttachedAction">
	<input type="hidden" name="attachedId"> <input type="hidden"
		name="attachedFileName"> <input type="hidden" name="flow" id="flow"
		value="detailsIssue" />
</form>

<form id="headersIssueForm" name="headersIssueForm" action="#"
	method="post">
	<input type="hidden" name="flow" id="flow" value="headersIssue"> <input
		type="hidden" id="projectId" name="projectId"><input type="hidden"
		id="issueAction" name="issueAction" value="projectSelectionAction">
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

	function uploadFile() {
		if( $('#fileAttached').attr('value') != '') {
			document.forms["uploadFileForm"].submit();
		}
	}

	function downloadAttached(id, filename) {
		document.forms["downloadAttachedForm"].attachedId.value = id;
		document.forms["downloadAttachedForm"].attachedFileName.value = filename;
		document.forms["downloadAttachedForm"].submit();
	}

	// garantiza modificar el estilo del botón Browse...
	$(document).ready(function(){
		$("input[type=file]").nicefileinput();
	});

	$("input[type=file]").nicefileinput({ 
		label : '<?php getValue('button_browse');?>'
	});
	
</script>
