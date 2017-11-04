
<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Participants <small>Les inscriptions à l'évènement «<?php echo str_cut($event['name'], 60) ?>»</small></h1>
			</div>

				<div class="panel-body">

					<button type="submit" class="btn btn-warning list-action" data-form="form-auto" data-action="/inscriptions/admin/events/excel/" data-id="<?php echo $event['id']; ?>">
						<i class="fa fa-file-excel-o fa-2x"></i>
						<div>Télécharger une liste Excel</div>
					</button>
					&nbsp; 
					<button type="submit" class="btn btn-default list-action" data-form="form-auto" data-action="/inscriptions/admin/events/attendees/print/" data-id="<?php echo $event['id']; ?>">
						<i class="fa fa-print fa-2x"></i>
						<div>Imrpimer les feuilles de perso</div>
					</button>

					<hr />


					<div class="row">

						<div class="col-md-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="80">Outils</th>
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
										<button class="list-action btn btn-warning btn-xs" data-form="form-auto" data-id="<?php echo $current['id']; ?>" data-action="/inscriptions/admin/attendees/display/" data-toggle="tooltip" title="Détails"><i class='fa fa-search'></i></button>
										<button class="list-action btn-health-points btn btn-primary btn-xs" data-id="<?php echo $current['id']; ?>" data-name="<?php echo htmlspecialchars($current['character_name']); ?>" data-health="<?php echo $current['health_points']; ?>" data-toggle="tooltip" data-placement="right" title="Modifier le bilan de santé"><i class="fa fa-heartbeat" aria-hidden="true"></i></button>
									</th>
									<?php
									foreach ($columns as $column_name => $field_name) {
										switch ($field_name) {
											
											case 'player_name' :
												echo '<td>';
												echo '<img width="20" src="'.$current['player_pic'].'">&nbsp;';
												echo $current['player_name'].'</td>';
												break;

											case 'total' :
												echo '<td align="right">'.number_format($current['total'], 2).' $</td>';
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

<form id="form-auto" target="_blank" method="post" class="hidden">
	<input type="text" name="id">
	<input type="text" name="submitaction">
</form>

<form id="form-sort" method="post" class="hidden">
	<input name="id" value="<?php echo $event['id']; ?>">
	<input name="submitaction" value="sort">
	<input id="orderby" name="orderby" value="<?php echo $orderby; ?>">
	<input id="orderdir" name="orderdir" value="<?php echo ($orderdir == 'asc' ? 'desc' : 'asc'); ?>">
</form>


<div id="modal-health" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier le blian de santé</h4>
      </div>
      <form id='modal-health-form' method="post" action="/inscriptions/admin/characters/health/">
	      <div class="modal-body">
			<p>Entrez la nouvelle valeur de santé pour ce personnage «<span id='character_name'></span>» ?</p>

			<div class="row">
				<label for="health_check" class="col-sm-3 control-label">Bilan de santé</label>
				<div class="col-sm-4">
				    <div class="input-group">
				      <input type="number" class="form-control" id="health_check" name="health_check" min="0" max="100" value="">
				      <div class="input-group-addon">%</div>
				    </div>
				</div>
			</div>

	      </div>
	      <div class="modal-footer">
			<input name="submitaction" type="hidden" value="from_lst">
			<input id='id_inscription' name="id" type="hidden" value="">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-save" aria-hidden="true"></i> &nbsp;Enregistrer</button>
	      </div>
  	  </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
