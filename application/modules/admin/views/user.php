<div class="block-border">
	<div class="block-header">
		<h1>All Users</h1>
	</div>
	<div class="block-content">
		<table id="view-user-table" class="table">
			<thead>
				<tr>
					<th class="center">ID</th>
					<th class="center">Username</th>
					<th class="center">Email Address</th>
					<th class="center">First & Last name</th>
					<th class="center">Registration Date</th>
					<th class="center">Last Login Date</th>
					<th class="center">User Level</th>			
					<th class="center manage-point">Manage User</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user){ 
				if ($user->banned == 1){
					$user->status = 'BANNED';
				}else{
					if ($user->activated == 1){
						$user->status = 'Active';
					}else{
						$user->status = 'Inactive';
					}
				}
			switch($user->activated){
				case '1':
					$statusClass = 'status-link-deactivate';	
					$statusUrl = site_url('/admin/user/status/'.$user->id);
					$statusLink = 'Deactivate';
				break;
				case '0':
					$statusClass = 'status-link-activate';
					$statusUrl = site_url('/admin/user/status/'.$user->id);
					$statusLink = 'Activate';
				break;
			}?>
				<tr>
					<td class="center"><?php echo $user->id; ?></td>
					<td class="center"><?php echo $user->username; ?></td>
					<td class="center"><?php echo $user->email; ?></td>
					<td class="center"><?php echo $user->firstname.' '.$user->lastname; ?></td>
					<td class="center"><?php echo date('m/d/Y g:i:s', $user->created); ?></td>
					<td class="center"><?php echo date('m/d/Y g:i:s', $user->last_login ); ?></td>
					<td class="center"><?php if ($user->user_level == 1){ echo '('.$user->user_level.') User';}elseif($user->user_level == 2){ echo '('.$user->user_level.') Administrator'; }elseif($user->user_level > 2){ echo '('.$user->user_level.') Super Admin'; } ?></td>
					<td class="center manage-point">
						<form action="<?= $statusUrl; ?>" method="post" accept-charset="utf-8" class="point-actions-form form form-status" id="point-status-change-<?= $user->id; ?>">
							<input type="hidden" class="row-status" name="status" value="<?= $user->activated; ?>" />
							<input type="submit" name="status-link" value="" id="deactivate-point" class="status-link <?= $statusClass ?>">
						</form>
						<form action="<?php echo site_url('/admin/user/edituser/'.$user->id); ?>" method="post" accept-charset="utf-8" class="point-actions-form" id="edit-point-form">
							<input type="submit" name="status-link" value="" alt="Edit This Point" id="edit-point" class="edit-point">
						</form>
						<form action="<?php echo site_url('/admin/user/deleteuser/'.$user->id); ?>" method="post" accept-charset="utf-8" class="point-actions-form  dataTable-delete form" id="delete-point-form">
							<input type="submit" name="status-link" value="" alt="Delete This Point" id="deactivate-point" class="delete-point delete-item">
						</form>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>