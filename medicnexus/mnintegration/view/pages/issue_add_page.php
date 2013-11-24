<div id="client_zone">

	<!-- se agrega el encabezado con los proyectos -->
	<?php include_once $GLOBALS['MNI_PROJECTS_HEADER_ACTION'];?>
	
	<h1>Adicionar Incidencia</h1>
    <table width="100%" cellpadding="1" cellspacing="1"	style="float: left;">
        <tr>
            <td colspan="4" align="right">
            	<a href="">Regresar</a>
                <!--<form id="headersIssueForm" name="headersIssueForm" action="#"
                    method="post">
                    <input class="btn" type="submit" value="Ver Incidencias"
                        title="Volver al Inicio" name="headersIssue"> <input
                        type="hidden" name="flow" id="flow" value="headersIssue">
                </form>-->
            </td>
        </tr>
        <tr>
        	<td width="15%">
            	<label for="subproject">*Especialidades: </label>	
            </td>
            <td colspan="3">
            	<select name="subprojectId" id="subproject" onchange="subprojectSelectionAction()">
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
            </td>
        </tr>
        <tr>
        	<td>
            	<label for="specialist">*Especialistas:</label>
            </td>
            <td width="20%">
            	<select name="specialist" id="specialist">
					<?php $users = $mantisCore->getDeveloperUsersByProject($_SESSION['subProjectId']);
                    foreach ($users as $user) {
                        echo '<option value="'.$user->id.'">'.$user->realname.'</option>';
                    }
                    ?>
                </select>
            </td>
            <td width="20%">
            	<label for="subproject">Seleccionar especialista:</label>
            </td>
            <td>
            	<input type="checkbox" id="viewSpecialistsCheckbox" name="viewSpecialistsCheckbox" onclick="showSpecialists()"
					<?php if (isset($_SESSION['viewSpecialistsCheckbox']) &&  $_SESSION['viewSpecialistsCheckbox'] == true) {
                        echo 'checked="checked"';
                    }?>/>
            </td>
        </tr>
        <tr>
        	<td>
            	<label title="Resumen de la Incidencia">*Resumen:</label>
            </td>
            <td colspan="3">
            	<input id="summaryText" name="summaryText" style="width: 100%;">
            </td>
        </tr>
        <tr>
        	<td><label title="Descripción de la incidencia">*Descripción:</label></td>
            <td colspan="3">
            	<textarea style="width: 100%;" name="descriptionTextArea"></textarea>
            </td>
        </tr>
        <tr align="right">
        	<td colspan="4">
            	<ul>
                	<li>
                    	<a href="#">Reportar incidencia</a>
                    </li>
                    <li style="color: #1aa9b8; font-size: 11px;">|</li>
                    <li>
                    	<a href="#">Regresar</a>
                    </li>
                </ul>
            </td>
        </tr>
    </table>
</div>

<!-- formularios para garantizar la getión del sitio -->
<form name="subprojectSelectionForm" method="post" action="#"
	style="width: 100%;">
	<p>

		<label for="subproject">*Especialidades: </label> <select
			name="subprojectId" id="subproject"
			onchange="subprojectSelectionAction()">
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
		</select> <label for="subproject">Seleccionar Especialista: <input
			type="checkbox" id="viewSpecialistsCheckbox"
			name="viewSpecialistsCheckbox" onclick="showSpecialists()"
			<?php if (isset($_SESSION['viewSpecialistsCheckbox']) &&  $_SESSION['viewSpecialistsCheckbox'] == true) {
				echo 'checked="checked"';
			}?>> </label> <input type="hidden" name="flow" id="flow"
			value="addIssue"> <input type="hidden" name="issueAction"
			id="issueAction" value="subprojectSelectionAction">
	</p>
</form>

<form name="createIssueForm" method="post" action="#"
	style="width: 100%;">

	<?php if (isset($_SESSION['viewSpecialistsCheckbox']) && $_SESSION['viewSpecialistsCheckbox'] == true)
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



<!-- scripts de la página -->
<script type="text/javascript">
function subprojectSelectionAction() {
	var lfckv = document.getElementById("viewSpecialistsCheckbox").checked;
	if (lfckv) {
		document.forms["subprojectSelectionForm"].submit();
	}
}

function showSpecialists() {
	document.forms["subprojectSelectionForm"].submit();
}
</script>
