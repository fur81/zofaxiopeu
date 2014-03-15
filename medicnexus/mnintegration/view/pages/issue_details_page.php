<?php 
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Esta página se encarga de mostrar los detalles de la consulta seleccionada.
 * Aparecen secciones donde se detallan cada uno de los elementos que la contienen.
 * 
 * Brinda la opción de adjuntar documentos que brinden información adicional
 * a los médicos. También se pueden agregar notas aclaratorias por parte del paciente
 * y el médico en aras de establecer una correcta comunicación.
 *  
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 * 
 */
?>

<?php $issueId = $_SESSION ['issueId']; //id de la consulta seleccionada. ?>
<?php $issue = $mantisCore->getIssueById ( $issueId ); // se cargan los detalles de la consulta. ?>

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
					<td width="600px" class="consult_det_info_td">
					<?php if ('Especialista General' != $issue->handler->real_name): ?>
						<?php echo $issue->handler->real_name;?>
					<?php else:?>
						<?php getValueByString($issue->handler->real_name);?>
					<?php endif;?>
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
					<td class="consult_det_info_td"><?php echo replaceRToBr($issue->description);?>
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
				<?php for($i = 0; $i < count ( $issue->attachments ); $i ++): ?>
					<?php $attached = $issue->attachments [$i];?>
					<tr valign="top" class="active_text">
						<td width="180px" class="consult_det_title_td" valign="top">
							<?php $user = $mantisCore->getUserById($attached->user_id);?>
							<?php echo $user->realname;?>
							<br /> 
							<?php echo '(' . getDateFormat($attached->date_submitted) . ')';?>
						</td>
						<td width="200px" class="consult_det_info_td">
							<?php echo $attached->filename;?>
						</td>
						<td width="330px"><a
							onclick="downloadAttached(<?php echo $attached->id;?>, '<?php echo $attached->filename;?>')"
							style="cursor: pointer;"> <img
								src="templates/medicnexus/images/download_icon.gif" /> </a>
						</td>
					</tr>
					<?php endfor;?>
					<?php if (count ( $issue->attachments ) == 0) :?>
					<tr class="empty-data-table">
						<td width="710px;" colspan="2" class="empty-data-table">
							<?php getValue('label_empty_list');?>
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
							</form> 
							<span class="consult_det_info_td">
								<?php getValue('label_uploadSize');?>
								<?php if(MN_MANTIS_FILE_UNITY_SIZE == 'KB'):?>
								<?php echo round(MN_MANTIS_FILE_MAX_SIZE / 1024, 2) ;?>
								<?php elseif(MN_MANTIS_FILE_UNITY_SIZE == 'MB'):?>
								<?php echo round(MN_MANTIS_FILE_MAX_SIZE / 1024000, 2) ;?>
								<?php endif;?>
								<?php echo ' ' . MN_MANTIS_FILE_UNITY_SIZE;?>
							</span>
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

			<?php if (isset($issue->notes)):?>
				<?php for($i = 0; $i < count ($issue->notes); $i++):?>		
					<?php $note = new stdClass();?>
					<?php $note = $issue->notes [$i];?>
					<?php if ($note->view_state->id == 10): //solo se muestran las públicas. ?>
						<?php if ($issue->reporter->id == $note->reporter->id):?>
							<tr valign="top" class="active_text">
								<td width="200px" class="consult_det_title_td">
						<?php else:?>
							<tr valign="top">
								<td width="200px" class="consult_det_title_td">
						<?php endif;?>
						
						<?php echo $note->reporter->real_name;?>:
						<br>
						<?php echo '(' . getDateFormat($note->date_submitted) . ')';?>
						</td>
						<td width="560px" class="consult_det_info_td">
						<?php echo replaceRToBr($note->text);?>
						</td>
						</tr><tr>
						<td colspan="2" height="20px">
						<img src="templates/medicnexus/images/notes_separator.gif"  /></td></tr>
					<?php endif;?>
				<?php endfor;?>
			<?php endif;?>
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
