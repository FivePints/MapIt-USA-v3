<?php
$category = array(
	'name' => 'category',
	'id' => 'category',
	'title' => 'This is the Category Name',
);
?>
<form method="POST" action="/admin/categories/add.html" id="add-category-form" class="well form">
	<fieldset>
		<div class="span12">
			<p>Fill the form field out below with the <strong>Category Name</strong>, the category will be converted to Uppercase and entered into the database</p>
		</div>
		<div class="span5">
			<div class="control-group">
				<?php echo form_label('Category Name', $category['id']); ?>

				<div class="controls">
					<?php echo form_input($category); ?>
				</div>
			</div>
		</div>
		<?php if($mapConfig->events == 1): ?>
		<div class="span5">
			<div class="control-group">
				<label for="categoryType">Category Type</label>
				<div class="controls">
					<select name="categoryType" class="chzn-select">
						<option value="default" selected="selected">Default</option>
						<option value="event" >Event</option>
					</select>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</fieldset>
	<div class="form-actions form-actions-notopmargin">
		<input type="submit" class="btn btn-primary" value="Add Category">
		<input type="reset" class="btn" value="Reset Form">
	</div>
</form>