<div id="consultation_details">
	<div class="back_option">
        <a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?></a>
        <img style="cursor: pointer;" onclick="redirectToBack()" src="templates/medicnexus/images/back_option_bg.gif" />
    </div>    
    <div>
        <div>
            <div class="consultation_detail_icon">
                <img src="templates/medicnexus/images/consult_report_icon.gif" />
            </div>
            <div class="consultation_detail_title">REPORTE DE CONSULTAS</div>
        </div>
        <div class="consultation_detail_body">
            <table width="100%" cellpadding="3" cellspacing="3">
                <form name="subprojectSelectionForm" method="post" action="#">
                <tr valign="top">
                    <td width="110px" class="consult_det_title_td">
                    	<label for="subproject">*<?php getValue('label_specialities');?>:</label>
                    </td>
                    <td width="600px" colspan="2">
                        <select name="subprojectId" id="subproject" onchange="subprojectSelectionAction()" style="width: 157px;">
							<?php
								$countProjects = 0;
								$tempProject = NULL;
								$subprojects = $mantisCore->getSubProjects();
								
								foreach ($subprojects as $subproject) 
								{
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
								if (count($subprojects) == $countProjects) 
								{
									$_SESSION['subProjectId'] = $tempProject->id;
								}
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="110px" class="consult_det_title_td">
                    	<label for="specialist">*<?php getValue('label_specialists');?>:</label>
                    </td>
                    <?php if (isset($_SESSION['viewSpecialistsCheckbox']) && $_SESSION['viewSpecialistsCheckbox'] == true)
					{
					?>
					<td width="150px" valign="top">
                        <select name="specialistData" id="specialistData" style="width: 100%">
                            <?php $users = $mantisCore->getDeveloperUsersByProject($_SESSION['subProjectId']);
                            foreach ($users as $user) {
                                echo '<option value="'.$user->id.'">'.$user->realname.'</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <?php }else {?>
                    <td width="150px">                    	                       
                        <select	disabled="disabled"  style="width: 100%">
                        	<option><?php getValue('label_general_specialist');?></option>
						</select>
                    </td>
                    <?php }?>
                    <td width="400px" class="consult_det_title_td" valign="top">
                        <label for="subproject" style="vertical-align: inherit !important"><?php getValue('label_select_specialist');?>:</label> &nbsp;
                        <input align="texttop" style="vertical-align: top" type="checkbox" id="viewSpecialistsCheckbox" name="viewSpecialistsCheckbox" onclick="showSpecialists()"
                        <?php if (isset($_SESSION['viewSpecialistsCheckbox']) &&  $_SESSION['viewSpecialistsCheckbox'] == true) {
                            echo 'checked="checked"';
                        }?> /> 
                        <input type="hidden" name="flow" id="flow" value="addIssue"> 
                        <input type="hidden" name="issueAction" id="issueAction" value="subprojectSelectionAction">
                    </td>
                </tr>
                </form>
                <tr>
                    <td class="consult_det_title_td" valign="top">
                        <label>*<?php getValue('label_summary');?>:</label>
                    </td>
                    <td colspan="2">
                        <input id="summaryTextData" name="summaryTextData" style="width: 100%;">
                    </td>
                </tr>
                <tr>
                    <td class="consult_det_title_td" valign="top">
                        <label>*<?php getValue('label_description');?>:</label>
                    </td>
                    <td colspan="2">
                        <textarea style="width: 99%;" rows="6" name="descriptionTextAreaData" id="descriptionTextAreaData"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="710px" colspan="3" class="controls">
                        <button onclick="createIssue()" name="Submit" type="submit" style="cursor: pointer;">
							<?php getValue('label_report_consultation');?>
                        </button>
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
                <div class="consultation_detail_title">PAGO</div>
            </div>
            <div class="consultation_detail_body">
            	<table width="100%" cellpadding="3" cellspacing="3">
                	<tr valign="top">
                    	<td width="110px" class="consult_det_title_td">Precio:</td>
                        <td width="600px" colspan="2">
                        	<label>70 EUR (€)</label>
                        </td>
                    </tr>
                    <tr valign="top">
                    	<td width="110px" class="consult_det_title_td">Impuesto:</td>
                        <td width="600px">
                        	<label>6 EUR (3%)</label>
                        </td>
                    </tr>
                    <tr valign="top">
                    	<td class="consult_det_title_td" valign="top">
                        	<label>Tipo de pago:</label>
                        </td>
                        <td colspan="2" valign="top">
                        	<label style="vertical-align: inherit !important">PayPal:</label>
                        	<input style="vertical-align: inherit !important" name="" type="radio" value="paypal" />
                            &nbsp;&nbsp;<label style="vertical-align: inherit !important">TPV:</label>
                        	<input style="vertical-align: inherit !important" name="" type="radio" value="paypal" />
                        </td>
                    </tr>
                    <tr>
                    	<td width="710px" colspan="3" class="controls">
                        	<button name="Submit" type="submit">Efectuar pago</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <div class="back_option">
        <a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?></a>
        <img style="cursor: pointer;" onclick="redirectToBack()" src="templates/medicnexus/images/back_option_bg.gif" />
    </div> 
</div>

<!-- formularios para el funcionamiento de la pagina adicionar consulta -->

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

<form id="headersIssueForm" name="headersIssueForm" action="#" method="post">
	<input type="hidden" name="flow" id="flow" value="headersIssue"> <input type="hidden"
	id="projectId" name="projectId"><input type="hidden" id="issueAction" name="issueAction" 
	value="projectSelectionAction">
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
