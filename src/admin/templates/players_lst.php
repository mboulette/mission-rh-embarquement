
<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Joueurs <small>Consulter les fiches des joueurs</small></h1>
			</div>

				<div class="panel-body">

					<div class="row">

						<div class="col-md-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="60">Outils</th>
									<th width="60">Pic</th>
									<?php foreach ($columns as $column_name => $field_name) { ?>
										<th data-orderby="<?php echo $field_name; ?>" data-orderdir="<?php echo $orderdir; ?>" class="sort-order <?php if ($orderdir != 'desc') echo 'dropup' ?>">
											<?php echo $column_name; ?>
											<span class="<?php if ($orderby == $field_name) echo 'caret' ?>"></span>
										</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $current) { ?>
								<tr class='action'>
									<th>
										<button class="edit btn btn-primary btn-xs" data-id="<?php echo $current['id']; ?>" data-toggle="tooltip" title="Détails"><i class='fa fa-search'></i></button>
									</th>
									<td><?php if ($current['picture_url'] != '') echo '<img width="20" src="'.$current['picture_url'].'">'; ?></td>
									<?php
									foreach ($columns as $column_name => $field_name) {
										switch ($field_name) {
										case 'gender' :
											echo '<td><i class="fa fa-'.($current['gender'] == 'M' ? 'mars' : 'venus').'"></i> &nbsp;';
											echo ($current['gender'] == 'M' ? 'Masculin' : 'Féminin').'</td>';
											break;
										case 'date_created' :
											echo '<td>'.substr($current[$field_name], 0, 10).'</td>';
											break;
										case 'birthday' :
											$today = new DateTime();
											$birthday = new DateTime($current['birthday']);
											$interval = $today->diff($birthday);

											echo '<td>'.$interval->format('%y ans').'</td>';
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

<form id="form-edit" action="/inscriptions/admin/players/display" method="post" class="hidden">
	<input name="submitaction" value="display">
	<input id="id" name="id" value="">
</form>