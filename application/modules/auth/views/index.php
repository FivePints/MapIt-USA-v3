<div class="grid_12">
<div class="block-border">
	<div class="block-header">
		<h1>Your Map Points</h1>
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
				<tr>
					<td class="center"><?php echo $p['pointFields']['companyname']->uf_fieldvalue; ?></td>
					<td class="center"><?php echo $p['pointData']->p_lat; ?></td>
					<td class="center"><?php echo $p['pointData']->p_lng; ?></td>
					<td class="center"><?php echo $p['pointData']->p_level; ?></td>
					<td class="center"><?php echo $p['pointFields']['contactname']->uf_fieldvalue; ?></td>
					<td class="center"><?php echo $p['pointFields']['phone1']->uf_fieldvalue; ?></td>
					<td class="center"><?php echo $p['pointFields']['email']->uf_fieldvalue; ?></td>
					<td class="center manage-point">

						<form action="<?php echo site_url('/profile/map/editpoint/'.$p['pointData']->p_id); ?>" method="post" accept-charset="utf-8" class="point-actions-form" id="edit-point-form">
							<input type="submit" name="status-link" value="" alt="Edit This Point" id="edit-point" class="edit-point">
						</form>

					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
</div><!-- end grid_12 -->

<div class="grid_4">
	<div class="block-border">
		<div class="block-header">
			<h1>Latest Statistics</h1><span></span>
		</div>
		<div class="block-content">
			<ul class="overview-list">
				<li><a href="javascript:void(0);"><span>447</span> Total Points</a></li>
				<li><a href="javascript:void(0);"><span>521</span> Total Visits</a></li>
				<li><a href="javascript:void(0);"><span>132</span> Total Paid Points</a></li>
				<li><a href="javascript:void(0);"><span>174</span> Total Categories</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="grid_4">
	<div class="block-border">
		<div class="block-header">
			<h1>Need Help?</h1><span></span>
		</div>
		<div class="block-content">
		<p>Need help with adding your business to MapIT? Just have a quick question or even need assistance with some design or programming? Get in touch with a live support representative to obtain help.</p>
			<ul class="block-list with-icon">
				<li class="i-16-telephone"><strong>Phone:</strong> +1 (480) 393-0876</li>
				<li class="i-16-mail"><strong>Email:</strong> support@mapitusa.com</li>
				<li class="i-16-balloon"><strong>Twitter:</strong> @mapitusa</li>
			</ul>
		</div>
	</div>
</div>
<div class="grid_4">
	<div class="block-border">
		<div class="block-header">
			<h1>Submit a Support Ticket</h1><span></span>
		</div>
		<form id="validate-form" class="block-content form" action="dashboard.html" method="post">
			<p class="inline-mini-label">
				<label for="subject">Subject</label>
				<input type="text" name="subject" class="required">
			</p>
			<p class="inline-mini-label">
					<label for="post">Message</label>
					<textarea id="post" name="post" class="required" rows="5" cols="40"></textarea>
				</p>
			</p>

			<div class="clear"></div>
			
			<!-- Buttons with actionbar  -->
			<div class="block-actions">
				<ul class="actions-left">
					<li><a class="button red" id="reset-validate-form" href="javascript:void(0);">Cancel</a></li>
				</ul>
				<ul class="actions-right">
					<li><input type="submit" class="button" value="Send Ticket"></li>
				</ul>
			</div> <!--! end of #block-actions -->
		</form>
	</div>
</div>