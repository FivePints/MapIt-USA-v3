<?php
$category = array(
	'name' => 'category',
	'id' => 'category',
	'title' => 'This is the Category Name',
	'value' => '',
	'size' => 30
);
?>
<div class="block-border">
	<div class="block-header"><h1>Add Category</h1></div>
	<form method="POST" action="/admin/categories/processadd.html" id="add-category-form" class="block-content form">
		<fieldset>
			<p>Fill the form field out below with the <strong>Category Name</strong>, the category will be converted to Uppercase and entered into the database</p>
			<div class="_75">
					<p><?php echo form_label('Category Name', $category['id']); ?><?php echo form_input($category); ?></p>
					<?php echo form_error($category['id']); ?>
			</div>
			<?php if($mapConfig->events == 1): ?>
			<div class="_25">
				<p><label for="categoryType">Category Type</label>
					<select name="categoryType" class="chzn-select">
						<option value="default" selected="selected">Default</option>
						<option value="event" >Event</option>
					</select>
				</p>
			</div>
			<?php endif; ?>
		</fieldset>
		<div class="clear height-fix"></div>
		<div class="block-actions">
			<ul class="actions-left">
				<li><a class="close-toolbox button red" href="javascript:void(0);">Reset</a></li>
			</ul>
			<ul class="actions-right">
				<li><input id="config-form-submit" type="submit" class="button" value="Create It!"></li>
			</ul>
		</div>
	</form>

</div>
