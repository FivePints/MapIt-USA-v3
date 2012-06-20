<?php
$config->email_response_days = '1';
$config->support_email_address = 'support@mapitusa.com';
?>
<html>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor='#e6e6e6' font-family='verdana'>
	<table width="100%"cellpadding="10" cellspacing="0" class="backgroundTable" bgcolor='#e6e6e6' >
		<tr>
			<td valign="top" align="center">
				<table width="801px" cellpadding="0" cellspacing="0" bgcolor='#ffffff'>
					<tr height="122px">
						<td valign="top" align="center" style="padding-top:10px">
							<img src="http://dev.mapitusa.com/images/user/logo-large.png" alt="Logo" title="Logo" />
						</td>
					</tr>
					<tr height="110px">
						<td align="left" valign="top" style="padding-top:20px;padding-left:20px;padding-right:20px">
							<p style="font-size:20px; font-family: Trebuchet MS,Helvetica;">Thank you for your purchase</p>
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">
								This is a confirmation email. <br>Your order has been received and will be processed within <?= $config->email_response_days; ?> business day(s).
							</p>
						</td>
					</tr>
				</table>
				<table width="801px" cellpadding="0" cellspacing="0" bgcolor='#ffffff'>
					<tr>
						<td align="left" valign="top" style="width:50px;padding-top:5px;padding-left:10px;padding-right:10px;padding-bottom:5px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">
								<strong>Name</strong>
							</p>
						</td>
						<td align="left" valign="top" style="padding-top:5px;padding-left:10px;padding-right:10px;padding-bottom:5px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">
								<?php echo $first_name ?> <?php echo $last_name ?>
							</p>
						</td>
					</tr>
				</table>
				<table width="801px" cellpadding="0" bgcolor='#ffffff'>
					<tr style="background-color:#efefef;">
						<td align="left" style="padding-left:20px;padding-right:5px;padding-top:10px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;">Item</p>
						</td>
						<td align="center" style="padding-left:5px;padding-right:5px;padding-top:10px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;">Quantity</p>
						</td>
						<td align="center" style="padding-left:5px;padding-right:5px;padding-top:10px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;">Cost per item</p>
						</td>
						<td align="right" style="padding-left:5px;padding-right:20px;padding-top:10px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;">Total cost</p>
						</td>
					</tr>
				<?php foreach ($items  as $i): ?>
					<tr>
						<td style="padding-left:20px;padding-right:5px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;"><?php echo $i['item_name'] ?></p>
						</td>
						<td align="center" style="padding-left:5px;padding-right:5px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;"><?php echo $i['quantity'] ?></p>
						</td><td align="center" style="padding-left:5px;padding-right:5px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;"><?php echo $i['cost_per_item'] ?></p>
						</td><td align="right" style="padding-left:5px;padding-right:20px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;"><?php echo $i['mc_gross'] ?></p>
						</td>
					</tr>
				<?php endforeach; ?>
					<tr>
						<td style="padding-top:5px;" colspan="4">
							<hr style="width:790px; background-color:#cccccc; height:1px; border:0;">
						</td>
					<?php if ($discount > 0): ?>
						<tr>
							<td style="padding-left:20px;padding-right:5px;padding-top:5px;" colspan="3">
								<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">Discount</p>
							</td>
							
							<td align="right" style="padding-left:20px;padding-right:20px;padding-top:5px;">
								<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">-<?php echo $discount ?></p>
							</td>
						
						</tr>
					<?php endif; ?>
					<tr style=" background-color:whitesmoke;">
						<td style="padding-left:20px;padding-right:5px;padding-top:0px;" colspan="3">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;"><strong>GRAND TOTAL</strong></p>
						</td>
						<td align="right" style="padding-left:20px;padding-right:20px;padding-top:5px;">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;"><?php echo $mc_gross ?></p>
						</td>
					</tr>
					<tr>
						<td style="padding-left:20px;padding-right:20px;padding-top:15px;padding-bottom:20px;" colspan="4">
							<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">If you have any questions regarding your order, don't hesitate to contact us at <a href="mailto:<?= $config->support_email_address; ?>"> <?= $config->support_email_address; ?></a></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>