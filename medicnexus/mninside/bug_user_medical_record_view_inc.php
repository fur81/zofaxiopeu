<?php
/**
 * This include file prints out the Clinic Record Details of the informer.
 */

$t_users = bug_get_monitors ( $f_bug_id );
$num_users = sizeof ( $t_users );

// get connection
include_once 'bug_user_medical_record_config.php';

// get queries
include_once 'bug_user_medical_record_queries.php';

// get user id
$query = str_replace('%value%', $f_bug_id, $reporterIdQuery);
$result = $proxyMySql->query ( $query );
$userId = $result->fetch_object ()->reporter_id;

// load data
$query = str_replace('%value%', $userId, $existMedicalRecordQuery);

$medicalRecord = new stdClass();
$result = $proxyMySql->query ( $query );
if ($data = $result->fetch_object ()) {
	$medicalRecord->date_of_birth = $data->date_of_birth;
	$medicalRecord->sex = $data->sex;
	$medicalRecord->records = $data->records;
	$medicalRecord->observations = $data->observations;
}

echo '<br />';

collapse_open( 'medical_record_form' );
?>
<form method="post" action="bug_user_medical_record_view.php">
	<table class="width100" cellspacing="1">
		<!-- Title -->
		<tr>
			<td class="form-title" colspan="2">
			<?php 
				collapse_icon( 'medical_record_form' );
				echo lang_get( 'medical_record' );
			?>
			</td>
		</tr>

		<!-- Date of Birth -->
		<tr <?php echo helper_alternate_class( 1 ) ?>>
			<td class="category" width="15%"><?php echo lang_get( 'date_of_birth' );?></td>
			<td width="85%"><input type="text" size="32"
				maxlength="<?php echo DB_FIELD_SIZE_REALNAME;?>" name="dateOfBirth" 
				value="<?php echo $medicalRecord->date_of_birth;?>"/></td>
		</tr>
		
		<!-- Sex -->
		<tr <?php echo helper_alternate_class( 1 ) ?>>
			<td class="category" width="15%"><?php echo lang_get( 'sex' );?></td>
			<td width="85%">
			<?php if($medicalRecord->sex == 'M'){?>
			<input type="radio" name="sex" value="F"/><?php echo lang_get( 'female' );?>
				<input type="radio" name="sex" value="M" checked="checked"/><?php echo lang_get( 'male' );?>
			<?php } else {?>
			<input type="radio" name="sex" value="F" checked="checked"/><?php echo lang_get( 'female' );?>
				<input type="radio" name="sex" value="M"/><?php echo lang_get( 'male' );?>
				<?php }?>
			</td>
		</tr>
		
		<!-- Records -->
		<tr <?php echo helper_alternate_class( 1 ) ?>>
			<td class="category" width="15%"><?php echo lang_get( 'records' );?></td>
			<td width="85%">
			<textarea rows="3" cols="100" id="recordsTextArea" name="recordsTextArea" 
				draggable="false"><?php echo $medicalRecord->records;?></textarea></td>
		</tr>
		
		<!-- Observations -->
		<tr <?php echo helper_alternate_class( 1 ) ?>>
			<td class="category" width="15%"><?php echo lang_get( 'observations' );?></td>
			<td width="85%">
			<textarea rows="3" cols="100" id="observationsTextArea" name="observationsTextArea" 
				draggable="false"><?php echo $medicalRecord->observations;?></textarea></td>
		</tr>

		<!-- Submit Buttom -->
		<tr>
			<td class="center" colspan="2"><input type="submit" class="button"
				value="<?php echo lang_get( 'update_information_button' ) ?>" />
				<input type="hidden" name="bug_id" value="<?php echo $f_bug_id ?>" size="4" />
				</td>
		</tr>
	</table>
</form>
<?php
	collapse_closed( 'medical_record_form' );
?>
<table class="width100" cellspacing="1">
<tr>
	<td class="form-title" colspan="2">
		<?php
			collapse_icon( 'medical_record_form' );
			echo lang_get( 'medical_record' );
		?>
	</td>
</tr>
</table>
<?php 
collapse_end( 'medical_record_form' );
