
<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Planètes <small>Modifiers des planètes du planétarium</small></h1>
			</div>

				<div class="panel-body">

					<form action="/inscriptions/admin/planets/edit" method="post">
						<input type="hidden" name="submitaction" value="edit">
						<input type="hidden" name="id" value="new">

						<button type="submit" class="btn btn-warning">
							<i class="fa fa-plus-circle fa-2x"></i>
							<div>Nouvelle Planète</div>
						</button>
					</form>

					<hr />

					<div class="row">

						<div class="col-md-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="90">Outils</th>
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
										<button class="edit btn btn-warning btn-xs" data-id="<?php echo $current['id']; ?>" data-toggle="tooltip" title="Modifier"><i class='fa fa-pencil'></i></button>
										<button class="delete btn btn-danger btn-xs" data-url="/inscriptions/admin/planets/erase" data-id='<?php echo $current['id']; ?>' data-toggle="tooltip" title="Supprimer"><i class='fa fa-trash'></i></button>
									</th>
									<?php foreach ($columns as $column_name => $field_name) { ?>
										<td><?php echo str_cut($current[$field_name], 60); ?></td>
									<?php } ?>
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

<form id="form-edit" action="/inscriptions/admin/planets/edit" method="post" class="hidden">
	<input name="submitaction" value="edit">
	<input id="id" name="id" value="">
</form>

<div id="confirm" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation de suppression</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir supprimer cette planète ?</p>

      </div>
      <div class="modal-footer">
	    <button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
	    <button type="button" data-dismiss="modal" class="btn btn-warning" id="delete"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->