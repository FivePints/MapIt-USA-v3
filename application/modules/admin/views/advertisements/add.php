<?php
$advertisement = array(
	'name' => 'advertisement',
	'id' => 'advertisement',
	'title' => 'This is the Category Name',
	'value' => 'category',
	'size' => 30
);
?>
<div class="block-border">
	<div class="block-header"><h1>Add Category</h1></div>
	<form method="POST" action="/admin/advertisements/processadd.html" id="add-advertisements-form" class="block-content form"  enctype="multipart/form-data">
		<div class="_100">
			<fieldset>
				<p>Fill the form out below with the appropriate information to add an advertisement to the right hand side of the Mapit Frontend.</p>
				<div class="_50">
					<div class="_50">
						<label for="youtube">YouTube Video (123x123)</label>
						<p>Paste in a URL to a YouTube video and the form will process and insert the video with the correct dimensions</p>
						<input type="text" name="youtube" value="" placeholder="Enter A URL To a YouTube Video">

						<p><img src="http://placehold.it/200x160" /></p>
					</div>
					<div class="_50">
						<label for="picture-upload">Picture Upload</label>
						<p>Use this to upload a picture for an advertisement, instead of using a video.</p>
						<input type="file" name="picture" value="" placeholder="">
						<p><img src="http://placehold.it/200x160" /></p>
					</div>
				</div>	
				<div class="_50">
					<div class="_50">
						<label for="status">Initial Status</label>
						<select name="status">
							<option value="1" selected="selected">Activated</option>
							<option value="0">Deactivated</option>
						</select>
					</div>
					<div class="_50">
						<label for="type">Type of Advertisement</label>
						<select name="type">
							<option value="Picture" selected="selected">Picture</option>
							<option value="Video">Video</option>
						</select>
					</div>
					<div class="_100">
						<p><label for="url">Advertisement URL</label>
						<input type="text" name="url" value="" placeholder="Enter A Click-Through URL"></p>

						<p><label for="title">Advertisement Page Title</label>
						<input type="text" name="title" value="" placeholder="Enter A Title To Display"></p>

						<p><label for="description">Advertisement Brief Description</label>
						<input type="text" name="description" value="" placeholder="Enter A Brief Description Of the Advertisement">
					</div>
				</div>
			</fieldset>
		</div>
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
