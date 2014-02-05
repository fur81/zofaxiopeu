<?php 
// se establece la configuración para las variables de paypal
setProjectPaypalConfiguration();
?>

<div id="consultation_details">
	<div class="redirect_client_zone_home" style="cursor: pointer;" onclick="redirectToBeginningClientZone()">
    	<img  src="templates/medicnexus/images/home_cz_icon.gif"/>
    	<span style="color: #12828e; font-size: 12px;">&nbsp;::&nbsp;</span>
    	<a><?php getValue('label_beginning_client_zone');?></a>
    </div>
	<div class="back_option">
        <a onclick="redirectToBack()" style="cursor: pointer;"><?php getValue('label_back');?></a>
        <img style="cursor: pointer;" onclick="redirectToBack()" src="templates/medicnexus/images/back_option_bg.gif" />
    </div>    
    <div>
        <div>
            <div class="consultation_detail_icon">
                <img src="templates/medicnexus/images/consult_report_icon.gif" />
            </div>
            <div class="consultation_detail_title"><?php getValue('label_report_consultation_info');?></div>
        </div>
        <div class="consultation_detail_body">
            <table width="100%" cellpadding="3" cellspacing="3">
                <form name="subprojectSelectionForm" method="post" action="#">
                <tr valign="top">
                    <td width="110px" class="consult_det_title_td">
                    	<label for="subproject">*<?php getValue('label_specialities');?>:</label>
                    </td>
                    <td width="600px" colspan="2">
                        <select name="subprojectId" id="subproject" onchange="subprojectSelectionAction()" style="width: 193px;">
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
										echo '<option selected="selected" value="'.$project->id.'">';
										getValueByString($project->name);
										echo '</option>';
									}else {
										echo '<option value="'.$project->id.'">';
										getValueByString($project->name);
										echo '</option>';
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
                   
					<td width="200px" valign="top">
                        <select name="specialistData" id="specialistData" disabled="disabled" style="width: 100%">
                        	<option value="null"><?php getValue('label_general_specialist');?></option>
                            <?php $users = $mantisCore->getDeveloperUsersByProject($_SESSION['subProjectId']);
                            foreach ($users as $user) {
                                echo '<option value="'.$user->id.'">'.$user->realname.'</option>';
                            }
                            ?>
                        </select>
                    </td>
                    
                    <td width="400px" class="consult_det_title_td" valign="top">
                        <label for="subproject" style="vertical-align: inherit !important"><?php getValue('label_select_specialist');?>:</label> &nbsp;
                        <input align="texttop" style="vertical-align: top" type="checkbox" 
                        	id="viewSpecialistsCheckbox" name="viewSpecialistsCheckbox" onclick="showSpecialists()"> 
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
                        <input id="summaryTextData" name="summaryTextData" maxlength="128" style="width: 100%;">
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
            </table>
        </div>
    </div>
    <div>
        	<div>
            	<div class="consultation_detail_icon">
                	<img src="templates/medicnexus/images/payment_icon.gif" />
                </div>
                <div class="consultation_detail_title"><?php getValue('label_payment');?></div>
            </div>
            <div class="consultation_detail_body">
            	<table width="100%" cellpadding="3" cellspacing="3">
                	<tr valign="top">
                    	<td width="110px" class="consult_det_title_td"><?php getValue('label_price');?>:</td>
                        <td width="600px" colspan="2">
                        	<label><?php echo $GLOBALS['PAYPAL_PRICE'] . '  ' . PAYPAL_CURRENCY_EUR;?> (€)</label>
                        </td>
                    </tr>
                    <tr valign="top">
                    	<td width="110px" class="consult_det_title_td"><?php getValue('label_tax');?>:</td>
                        <td width="600px">
                        	<label><?php echo $GLOBALS['PAYPAL_TAX'] . '  ' . PAYPAL_CURRENCY_EUR;?></label>
                        </td>
                    </tr>
                    <tr valign="top">
                    	<td class="consult_det_title_td" valign="top">
                        	<label><?php getValue('label_payment_type');?>:</label>
                        </td>
                        <td colspan="2" valign="top">
                        	<label style="vertical-align: inherit !important">PayPal:</label>
                        	<input id="paymentTypePaypal" checked="checked" style="vertical-align: inherit !important" 
                        		name="paymentType" type="radio" value="paypal"/>
                            &nbsp;&nbsp;<label style="vertical-align: inherit !important">TPV:</label>
                        	<input id="paymentTypeTPV" style="vertical-align: inherit !important" 
                        		name="paymentType" type="radio" value="tpv" />
                        </td>
                    </tr>
                    <tr>
                    	<td width="710px" colspan="3" class="controls">
                        	<button onclick="createIssue()" name="Submit" type="submit" style="cursor: pointer;">
								<?php getValue('button_send');?>
                        	</button>
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
	<input type="hidden" id="specialist" name="specialist">
</form>

<form id="headersIssueForm" name="headersIssueForm" action="#" method="post">
	<input type="hidden" name="flow" id="flow" value="headersIssue"> <input type="hidden"
	id="projectId" name="projectId"><input type="hidden" id="issueAction" name="issueAction" 
	value="projectSelectionAction">
</form>

<form id="beginningZoneClientForm" name="beginningZoneClientForm" action="#" method="post">
	<input type="hidden" name="flow" id="flow" value="default">
	<input type="hidden" id="issueAction" name="issueAction" value="issueWelcomeAction">
</form>

<!-- scripts de la página -->
<script type="text/javascript">
	function createIssue() {
		document.getElementById('summaryText').value = document.getElementById('summaryTextData').value;
		document.getElementById('descriptionTextArea').value = document.getElementById('descriptionTextAreaData').value;
		document.getElementById('subProjectId').value = document.getElementById('subproject').value;
		if ($('#viewSpecialistsCheckbox').attr('checked')) {
			document.getElementById('specialist').value = document.getElementById('specialistData').value;
		} else {
			document.getElementById('specialist').value = 'null';
		}
		document.forms["createIssueForm"].submit();
	}

	function subprojectSelectionAction() {
		document.forms["subprojectSelectionForm"].submit();
	}

	function showSpecialists() {
		if ($('#viewSpecialistsCheckbox').attr('checked')) {
			$('#specialistData').removeAttr('disabled');
		}else {
			$('#specialistData').attr('disabled','disabled');
		}
	}

	function redirectToBack() {
		document.getElementById('projectId').value = <?php echo $_SESSION['projectId'];?>;
		document.forms["headersIssueForm"].submit();
	}

	function redirectToBeginningClientZone() {
		document.forms["beginningZoneClientForm"].submit();
	}
</script>
