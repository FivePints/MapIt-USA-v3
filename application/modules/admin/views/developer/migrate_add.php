<div class="block-border">
	<div class="block-header"><h1><?= $template['title']; ?></h1></div>
	<?php $formAttributes = array( 'id' => 'validate-form', 'class' => 'block-content form');
	echo form_open_multipart($this->uri->uri_string(), $formAttributes); ?>
	<div class="_100">
		<p><strong>The Current Version Is:</strong> <?= $currentMigration->version; ?></p>
	</div>
	<div class="_50">
		<p><?= form_label('Migrations', 'migrations'); ?>
			<select name="migration_version" id="migration_version" >
				<?php foreach ($migrations as $m): ?>
					<option value="<?= $m['version']; ?>"><?= $m['file']; ?></option>
				<?php endforeach; ?>
			</select></p>
	</div>

	<div class="clear"></div>
	<div class="block-actions">
		<ul class="actions-left">
			<li><a class="button red" id="reset-validate-form" href="javascript:void(0);">Reset</a></li>
		</ul>
		<ul class="actions-right">
			<li><input type="submit" class="button" value="Click here to validate the form!"></li>
		</ul>
	</div>
	<?php echo form_close(); ?>
</div>