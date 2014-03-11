<?php 
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Esta página se encarga de mostrar los encabezados de las consultas
 * del proyecto seleccionado. Aparece una tabla organizada por fecha de 
 * creación de la consulta donde aparece los siguientes datos de cada
 * incidencia: fecha de la última actualización, resumen, especialidad,
 * adjuntos y notas.
 * 
 * Brinda la opción de poder crear una nueva consulta asociada al proyecto
 * seleccionado.
 *  
 * @author Manuel Morejón
 * @copyright 2013 - 2014
 * @access public
 * 
 */
?>

<?php $issuesByUser = $mantisCore->getIssueHeaders (); // se obtiene los encabezados de las incidencias del usuario registrado.?>

<div id="client_zone">
	<?php include_once $GLOBALS['MNI_PROJECTS_HEADER_ACTION']; // encabezado de los proyectos. ?>

	<h1 align="left">
	<?php echo getProjectName(); echo ' - '; getValue('label_reports'); // nombre de proyectos. ?>
	</h1>
	<div id="issue_report" onclick="redirectToAddIssue()">
		<ul>
			<li><a><?php getValue('label_report_consultation');?> </a>
			</li>
			<li><img src="images/medicnexus/client/add_img.gif" border="0" />
			</li>
		</ul>
	</div>

	<table width="100%" cellpadding="1" cellspacing="1"
		style="float: left;">
		<tr class="managed-table-th">
			<td width="20%" align="left"><h1>
			<?php getValue('label_lastUpdate');?>
				</h1></td>
			<td><h1>
			<?php getValue('label_summary');?>
				</h1></td>
			<td width="25%" align="left"><h1>
			<?php getValue('label_speciality');?>
				</h1></td>
			<td width="10%" align="left"><h1>
			<?php getValue('label_attached');?>
				</h1></td>
			<td width="10%" align="left"><h1>
			<?php getValue('label_notes');?>
				</h1></td>
		</tr>
		<?php for($i = 0; $i < count ( $issuesByUser ); $i ++): // se itera por todos los encabezados de las incidencias. ?>
			<?php $issue = $issuesByUser [$i]; ?>
			<?php $issueProject = $mantisCore->getProject($issue->project); ?>
			<?php $totalHistoriesBugTag = $mantisCore->getHistoiesBugTag($issue->id); ?>
			<?php $isIssueRead = TRUE; ?>
			<?php if (bcmod($totalHistoriesBugTag, 2) != 0): // se identifica si tiene cambios en la consulta por leer. ?>
				<?php $isIssueRead = FALSE; ?>
			<?php endif;?>
			<?php if ($i % 2 == 0): ?>
		<tr class="managed-table-tr" onclick="data(<?php echo $issue->id;?>)"
			style="cursor: pointer;">
			<?php else: ?>
		
		
		<tr class="managed-table-tr-alternate"
			onclick="data(<?php echo $issue->id;?>)" style="cursor: pointer;">
			<?php endif;?>
			<td>
			<?php if (!$isIssueRead): ?>
				<strong><?php  echo getDateFormat($issue->last_updated); ?> </strong>
			<?php else:?>
				<?php echo getDateFormat($issue->last_updated); ?>
			<?php endif; ?>
			</td>
			<td>
			<?php if ($issue->status == 80): ?>
				<strike><?php echo $issue->summary; ?> </strike>
			<?php elseif (!$isIssueRead):?>	
				<strong><?php echo $issue->summary; ?> </strong>
			<?php else:?>
				<?php echo $issue->summary; ?>
			<?php endif;?>
			</td>
			<td>
			<?php if ($issue->status == 80): ?>
				<strike><?php echo getValueByString($issueProject->name); ?> </strike>
			<?php elseif (!$isIssueRead):?>
				<strong><?php echo getValueByString($issueProject->name); ?></strong>
			<?php else:?>
				<?php echo getValueByString($issueProject->name);?>
			<?php endif;?>
			</td>
			<td align="center">
			<?php if ($issue->status == 80): ?>
				<strike><?php echo $issue->attachments_count; ?></strike>
			<?php elseif (!$isIssueRead): ?>
				<strong><?php echo $issue->attachments_count; ?></strong>
			<?php else:?>
				<?php echo $issue->attachments_count;?>
			<?php endif;?>
			</td>
			<td align="center">
			<?php if ($issue->status == 80): ?>
				<strike><?php echo $issue->notes_count;?></strike>
			<?php elseif (!$isIssueRead):?> 
				<strong><?php echo $issue->notes_count; ?></strong>
			<?php else:?>
				<?php echo $issue->notes_count;?>
			<?php endif;?>
			</td>
		</tr>
		<?php endfor;?>
		<?php if (count ( $issuesByUser ) == 0): ?>
		<tr class="empty-data-table">
			<td colspan="5"><i><?php getValue('label_empty_list');?> </i></td>
		</tr>
		<?php endif;?>

	</table>
	<div id="issue_report" onclick="redirectToAddIssue()">
		<ul>
			<li><a><?php getValue('label_report_consultation');?> </a>
			</li>
			<li><img src="images/medicnexus/client/add_img.gif" border="0" />
			</li>
		</ul>
	</div>
</div>

<!-- formularios para activar las opciones del panel -->
<form id="addIssueForm" name="addIssueForm" action="#" method="post">
	<input type="hidden" name="flow" id="flow" value="addIssue">
</form>

<form id="detailsForm" name="detailsForm" action="#" method="post">
	<input type="hidden" name="issueId" id="issueId"> <input type="hidden"
		name="flow" id="flow" value="detailsIssue"><input type="hidden"
		id="issueAction" name="issueAction" value="detailsIssueAction">
</form>

<!-- scripts  -->
<script type="text/javascript">
function data(id){
	document.detailsForm.issueId.value = id;
	document.forms["detailsForm"].submit();
}

function redirectToAddIssue() {
	document.forms["addIssueForm"].submit();
}
</script>
