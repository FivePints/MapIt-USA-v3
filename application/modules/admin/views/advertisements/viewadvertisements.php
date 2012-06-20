<div class="block-border">
	<div class="block-header">
		<h1>All Advertisements</h1>
	</div>
	<div class="block-content">

		<table id="view-advertisements-table" class="table">
			<thead>
				<tr>
					<th class="center">ID</th>
					<th class="center">Image Name</th>
					<th class="center">Advertisement Link</th>
					<th class="center">Total Clicks</th>
					<th class="center">Total Unique Clicks</th>
					<th class="center">Date Added</th>			
					<th class="center manage-advertisement">Manage</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($advertisements as $a){ 
			switch($a->status){
				case '1':
					$statusClass = 'status-link-deactivate';	
					$statusUrl = site_url('/admin/advertisements/status/'.$a->id);
					$statusLink = 'Deactivate';
					$statusText = 'Active';
				break;
				case '0':
					$statusClass = 'status-link-activate';
					$statusUrl = site_url('/admin/advertisements/status/'.$a->id);
					$statusLink = 'Activate';
					$statusText = 'Inactive';
				break;
			}?>
				<tr>
					<td class="center"><?php echo $a->id; ?></td>
					<td class="center"><?php echo $a->filename; ?></td>
					<td class="center"><?php echo $a->url; ?></td>
					<td class="center"><?php echo $a->totalClicks; ?></td>
					<td class="center"><?php echo $a->uniqueClicks; ?></td>
					<td class="center"><?php echo date('m/d/Y g:i:s', $a->timestamp); ?></td>
					<td class="center manage-advertisement">
						<form action="<?= $statusUrl; ?>" method="post" accept-charset="utf-8" class="point-actions-form form form-status" id="point-status-change-<?= $a->id; ?>">
							<input type="hidden" class="row-status" name="status" value="<?= $a->status; ?>" />
							<input type="submit" name="status-link" value="" id="deactivate-point" class="status-link <?= $statusClass ?>">
						</form>
						<form action="<?php echo site_url('/admin/advertisements/edit/'.$a->id); ?>" method="post" accept-charset="utf-8" class="point-actions-form" id="edit-point-form">
							<input type="submit" name="status-link" value="" alt="Edit This Point" id="edit-point" class="edit-point">
						</form>
						<form action="<?php echo site_url('/admin/advertisements/delete/'.$a->id); ?>" method="post" accept-charset="utf-8" class="point-actions-form  dataTable-delete form-submit form" id="delete-point-form">
							<input type="submit" name="status-link" value="" alt="Delete This Point" id="deactivate-point" class="delete-point delete-item">
						</form>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>