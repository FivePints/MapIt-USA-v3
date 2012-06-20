<div class="grid_12">

<!-- Add A New Point -->
<?= $template['partials']['add-new-point-form']; ?>
<!-- List all of the users points -->
<div class="block-border">
	<div class="block-header">
		<h1>Your Map Points</h1>
		<span></span>
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

<!-- <div class="grid_4">
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
</div> -->
<div class="grid_4">
	<div class="block-border">
		<div class="block-header">
			<h1>Need MapIt Profile Help?</h1><span></span>
		</div>
		<div class="block-content">
		<p>Need help adding your business to MapIt or just have a quick question? You can reach one of our support representatives to obtain help. Monday to Friday  8.30am - 5.30pm  PST</p>
			<ul class="block-list with-icon">
				<li class="i-16-telephone"><strong>Phone:</strong> +1 (480) 393-0876</li>
				<li class="i-16-mail"><strong>Email:</strong> support@mapitusa.com</li>
			</ul>
		</div>
	</div>
</div>
<div class="grid_4">
	<div class="block-border" id="submit-a-ticket">
		<div class="block-header">
			<h1>Submit a Support Ticket</h1><span></span>
		</div>
		<form id="validate-form" class="block-content form ticket-submit" action="/error/ticket/send" method="post">
			<input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">
			<input type="hidden" name="username" value="<?= $user['username']; ?>">
			<input type="hidden" name="emailAddress" value="<?= $user['emailAddress']; ?>">
			<input type="hidden" name="firstname" value="<?= $user['firstname']; ?>">
			<input type="hidden" name="lastname" value="<?= $user['lastname']; ?>">
			<input type="hidden" name="userlevel" value="<?= $user['userlevel']; ?>">
			<input type="hidden" name="last_login" value="<?= $user['last_login']; ?>">
			<input type="hidden" name="user_ip" value="<?= $_SERVER['REMOTE_ADDR']; ?>">
			<p>Are you having a problem with the MapIt system?<br> Fill this form out to send a ticket to get it resolved!</p>
			<p class="inline-mini-label">
				<label for="subject">Subject</label>
				<input type="text" name="subject" class="required">
			</p>
			<p class="inline-mini-label">
					<label for="post">Message</label>
					<textarea id="post" name="message" class="required" rows="5" cols="40"></textarea>
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

<div class="grid_4">
	<div class="block-border">
		<div class="block-header">
			<h1>Need Custom Design Help?</h1><span></span>
		</div>
		<div class="block-content">
		<p>Need help and assistance designing a promotional item or a custom QR code? Get in touch with one of our designers to explore your options. Monday to Friday  8.30am - 5.30pm  PST</p>
			<ul class="block-list with-icon">
				<li class="i-16-telephone"><strong>Phone:</strong> +1 (480) 393-0876</li>
				<li class="i-16-mail"><strong>Email:</strong> info@fivepints.com</li>
			</ul>
		</div>
	</div>
</div>