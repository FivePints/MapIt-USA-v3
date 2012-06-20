<div class="block-border">
	<div class="block-header">
		<h1>All Cron Tasks</h1>
	</div>
	<div class="block-content">

		<table id="view-crontasks-table" class="table">
			<thead>
				<tr>
					<th class="center">ID</th>
					<th class="center">Task</th>
					<th class="center">Total Runs</th>
					<th class="center">Last Run Date</th>		
					<th class="center manage-crontasks">Manage</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($cron_tasks as $c): ?>
				<tr>
					<td class="center"><?php echo $c->id; ?></td>
					<td class="center"><?php echo $c->cron_task; ?></td>
					<td class="center"><?php echo $c->total_runs; ?></td>
					<td class="center"><?php echo date('m/d/Y g:i:s', $c->last_run_on); ?></td>
					<td class="center manage-crontasks">
						<form action="<?= site_url('/admin/cron/forcerun/'.$c->id); ?>" method="post" accept-charset="utf-8" class="point-actions-form form form-status" id="force-run-cron-form">
							<input type="submit" name="" value="" id="force-run" class="force-run-cron">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>