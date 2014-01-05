<h4>Listado de Categorías de Usuarios</h4>
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
<table style="width: 100%;">
	<tr align="left">
		<td>
			<form id="addUserCategoryForm" name="addUserCategoryForm" action="#"
				method="post">
				<fieldset>
					<input id="categoryText" name="categoryText"> <input class="btn"
						type="submit" value="Adicionar Categoría"
						title="Adicionar Categoría de Usuarios" name="addUserCategory"> <input
						type="hidden" name="flow" id="flow" value="userCategoryList"><input
						type="hidden" id="issueAction" name="issueAction"
						value="addUserCategoryAction">
				</fieldset>
			</form>
		</td>
	</tr>
</table>

<table style="width: 100%;">
	<tr>
		<td class="article-info-term" style="width: 15%;"><h5>Nombre</h5>
		</td>
		<td class="article-info-term" style="width: 25%;"><h5>Usuarios asignados</h5>
		</td>
		<td class="article-info-term"><h5>Acción</h5>
		</td>
	</tr>
	<?php
		$categories = $mantisCore->getUserCategories ();
		foreach ( $categories as $category ) {
	?>
	<tr>
		<td>
			<?php echo $category->name;?>
		</td>
		<td>
			0
		</td>
		<td>
			<form action="#" method="post" id="removeUserCategoryForm" name="removeUserCategoryForm">
				<input type="submit" name="removeUserCategoryButton" value="Eliminar">
				<input type="hidden" name="userCategoryId" id="userCategoryId" value="<?php echo $category->id;?>">
				<input type="hidden" name="flow" id="flow" value="userCategoryList">
				<input type="hidden" id="issueAction" name="issueAction" value="removeUserCategoryAction">
			</form>
		</td>
	</tr>
	<?php }?>
</table>