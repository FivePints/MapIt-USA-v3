<?php 
$byCategory = $chart['byCategory']['data'];
?>
<div class="hero-unit" id="graph-hero-container">
	<button class="close">&times;</button>
	<h3><?= $chart['byCategory']['title']; ?></h3>
	<div class="graph-centering">
		<table id="graph-data" class="graph">
			<thead>
				<tr>
					<td></td>
					<?php foreach ($byCategory as $c): ?>
						<th scope="col"><?= $c->category_name ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($byCategory as $c): ?>
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