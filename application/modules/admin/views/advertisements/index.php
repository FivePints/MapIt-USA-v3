<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<table class="table table-striped <?php if($advertisements): echo 'dataTable'; endif; ?>">
	<thead>
		<tr>
			<th class="item-center">Image Name</th>
			<th class="item-center">Advertisement Link</th>
			<th class="item-center">Total Clicks</th>
			<th class="item-center">Total Unique Clicks</th>
			<th class="item-center">Date Added</th>			
			<th class="item-center manage-item ">Manage</th>
		</tr>
	</thead>
	<tbody>
	<?php
	if( $advertisements ):
	foreach ($advertisements as $a){
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
			<td class="item-center"><a href="#" class="advertisement-preview" data-title="<?= $a->title; ?>" data-content='<div style="margin:0 auto; width:100%; text-align:center;"><img src="<?= base_url('/uploads/advertisements').'/'.$a->filename; ?>" /></div>'><?php echo $a->filename; ?></a></td>
			<td class="item-center"><?php echo $a->url; ?></td>
			<td class="item-center"><?php echo $a->totalClicks; ?></td>
			<td class="item-center"><?php echo $a->uniqueClicks; ?></td>
			<td class="item-center"><?php echo date('m/d/Y g:i:s', $a->timestamp); ?></td>
			<td class="item-center manage-item">
				<a href="<?= $statusUrl; ?>" data-status="<?= $a->status; ?>" class="manage-icon <?= $statusClass; ?> item-status"><i class="icon-ban-circle"></i></a>
				<a href="<?= site_url('/admin/advertisements/edit/'.$a->id); ?>" class="manage-icon"><i class="icon-pencil"></i></a>
				<a href="<?= site_url('/admin/advertisements/delete/'.$a->id); ?>" class="manage-icon item-delete"><i class="icon-remove-sign"></i></a>
			</td>
		</tr>
	<?php } else:?>
		<tr>
			<td valign="top" colspan="6" class="">No data available in table</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
