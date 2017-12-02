
<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Personnages <small>Consulter les fiches de personnages</small></h1>
			</div>

				<div class="panel-body">

					<div class="row">

						<div class="col-md-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="30">#</th>									
									<th width="60">Outils</th>
									<?php foreach ($columns as $column_name => $field_name) { ?>
										<th data-orderby="<?php echo $field_name; ?>" data-orderdir="<?php echo $orderdir; ?>" class="sort-order <?php if ($orderdir != 'desc') echo 'dropup' ?>">
											<?php echo $column_name; ?>
											<span class="<?php if ($orderby == $field_name) echo 'caret' ?>"></span>
										</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								
								<?php $i=1; ?>
								<?php foreach ($list as $current) { ?>

								<tr class='action'>
									<td><?php echo $i++; ?></td>
									<th>
										<button class="edit btn btn-warning btn-xs" data-id="<?php echo $current['id']; ?>" data-toggle="tooltip" title="Détails"><i class='fa fa-search'></i></button>
									</th>
									<?php
									foreach ($columns as $column_name => $field_name) {
										switch ($field_name) {
										case 'player_name' :
											$pic = $current[substr($field_name, 0, -5)]['picture_url'];

											echo '<td>';
											if ($pic != '') echo '<img width="20" src="'.$pic.'" data-toggle="tooltip" title="'.str_cut($current[$field_name], 60).'"> &nbsp;';
											echo '</td>';
											break;

										case 'rank' :
											echo '<td>'.$current['rank'];
											if ($current['dead'] > 0) echo '&nbsp;<img src="/inscriptions/img/ico-dead.svg.php?fill=d9534f" width="16">';
											echo '</td>';
											break;

										case 'corporation_name' :
										case 'race_name' :
										case 'profession_name' :
											$pic = $current[substr($field_name, 0, -5)]['picture_url'];

											echo '<td>';
											if ($pic != '') echo '<img width="20" src="'.$pic.'"> &nbsp;';
											echo str_cut($current[$field_name], 60).'</td>';
											break;
										default :
											echo '<td>'.str_cut($current[$field_name], 60).'</td>';
											break;
										}
									}
									?>
								</tr>
								<?php } ?>
							</tbody>
						</table>

						</div>

					</div>

				</div>
				<div class="panel-footer text-right">
					
				</div>
		

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>

<form id="form-sort" method="post" class="hidden">
	<input name="submitaction" value="sort">
	<input id="orderby" name="orderby" value="">
	<input id="orderdir" name="orderdir" value="">
</form>

<form id="form-edit" action="/inscriptions/admin/characters/display" method="post" class="hidden">
	<input name="submitaction" value="display">
	<input id="id" name="id" value="">
</form>