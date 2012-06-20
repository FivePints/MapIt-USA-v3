<div class="grid_12">
	<div class="block-border" id="tab-graph">
		<div class="block-header">
			<h1>Graph</h1>
		</div>
		<div class="block-content">
			<table id="graph-data" class="graph">
					<caption>Top 5 Categories</caption>
					<thead>
						<tr>
							<td></td>
							<?php foreach ($chart as $c): ?>
								<th scope="col"><?= $c->category_name ?></th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($chart as $c): ?>
						<tr>
							<th scope="row"><?= $c->category_name ?></th>
							<td><?= $c->count; ?></td>
						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
			<div id="tab-pie"></div>					
		</div>
	</div>
</div>

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