<?php
$category = array(
	'name'	=> 'category',
	'id'	=> 'category',
	'class' => 'chzn-select',
	'maxlength'	=> 80,
	'size'	=> 30
);
$sender_email = array(
	'name'	=> 'sender_email',
	'id'	=> 'sender_email',
	'maxlength'	=> 80,
	'size'	=> 30
);
$sender_name = array(
	'name'	=> 'sender_name',
	'id'	=> 'sender_name',
	'maxlength'	=> 80,
	'size'	=> 30
);
$subject = array(
	'name'	=> 'subject',
	'id'	=> 'subject',
	'maxlength'	=> 80,
	'size'	=> 30
);
$message = array(
	'name'	=> 'message',
	'id'	=> 'message',
	'maxlength'	=> 80,
	'class' => 'mceEditor',
	'size'	=> 30
);

/**
 * Values for dropdown forms elements. 
 * 
 * These are temporary values, which will 
 * eventually pull in from the database.
 * The data here is simply placeholder.
 */
$categories[0] = '----------';
foreach($map['categories'] as $row){
	$categories[$row['id']]=$row['category_name'];
}
?>
<div class="grid_12">
	<div class="block-border">
		<div class="block-header">
			<h1>Send Mass-Email By Category</h1>
			<span></span>
		</div>
		<?php $formAttributes = array( 'id' => 'form', 'class' => 'block-content form form-email');
		echo form_open('/admin/email/send/bycategory', $formAttributes); ?>
			<div class="_50">
				<fieldset>
					<legend>Pick The Categories To Send To</legend>	
					<p><?php echo form_label('Business Category', $category['id']); ?>
					<select name="category" id="category" multiple class="chzn-select serializeElement">
					<?php 
					foreach ($categories as $cK => $cV){
						echo "<option value='$cK'>".$cV."</option>";
					}
					?>
					</select></p>
					<?php echo form_error($category['id']); ?>
				</fieldset>
				<div id="template-fields">
					<h3>Template Tags</h3>
					<p>You Can Use <strong>{contactName}</strong> and <strong>{contactEmail}</strong> to pull in each user's Name and Email addresses to personalize the email <strong>message</strong>.</p>
				</div>
			</div>
			<div class="_50">
				<fieldset>
				<legend>Fill Out The Email Details</legend>
					<p><?php echo form_label('Send From Name', $sender_name['id']); ?><?php echo form_input($sender_name, $mapConfig->default_send_from_name); ?></p>
					<?php echo form_error($sender_name['id']); ?>
					<p><?php echo form_label('Send From Email', $sender_email['id']); ?><?php echo form_input($sender_email, $mapConfig->default_send_from_email); ?></p>
					<?php echo form_error($sender_email['id']); ?>
					<p><?php echo form_label('Email Subject', $subject['id']); ?><?php echo form_input($subject); ?></p>
					<?php echo form_error($subject['id']); ?>
					<p><?php echo form_label('Email Message', $message['id']); ?><?php echo form_textarea($message); ?></p>
					<?php echo form_error($message['id']); ?>
				</fieldset>
			</div>
		<div class="block-actions">
			<ul class="actions-left">
				<li><a class="close-toolbox button red" href="javascript:void(0);">Reset</a></li>
			</ul>
			<ul class="actions-right">
				<li><input type="submit" class="button" value="Send It!"></li>
			</ul>
		</div>
		<?php echo form_close(); ?>
	</div>	
</div>