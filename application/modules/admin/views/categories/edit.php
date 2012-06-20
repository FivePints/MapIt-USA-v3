<?php
$cat = array(
	'name' => 'category',
	'id' => 'category',
	'title' => 'This is the Category Name',
	'value' => $category->category_name,
	'size' => 30
);
?>
<div class="block-border">
	<div class="block-header"><h1>Add Category</h1></div>
	<form method="POST" action="/admin/categories/processedit/<?= $category->id; ?>.html" id="add-category-form" class="block-content form">
		<div class="_100">
			<fieldset>
				<p>Fill the form field out below with the <strong>Category Name</strong>, the category will be converted to Uppercase and entered into the database</p>
				<p><?php echo form_label('Category Name', $cat['id']); ?><?php echo form_input($cat); ?></p>
				<?php echo form_error($cat['id']); ?>

			</fieldset>
		</div>
		<div class="clear height-fix"></div>
		<div class="block-actions">
			<ul class="actions-left">
				<li><a class="close-toolbox button red" href="javascript:void(0);">Reset</a></li>
			</ul>
			<ul class="actions-right">
				<li><input id="config-form-submit" type="submit" class="button" value="Edit It!"></li>
			</ul>
		</div>
	</form>

</div>
