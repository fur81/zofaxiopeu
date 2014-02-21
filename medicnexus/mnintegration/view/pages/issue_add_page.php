<?php
// se establece la configuración para las variables de paypal
setProjectPaypalConfiguration();
?>

<div id="consultation_details">
	<div class="back_option">
		<a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?>
		</a> <img style="cursor: pointer;" onclick="redirectToBack()"
			src="templates/medicnexus/images/back_option_bg.gif" />
	</div>
	<form enctype="multipart/form-data" id="createIssueForm" name="createIssueForm" method="post"
		action="#">
		<div>
			<div>
				<div class="consultation_detail_icon">
					<img src="templates/medicnexus/images/consult_report_icon.gif" />
				</div>
				<div class="consultation_detail_title">
				<?php getProjectName(); echo ' - ';  getValue('label_report_consultation_info');?>
				</div>
			</div>
			<div class="consultation_detail_body controls">
				<table width="100%" cellpadding="3" cellspacing="3">
					<tr valign="top">
						<td width="110px" class="consult_det_title_td"><label
							for="subproject">*<?php getValue('label_specialities');?>:</label>
						</td>
						<td width="600px" colspan="2"><select name="subproject"
							class="subproject" id="subproject" style="width: 193px;">
								<option selected="selected" value="null">
								<?php getValue('label_select');?>
								</option>
								<?php
								$subprojects = $mantisCore->getSubProjects();
								foreach ($subprojects as $subproject)
								{
									$project = $mantisCore->getProject($subproject);
									echo '<option value="'.$project->id.'">';
									getValueByString($project->name);
									echo '</option>';
								}
								?>
						</select>
						</td>
					</tr>
					<tr valign="top">
						<td width="110px" class="consult_det_title_td"><label
							for="specialist"><?php getValue('label_specialists');?>:</label>
						</td>

						<td width="200px" valign="top"><select name="specialist"
							class="specialist" id="specialist" style="width: 100%"
							disabled="disabled">
								<option selected="selected">
								<?php getValue('label_general_specialist');?>
								</option>
						</select>
						</td>

						<td width="400px" class="consult_det_title_td" valign="top"><label
							for="viewSpecialistsCheckbox"
							style="vertical-align: inherit !important"><?php getValue('label_select_specialist');?>:</label>
							&nbsp; <input style="vertical-align: top" type="checkbox"
							id="viewSpecialistsCheckbox" name="viewSpecialistsCheckbox"
							onclick="showSpecialists()">
						</td>
					</tr>
					<tr>
						<td class="consult_det_title_td" valign="top"><label>*<?php getValue('label_summary');?>:</label>
						</td>
						<td colspan="2"><input id="summaryText" type="text"
							name="summaryText" maxlength="128" style="width: 100%;"
							title="<?php getValue('msg_required_summary');?>" >
						</td>
					</tr>
					<tr>
						<td class="consult_det_title_td" valign="top"><label>*<?php getValue('label_description');?>:</label>
						</td>
						<td colspan="2"><textarea style="width: 99%;" rows="6"
								name="descriptionTextArea" id="descriptionTextArea"></textarea>
						</td>
					</tr>
					<tr>
						<td class="consult_det_title_td" valign="top"><label><?php getValue('label_document');?>:</label>
						</td>
						<td colspan="3" class="controls" valign="top"><input
							class="nicefileinput nice" type="file" id="fileAttached"
							name="fileAttached">
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div>
			<div>
				<div class="consultation_detail_icon">
					<img src="templates/medicnexus/images/payment_icon.gif" />
				</div>
				<div class="consultation_detail_title">
				<?php getValue('label_payment');?>
				</div>
			</div>
			<div class="consultation_detail_body">
				<table width="100%" cellpadding="3" cellspacing="3">
					<tr valign="top">
						<td width="120px" class="consult_det_title_td"><?php getValue('label_price');?>:</td>
						<td colspan="2"><label><?php echo $GLOBALS['PAYPAL_PRICE'] . '  ' . PAYPAL_CURRENCY_EUR;?>
						</label>
						</td>
					</tr>
					<tr valign="top">
						<td class="consult_det_title_td"><?php getValue('label_tax');?>:</td>
						<td colspan="2"><label><?php echo $GLOBALS['PAYPAL_TAX'] . '  ' . PAYPAL_CURRENCY_EUR;?>
						</label>
						</td>
					</tr>
					<tr>
						<td class="consult_det_title_td" rowspan="2"><label
							style="vertical-align: middle !important;"><?php getValue('label_payment_type');?>:</label>
						</td>
						<td valign="top" style="height: 30px;"><input
							id="paymentTypePaypal" checked="checked"
							style="vertical-align: middle !important;" name="paymentType"
							type="radio" value="paypal" /> <label
							style="vertical-align: middle !important"><?php getValue('label_paypal');?>
						</label>
						</td>
						<td valign="middle"><img
							src="templates/medicnexus/images/credit_cards_icons.gif"
							style="vertical-align: bottom !important;">
						</td>
					</tr>
					<tr>
						<td valign="top" style="height: 30px;"><input id="paymentTypeTPV"
							style="vertical-align: middle !important;" name="paymentType"
							type="radio" value="tpv" /> <label
							style="vertical-align: bottom !important"><?php getValue('label_tpv');?>
						</label>
						</td>
						<td valign="middle"><img
							src="templates/medicnexus/images/sabadell_bank_icon.gif"
							style="vertical-align: bottom !important;">
						</td>
					</tr>
					<tr>
						<td width="710px" colspan="3" class="controls">
							<button name="send" type="button" style="cursor: pointer;"
								onclick="validateData()">
								<?php getValue('button_send');?>
							</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
		
		<!-- se agregan los datos para el flujo de páginas  -->
			<input type="hidden" id="flow" name="flow" value="headersIssue"> 
			<input type="hidden" id="issueAction" name="issueAction" value="createIssueAction">
	</form>
	<div class="back_option">
		<a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?>
		</a> <img style="cursor: pointer;" onclick="redirectToBack()"
			src="templates/medicnexus/images/back_option_bg.gif" />
	</div>
</div>

<!-- formularios para el funcionamiento de la pagina adicionar consulta -->

<form id="headersIssueForm" name="headersIssueForm" action="#"
	method="post">
	<input type="hidden" name="flow" id="flow" value="headersIssue">
	<input type="hidden" id="issueAction" name="issueAction" value="projectSelectionAction">
</form>

<!-- scripts de la página -->
<script type="text/javascript">

	// se obtiene el camino relativo del servidor
	function getPath() {
    	var path = "";
	    nodes = window.location. pathname. split('/');
	    for (var index = 0; index < nodes.length - 3; index++) {
    	    path += "../";
    	}
	    return path;
	}

	//se utiliza para agregar ajax al combo de especialidades
	$(document).ready(function()
	{
		// acción de modificar el combo de especialisas cuando
		// se cambia del subproyecto.
		$(".subproject").change(function()
		{
			if ( $('#viewSpecialistsCheckbox').attr('checked') ) {
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",
				url: getPath()+"mnintegration/view/ajax/issue_add_specialist_inc.php",
				data: dataString,
				cache: false,
				success: function(html)
				{
				$(".specialist").html(html);
				}
			});
		}
		});
	});

	// función para validar el formulario
	function validateData() {
		// se validan los datos
		$('span.error').remove();
		dataCorrect = true;
		// se verifica la especialidad seleccionada
		if ( $('#subproject').attr('value') == 'null' ) {
			dataCorrect = false;
			$('#subproject').after('<br><span class="error"><?php getValue('msg_required_speciality');?></span>');	
		}
		
		// se verifica  que el resumen de la consulta que no esté vacía
		if(  $('#summaryText').attr('value') == '' ) {
			dataCorrect = false;
			$('#summaryText').after('<span class="error"><?php getValue('msg_required_summary');?></span>');
		}

		// se verifica que la descripción no esté vacía
		if(  $('#descriptionTextArea').attr('value') == '' ) {
			dataCorrect = false;
			$('#descriptionTextArea').after('<span class="error"><?php getValue('msg_required_descrition');?></span>');
		}

		if( dataCorrect == true ) {
			// como todos los campos obligatorios están llenos se le da 
			// submit al formulario.
			document.forms["createIssueForm"].submit();
		}
	}

	// función para garantizar el funcionamiento de la opción marcar o desmarcar
	// los especialistas.
	function showSpecialists() {
		var value = "<?php echo getValue('label_general_specialist');?>";
		if ($('#viewSpecialistsCheckbox').attr('checked')) {
			$('#specialist').removeAttr('disabled');
			$(".subproject").change();
		}else {
			$('#specialist').attr('disabled','disabled');
			$("#specialist").html("");
			$("#specialist").append("<option value=\"null\">"+value+"</option>");
		}
	}

	// funcion que redirecciona la pagina para la vista anterior.
	function redirectToBack() {
		document.getElementById('projectId').value = <?php echo $_SESSION['projectId'];?>;
		document.forms["headersIssueForm"].submit();
	}		

	// garantiza modificar el estilo del botón Browse...
	$(document).ready(function(){
		$("input[type=file]").nicefileinput();
	});

	$("input[type=file]").nicefileinput({ 
		label : '<?php getValue('button_browse');?>'
	});

	
</script>
