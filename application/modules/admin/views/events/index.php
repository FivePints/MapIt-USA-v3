<div class="block-border">
	<div class="block-header">
		<h1>All Events</h1>
	</div>
	<div class="block-content">
		<table id="view-map-table" class="table">
			<thead>
				<tr>
					<th>Event Name</th>
					<th>Address</th>
					<th>Event Start</th>
					<th>Event End</th>
					<th class="manage-point">Manage Event</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($points as $p){ ?>

			<?php
			switch($p['pointData']->p_active){
				case '1':
					$statusUrl = site_url('/admin/events/status/'.$p['pointData']->p_id);
					$statusClass = 'status-link-deactivate';
				break;
				case '0':
					$statusUrl = site_url('/admin/events/status/'.$p['pointData']->p_id);
					$statusClass = 'status-link-activate';
				break;
			}?>
				<tr>
					<td class="center"><?php echo $p['pointData']->p_event_text_short; ?></td>
					<td class="center">
						<?php echo $p['pointFields']['address1']->uf_fieldvalue; ?><br>
						<?php if( $p['pointFields']['address2']->uf_fieldvalue ): echo $p['pointFields']['address2']->uf_fieldvalue."<br>"; endif; ?>
						<?php echo $p['pointFields']['city']->uf_fieldvalue; ?>,&nbsp;<?php echo $p['pointFields']['state']->uf_fieldvalue; ?>&nbsp;<?php echo $p['pointFields']['zip']->uf_fieldvalue; ?>
					</td>
					<td class="center"><?php echo $p['pointData']->p_start_time; ?></td>
					<td class="center"><?php echo $p['pointData']->p_expire_time; ?></td>
					<td class="center manage-point">
						<form action="<?= $statusUrl; ?>" method="post" accept-charset="utf-8" class="point-actions-form  form form-status" id="point-status-change-<?= $p['pointData']->p_id; ?>">
							<input type="hidden" class="row-status" name="status" value="<?= $p['pointData']->p_active; ?>" />
							<input type="submit" name="status-link" value="" id="deactivate-point" class="status-link <?= $statusClass ?>">
						</form>
						<form action="<?php echo site_url('/admin/events/edit/'.$p['pointData']->p_id); ?>" method="post" accept-charset="utf-8" class="point-actions-form" id="edit-point-form">
							<input type="submit" name="status-link" value="" alt="Edit This Point" id="edit-point" class="edit-point">
						</form>
						<form action="<?php echo site_url('/admin/events/delete/'.$p['pointData']->p_id); ?>" method="post" accept-charset="utf-8" class="point-actions-form dataTable-delete form" id="delete-point-form">
							<input type="submit" name="status-link" value="" alt="Delete This Point" id="deactivate-point" class="delete-point delete-item">
						</form>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>