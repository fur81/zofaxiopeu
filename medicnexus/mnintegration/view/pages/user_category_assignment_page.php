<h4>Asignación de Categorías de Usuarios</h4>
<div align="right">
	<fieldset>
		<table>
			<tr>
				<td>
					<form id="managerHomeForm" name="managerHomeForm" action="#"
						method="post">
						<input class="btn" type="submit" value="Panel Principal"
							title="Volver al Panel Principal" name="managerHome"> <input
							type="hidden" name="flow" id="flow" value="">
					</form>
				</td>
			</tr>
		</table>
	</fieldset>
</div>
<form id="selectUserCategoryForm" name="selectUserCategoryForm"
	action="#" method="post">
	<table>
		<tr>
			<td><label for="categoryId">*Categoría: </label> <select
				name="categoryId" id="categoryId">
				<?php
				$categories = $mantisCore->getUserCategories ();
				foreach ( $categories as $category ) {
					if ($_SESSION ['categoryId'] == $category->id) {
						echo '<option selected="selected" value="' . $category->id . '">' . $category->name . ' </option>';
					} else {
						echo '<option value="' . $category->id . '">' . $category->name . '</option>';
					}
				}
				?>
			</select> <input class="btn" type="submit"
				name="userCategoryAssignemntButton"
				id="userCategoryAssignemntButton" value="Ver Médicos"> <input
				type="hidden" name="flow" id="flow" value="userCategoryAssignment">
				<input type="hidden" name="issueAction" id="issueAction"
				value="selectUserCategoryAction"></td>

		</tr>
	</table>
</form>

				<?php
				if ($_SESSION['categoryId'] > 0) {
					?>
<h6>Usuarios disponibles para esta categoria</h6>
<form id="addUserCategoryRelationForm"
	name="addUserCategoryRelationForm" action="#" method="post">
	<label for="medicoId">*Médico: </label> <select name="medicoId"
		id="medicoId">
		<?php
		$users = $mantisCore->getUsersNotInCategory( $_SESSION['categoryId']);
		foreach ( $users as $user ) {
			echo '<option value="' . $user->id . '">' . $user->realname . '</option>';
		}
		?>
	</select> <input class="btn" type="submit"
		name="addUserCategoryRelationButton"
		id="addUserCategoryRelationButton" value="Asignar Médico"> <input
		type="hidden" name="flow" id="flow" value="userCategoryAssignment"> <input
		type="hidden" name="issueAction" id="issueAction"
		value="addUserCategoryRelationAction">
</form>
<h6>Usuarios asignados a esta categoria</h6>
<table style="width: 100%;">
	<tr>
		<td class="article-info-term" style="width: 15%;"><h5>Nombre</h5>
		</td>
		<td class="article-info-term"><h5>Acción</h5>
		</td>
	</tr>
	<?php
	$users = $mantisCore->getUsersInCategory( $_SESSION['categoryId']);
	foreach ( $users as $user ) {
		?>
	<tr>
		<td><?php echo $user->realname;?>
		</td>
		<td>
			<form action="#" method="post" id="removeUserCategoryRelationForm"
				name="removeUserCategoryRelationForm">
				<input type="submit" name="removeUserCategoryRelationButton"
					value="Eliminar"> <input type="hidden" name="medicoId"
					id="medicoId" value="<?php echo $user->id;?>"> <input
					type="hidden" name="flow" id="flow" value="userCategoryAssignment"> <input
					type="hidden" id="issueAction" name="issueAction"
					value="removeUserCategoryRelationAction">
			</form>
		</td>
	</tr>
	<?php }?>
</table>
	<?php
				}
				?>