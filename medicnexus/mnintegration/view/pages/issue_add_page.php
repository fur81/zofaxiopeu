<div id="client_zone">

	<!-- se agrega el encabezado con los proyectos -->
<?php include_once $GLOBALS['MNI_PROJECTS_HEADER_ACTION'];?>
<?php setProjectPaypalConfiguration();?>
	<h1>
	<?php getProjectName(); echo ' - '; getValue('label_report_consultation');?>
	</h1>
	<table width="100%" cellpadding="1" cellspacing="1"
		style="float: left;">
		<tr>
			<td colspan="4" align="right"><a onclick="redirectToBack()"
				style="cursor: pointer;"><?php getValue('label_back');?>
			</a></td>
		</tr>
		<tr>
			<td><label><?php getValue('label_price');?>:</label></td>
			<td align="right" width="6%"><label><?php echo $GLOBALS['PAYPAL_PRICE']; echo ' ' . PAYPAL_CURRENCY_EUR;?></label>
			</td>
		</tr>
		<tr>
			<td><label><?php getValue('label_shipping');?>:</label></td>
			<td align="right"><label><?php echo $GLOBALS['PAYPAL_SHIPPING']; echo ' ' . PAYPAL_CURRENCY_EUR;?></label></td>
		</tr>
		<tr>
			<td><label><?php getValue('label_tax');?>:</label></td>
			<td align="right"><label><?php echo $GLOBALS['PAYPAL_TAX']; echo ' ' . PAYPAL_CURRENCY_EUR;?></label></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><label>-------------</label></td>
		</tr>
		<tr>
			<td><label><?php getValue('label_total_amount');?>:</label></td>
			<td align="right"><label><?php echo $GLOBALS['PAYPAL_TOTAL_AMOUNT']; echo ' ' . PAYPAL_CURRENCY_EUR;?></label></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<form name="subprojectSelectionForm" method="post" action="#">
		<tr>
			<td width="15%"><label for="subproject">*<?php getValue('label_specialities');?>:</label>
			</td>
			<td width="30%"><select name="subprojectId" id="subproject"
				onchange="subprojectSelectionAction()" style="width: 100%">
				<?php
				$countProjects = 0;
				$tempProject = NULL;
				$subprojects = $mantisCore->getSubProjects();
				foreach ($subprojects as $subproject) {
					$project = $mantisCore->getProject($subproject);
					// si no existe lo creo la primera vez
					if (!isset($_SESSION['subProjectId'])) {
						$_SESSION['subProjectId'] = $project->id;
					}
					// almaceno el primer proyecto
					if ($tempProject == NULL) {
						$tempProject = $project;
					}
					// se selecciona en el combo el elemento marcado en el submit
					if ($_SESSION['subProjectId'] == $project->id) {
						echo '<option selected="selected" value="'.$project->id.'">'.$project->name.'</option>';
					}else {
						echo '<option value="'.$project->id.'">'.$project->name.'</option>';
						// cuenta los proyectos que no coinciden
						$countProjects++;
					}
				}
				// si en el recorrido no coincide ninguno pues se actualiza con el primero
				if (count($subprojects) == $countProjects) {
					$_SESSION['subProjectId'] = $tempProject->id;
				}
				?>
			</select></td>
		</tr>
		<tr>
			<td><label for="specialist">*<?php getValue('label_specialists');?>:</label>
			</td>
			<?php if (isset($_SESSION['viewSpecialistsCheckbox']) && $_SESSION['viewSpecialistsCheckbox'] == true)
			{
				?>
			<td width="30%"><select name="specialistData" id="specialistData"
				style="width: 100%">
				<?php $users = $mantisCore->getDeveloperUsersByProject($_SESSION['subProjectId']);
				foreach ($users as $user) {
					echo '<option value="'.$user->id.'">'.$user->realname.'</option>';
				}
				?>
			</select></td>
			<?php }else {?>
			<td width="30%"><select	disabled="disabled" style="width: 100%">
					<option><?php getValue('label_general_specialist');?></option>
			</select></td>
			<?php }?>

			<td width="20%" align="right"><label for="subproject"><?php getValue('label_select_specialist');?>:</label>
			</td>
			<td align="left">
				
					<input type="checkbox" id="viewSpecialistsCheckbox"
						name="viewSpecialistsCheckbox" onclick="showSpecialists()"
			<?php if (isset($_SESSION['viewSpecialistsCheckbox']) &&  $_SESSION['viewSpecialistsCheckbox'] == true) {
				echo 'checked="checked"';
			}?> /> <input type="hidden" name="flow" id="flow" value="addIssue"> <input
						type="hidden" name="issueAction" id="issueAction"
						value="subprojectSelectionAction">
				</td>
		</tr>
		</form>
		<tr>
			<td><label>*<?php getValue('label_summary');?>:</label></td>
			<td colspan="3"><input id="summaryTextData" name="summaryTextData"
				style="width: 100%;"></td>
		</tr>
		<tr>
			<td><label>*<?php getValue('label_description');?>:</label>
			</td>
			<td colspan="3"><textarea style="width: 100%;"
					name="descriptionTextAreaData" id="descriptionTextAreaData"></textarea></td>
		</tr>
		<tr align="right">
			<td colspan="4">
				<ul>
					<li><a onclick="createIssue()" style="cursor: pointer;"><?php getValue('label_report_consultation');?>
					</a></li>
					<li style="color: #1aa9b8; font-size: 11px;">|</li>
					<li><a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?>
					</a></li>
				</ul></td>
		</tr>
	</table>
</div>

<!-- formularios para el funcionamiento de la pagina adicionar consulta -->

<form id="headersIssueForm" name="headersIssueForm" action="#"
	method="post"><input type="hidden" name="flow" id="flow" 
	value="headersIssue"><input	type="hidden" id="projectId" name="projectId">
</form>

<form name="createIssueForm" method="post" action="#">
	<input type="hidden" id="flow" name="flow" value="headersIssue"> <input
		type="hidden" id="issueAction" name="issueAction"
		value="createIssueAction"><input type="hidden" id="summaryText" name="summaryText">
	<input type="hidden" id="descriptionTextArea" name="descriptionTextArea">
	<input type="hidden" id="subProjectId" name="subProjectId">
	<?php if (isset($_SESSION['viewSpecialistsCheckbox']) && $_SESSION['viewSpecialistsCheckbox'] == true){?>
		<input type="hidden" id="specialist" name="specialist">
	<?php }?>
</form>

<!-- scripts de la página -->
<script type="text/javascript">
	function createIssue() {
		document.getElementById('summaryText').value = document.getElementById('summaryTextData').value;
		document.getElementById('descriptionTextArea').value = document.getElementById('descriptionTextAreaData').value;
		document.getElementById('subProjectId').value = document.getElementById('subproject').value;
		if (document.getElementById('specialistData') != null) {
			document.getElementById('specialist').value = document.getElementById('specialistData').value;
		}
		document.forms["createIssueForm"].submit();
	}

	function subprojectSelectionAction() {
		var lfckv = document.getElementById("viewSpecialistsCheckbox").checked;
		if (lfckv) {
			document.forms["subprojectSelectionForm"].submit();
		}
	}

	function showSpecialists() {
		document.forms["subprojectSelectionForm"].submit();
	}

	function redirectToBack() {
		document.getElementById('projectId').value = <?php echo $_SESSION['projectId'];?>;
		document.forms["headersIssueForm"].submit();
	}
</script>
