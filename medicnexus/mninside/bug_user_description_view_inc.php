<?php
// MantisBT - a php based bugtracking system

// MantisBT is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 2 of the License, or
// (at your option) any later version.
//
// MantisBT is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with MantisBT. If not, see <http://www.gnu.org/licenses/>.

/**
 * This include file prints out the list of users monitoring the current
 * bug.
 * $f_bug_id must be set and be set to the bug id
 *
 * @package MantisBT
 * @copyright Copyright (C) 2000 - 2002 Kenzaburo Ito - kenito@300baud.org
 * @copyright Copyright (C) 2002 - 2013 MantisBT Team - mantisbt-dev@lists.sourceforge.net
 * @link http://www.mantisbt.org
 */
$t_users = bug_get_monitors ( $f_bug_id );
$num_users = sizeof ( $t_users );

// se establece la conexión.
$proxyMySql = new mysqli ( 'localhost', 'root', 'carabobo', 'mninside' );
if (mysqli_connect_errno ()) {
	echo ("Failed to connect, the error message is : " . mysqli_connect_error ());
	exit ();
}
// se obtiene el identificador del usuario
$getReporterIdQuery = 'SELECT reporter_id FROM  mantis_bug_table WHERE  id ='.$f_bug_id;
$result = $proxyMySql->query ( $getReporterIdQuery );
$reporterId = $result->fetch_object ()->reporter_id;

// se cargan los datos
$existMedicalRecordQuery = 'SELECT general FROM mantis_user_medical_record WHERE user_id = ' . $reporterId;

$medicalRecord = '';
$result = $proxyMySql->query ( $existMedicalRecordQuery );
if ($data = $result->fetch_object ()) {
	$medicalRecord->general = $data->general;
}

echo '<a name="monitors" id="monitors" /><br />';

?>
<form method="post" action="bug_user_description_view.php">
	<table class="width100" cellspacing="1">
		<!-- Title -->
		<tr>
			<td class="form-title" colspan="2">Historia Clínica del Paciente</td>
		</tr>

		<!-- Realname -->
		<tr <?php echo helper_alternate_class( 1 ) ?>>
			<td class="category" width="15%">Operaciones</td>
			<td width="85%"><input type="text" size="32"
				maxlength="<?php echo DB_FIELD_SIZE_REALNAME;?>" name="realname" value="<?php echo $medicalRecord->general;?>"/></td>
		</tr>

		<!-- Submit Buttom -->
		<tr>
			<td class="center" colspan="2"><input type="submit" class="button"
				value="<?php echo lang_get( 'update_user_button' ) ?>" />
				<input type="hidden" name="bug_id" value="<?php echo $f_bug_id ?>" size="4" />
				</td>
		</tr>
	</table>
</form>
<?php 
 # show monitor list

