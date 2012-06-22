<?php
$advertisement = array(
	'name' => 'advertisement',
	'id' => 'advertisement',
	'title' => 'This is the Category Name',
	'value' => 'category',
	'size' => 30
);
?>
<form method="POST" action="/admin/advertisements/add.html" id="add-advertisements-form" class="well form"  enctype="multipart/form-data">
	<fieldset>
		<div class="span12">
			<p>Fill the form out below with the appropriate information to add an advertisement to the right hand side of the Mapit Frontend.</p>
		</div>
		<div class="span5">
			<div class=" control-group">
				<label for="picture-upload">Picture Upload</label>
				<div class="controls">
					<input type="file" name="picture" value="" class="span12" placeholder="">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label for="status">Initial Status</label>
				<div class="controls">
					<input type="hidden" name="status" value="" class="btnField">
					<button class="btnToggle btn" name="status" value="1" data-toggle="button">Activate</button>
				</div>
			</div>
			<div class="control-group">
				<label for="type">Type of Advertisement</label>
				<div class="controls">
					<input type="hidden" name="type" class="btnField">
					<div class="btn-group" data-toggle="buttons-radio">
					  <button class="btnToggle btn radio" value="Video">Video</button>
					  <button class="btnToggle btn radio" value="Picture">Picture</button>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="url">Advertisement URL</label>
				<div class="controls">
					<input type="text" name="url" value="" class="span12" placeholder="Enter A Click-Through URL">
				</div>
			</div>
			<div class="control-group">
				<label for="title">Advertisement Page Title</label>
				<div class="controls">
					<input type="text" name="title" value="" class="span12" placeholder="Enter A Title To Display">
				</div>
			</div>
			<div class="control-group">
				<label for="description">Advertisement Brief Description</label>
				<div class="controls">
					<textarea name="description" value="" class="span12" placeholder="Enter A Brief Description Of the Advertisement"></textarea>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="form-actions form-actions-notopmargin">
		<input type="submit" class="btn btn-primary" value="Create It!">
		<input type="reset" class="btn" value="Reset Form">
	</div>
</form>