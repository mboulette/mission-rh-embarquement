<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-users"></i> Personnages <small>Liste de vos personnages</small></h1>
			</div>


				<div class="bg-icon hidden-xs fa fa-users"></div>

				<div class="panel-body">


					<div class="row">
						<?php foreach ($charactersList as $char) { ?>

						<div class="col-md-6 card-conteiner">
							<div class="card card-character">
								
								<form action="/inscriptions/characters/edit" method="post">
									<div class="row">
										<div class="col-xs-3 col-sm-3">
											<img src="<?php echo $char['profession']['picture_url']; ?>" alt="<?php echo $char['profession']['name']; ?>" title="<?php echo $char['profession']['name']; ?>" class="img-thumbnail">
											
											<div class="row" style="margin-top: 3px;">
												<div class="col-xs-12 col-sm-12">
													<img src="<?php echo $char['race']['picture_url']; ?>" alt="<?php echo $char['race']['name']; ?>" title="<?php echo $char['race']['name']; ?>"  width="47%" class="img-thumbnail">
													<img src="<?php echo $char['corporation']['picture_url']; ?>" alt="<?php echo $char['corporation']['name']; ?>" title="<?php echo $char['corporation']['name']; ?>"  width="47%" class="img-thumbnail pull-right">
												</div>
											</div>
										</div>
										<div class="col-xs-9 col-sm-9">

											<h3>
												<?php
												echo $char['name']; 
												if ($char['dead']) echo '&nbsp;<img src="/inscriptions/img/ico-dead.svg.php?fill=d9534f" style="margin-bottom:4px; width:18px;">';
												?>
											</h3>
											<hr>
											<p><?php echo $char['notes']; ?></p>
											<p>
												<input type="hidden" name="id_character" value="<?php echo $char['id']; ?>">
												<?php if ($char['level'] == 0) { ?>
													
													<button type="submit" class="btn btn-warning hidden-xs"><i class="fa fa-pencil"></i> &nbsp;Modifier</button>
													<button data-id="<?php echo $char['id']; ?>" type="button" class="btn btn-default delete_character hidden-xs"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>

													<button type="submit" class="btn btn-warning btn-block btn-lg visible-xs-block"><i class="fa fa-pencil"></i> &nbsp;Modifier</button>
													<button data-id="<?php echo $char['id']; ?>" type="button" class="btn btn-default delete_character btn-block btn-lg visible-xs-block"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
												<?php } else { ?>
													<button type="submit" class="btn btn-default"><i class="fa fa-search "></i> &nbsp;Détails</button>
												<?php }?>
											</p>

										</div>
										
									</div>
									<div class="row">
										<div class="col-sm-9 text-right pull-right text-warning hidden-xs">Date de création : <?php echo $char['date_created']; ?></div>
									</div>
									<div class="ribbon"><span>Niveau <?php echo $char['level']; ?></span></div>
								</form>

							</div>
						</div>

						<?php } ?>

						<div class="col-md-3">
							<form action="/inscriptions/characters/edit" method="post">
								<input type="hidden" name="id_character" value="0">

								<button type="submit" class="btn btn-warning btn-block">
									<i class="fa fa-user-plus" style="font-size:300%;"></i>
									<div>Nouveau personnage</div>
								</button>
							</form>

						</div>

					</div>

				</div>
				<div class="panel-footer text-right">
					
				</div>
		

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>


<div id="confirm" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation de suppression</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir supprimer ce personange ?</p>

      </div>
      <div class="modal-footer">
	    <button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
	    <button type="button" data-dismiss="modal" class="btn btn-warning" id="delete"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
