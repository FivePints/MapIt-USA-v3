<h1>All Levels</h1>
<table id="view-categories-table" class="table table-striped <?php if($map['categories']): echo 'dataTable'; endif; ?>">
	<thead>
		<tr>
			<th>ID</th>
			<th>Category Name</th>
			<th>Category Type</th>
			<th>Manage</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($map['categories'] as $c){ ?>
		<tr>
			<td class="center"><?php echo $c['id']; ?></td>
			<td class="center"><?php echo $c['category_name']; ?></td>
			<td class="center"><?php echo $c['category_type']; ?></td>
			<td class="center manage-item">
				<a href="<?= site_url('/admin/categories/edit/'.$c['id']); ?>" class="manage-icon"><i class="icon-pencil"></i></a>
				<a href="<?= site_url('/admin/categories/delete/'.$c['id']); ?>" class="manage-icon item-delete"><i class="icon-remove-sign"></i></a>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>