<div class="block-border">
	<div class="block-header">
		<h1>All Levels</h1>
	</div>
	<div class="block-content">
		<table id="view-categories-table" class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Category Name</th>
					<th>Category Type</th>
					<th>Manage Categories</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($map['categories'] as $c){ ?>
				<tr>
					<td class="center"><?php echo $c['id']; ?></td>
					<td class="center"><?php echo $c['category_name']; ?></td>
					<td class="center"><?php echo $c['category_type']; ?></td>
					<td class="center">
						<form action="<?php echo site_url('/admin/categories/edit/'.$c['id']); ?>" method="post" accept-charset="utf-8" class="point-actions-form" id="edit-point-form">
							<input type="submit" name="status-link" value="" alt="Edit This Point" id="edit-point" class="edit-point">
						</form>
						<form action="<?php echo site_url('/admin/categories/delete/'.$c['id']); ?>" method="post" accept-charset="utf-8" class="dataTable-delete point-actions-form" id="delete-point-form">
							<input type="submit" name="status-link" value="" alt="Delete This Point" id="deactivate-point" class="delete-point delete-item">
						</form>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>