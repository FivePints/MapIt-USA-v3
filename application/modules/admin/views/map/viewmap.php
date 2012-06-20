<div class="block-border">
	<div class="block-header">
		<h1>All Map Points</h1>
	</div>
	<div class="block-content">
		<table id="view-map-table" class="table">
			<thead>
				<tr>
					<th>Company Name</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th>Level</th>
					<th>Contact Name</th>
					<th>Phone Number</th>
					<th>Email Address</th>
					<th class="manage-point">Manage Point</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($points as $p){ ?>

			<?php
			switch($p['pointData']->p_active){
				case '1':
					$statusUrl = site_url('/admin/map/status/'.$p['pointData']->p_id);
					$statusClass = 'status-link-deactivate';					
				break;
				case '0':
					$statusUrl = site_url('/admin/map/status/'.$p['pointData']->p_id);
					$statusClass = 'status-link-activate';
				break;
			}?>
				<tr>
					<td class="center"><?php echo $p['pointFields']['companyname']->uf_fieldvalue; ?></td>
					<td class="center"><?php echo $p['pointData']->p_lat; ?></td>
					<td class="center"><?php echo $p['pointData']->p_lng; ?></td>
					<td class="center"><?php echo $p['pointData']->p_level; ?></td>
					<td class="center"><?php echo $p['pointFields']['contactname']->uf_fieldvalue; ?></td>
					<td class="center"><?php echo $p['pointFields']['phone1']->uf_fieldvalue; ?></td>
					<td class="center"><?php echo $p['pointFields']['email']->uf_fieldvalue; ?></td>
					<td class="center manage-point">
						<form action="<?= $statusUrl; ?>" method="post" accept-charset="utf-8" class="point-actions-form  form form-status" id="point-status-change-<?= $p['pointData']->p_id; ?>">
							<input type="hidden" class="row-status" name="status" value="<?= $p['pointData']->p_active; ?>" />
							<input type="submit" name="status-link" value="" id="deactivate-point" class="status-link <?= $statusClass ?>">
						</form>
						<form action="<?php echo site_url('/admin/map/editpoint/'.$p['pointData']->p_id); ?>" method="post" accept-charset="utf-8" class="point-actions-form" id="edit-point-form">
							<input type="submit" name="status-link" value="" alt="Edit This Point" id="edit-point" class="edit-point">
						</form>
						<form action="<?php echo site_url('/admin/map/deletepoint/'.$p['pointData']->p_id); ?>" method="post" accept-charset="utf-8" class="point-actions-form dataTable-delete form" id="delete-point-form">
							<input type="submit" name="status-link" value="" alt="Delete This Point" id="deactivate-point" class="delete-point delete-item">
						</form>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>