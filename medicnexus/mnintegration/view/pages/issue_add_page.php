<h4>Adicionar Incidencia</h4>
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
<form name="subprojectSelectionForm" method="post" action="#"
	style="width: 100%;">
	<p>

		<label for="subproject">*Especialidades: </label> <select
			name="subprojectId" id="subproject" onchange="subprojectSelectionAction()">
			<?php
			$subprojects = $mantisCore->getSubProjects();
			foreach ($subprojects as $subproject) {
				$project = $mantisCore->getProject($subproject);
				// si no existe lo creo la primera vez
				if (!isset($_SESSION['subProjectId'])) {
					$_SESSION['subProjectId'] = $project->id;
				}
				// se selecciona en el combo el elemento marcado en el submit
				if ($_SESSION['subProjectId'] == $project->id) {
					echo '<option selected="selected" value="'.$project->id.'">'.$project->name.'</option>';
				}else {
					echo '<option value="'.$project->id.'">'.$project->name.'</option>';
				}
			}
			?>
		</select>
		<label for="subproject">Seleccionar Especialista: 
		<input type="checkbox" id="viewSpecialistsCheckbox" name="viewSpecialistsCheckbox" 
			onclick="showSpecialists()"
			<?php if ($_SESSION['viewSpecialistsCheckbox'] == true) {
				echo 'checked="checked"';
			}?>> 
		</label> 
		<input type="hidden" name="flow" id="flow" value="addIssue"> <input type="hidden"
			name="issueAction" id="issueAction" value="subprojectSelectionAction">
	</p>
</form>

<form name="createIssueForm" method="post" action="#"
	style="width: 100%;">
	
	<?php if ($_SESSION['viewSpecialistsCheckbox'] == true)
	{
	?>
		<p>
			<label for="specialist">*Especialistas: </label> <select
				name="specialist" id="specialist">
			<?php $users = $mantisCore->getDeveloperUsersByProject($_SESSION['subProjectId']);
			foreach ($users as $user) {
				echo '<option value="'.$user->id.'">'.$user->realname.'</option>';
			}
			?>
			</select>

		</p>
	<?php }?>
		<p>
		
		<label title="Resumen de la Incidencia">*Resumen:</label> <input
			id="summaryText" name="summaryText" style="width: 100%;">
	</p>
	<p>
		<label title="Descripción de la incidencia">*Descripción:</label>
		<textarea rows="3" style="width: 100%;" name="descriptionTextArea"></textarea>
	</p>
	<div align="right">
		<input class="btn" type="submit" id="createIssueButtom"
			name="createIssueButtom" value="Adicionar Incidencia">
	</div>
	<input type="hidden" id="flow" name="flow" value="headersIssue"> <input
		type="hidden" id="issueAction" name="issueAction"
		value="createIssueAction">
</form>

<script>
function subprojectSelectionAction() {
	var lfckv = document.getElementById("viewSpecialistsCheckbox").checked;
	if (lfckv) {
		document.forms.subprojectSelectionForm.submit();
	}
}

function showSpecialists() {
	document.forms.subprojectSelectionForm.submit();
}
</script>