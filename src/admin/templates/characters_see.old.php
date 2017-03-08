<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Personnage <small><?php echo str_cut($character['name'], 60); ?></small></h1>
			</div>


			<div class="panel-body">

				<div class="form-horizontal">

					<div class="hidden-xs">
						<a href="/inscriptions/admin/characters" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste</a>
						<button class="btn btn-danger tool" data-modal="modal-delete" <?php if (count($inscriptions) > 0) echo 'disabled' ?> ><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer</button>
						
						<?php if ($character['dead'] == 0) { ?>
							<button class="btn btn-warning tool" data-modal="modal-kill"><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Tuer</button>
						<?php } else { ?>
							<button class="btn btn-warning tool" data-modal="modal-unkill"><i class="fa fa-child" aria-hidden="true"></i> &nbsp;Ressusciter</button>
						<?php } ?>					

						<button class="btn btn-default tool" data-modal="modal-levelup"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;Level Up</button>
						<button class="btn btn-default tool" data-modal="modal-edit"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Modifier</button>

						<hr />

						<div class="alert alert-info alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							<p><strong><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste :</strong> Ce bouton permet de retourner à la liste des personnages</p>
							<p><strong><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer :</strong> Ce bouton permet de supprimer complètement le personnage. C'est essentiellement pour supprimer des spamers, ou des tests de certains clients. Vous ne pouvez pas supprimer des personnages qui ont déjà participé à des évènements.</p>
							<p><strong><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Tuer :</strong> Ce bouton permet de tuer un personnage, ce dernier ne pourra plus être utilisé lors d'une inscription.</p>
							<p><strong><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;Level Up :</strong> Ce bouton vous permet d'ajouter un niveau à ce personnage, en ajoutant un niveau, certaines nouveaux pouvoirs pourrait être disponible.</p>
							<p><strong><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Modifier :</strong> Ce bouton permet de modifier un personnage, il permet de faire des changements impossible par le joueur.</p>
						</div>


					</div>

					<div class="visible-xs-block">

						<a href="/inscriptions/admin/characters" class="btn btn-primary btn-lg btn-block" style="margin: 3px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste</a>
						<button class="btn btn-danger btn-lg btn-block tool" data-modal="modal-delete" style="margin: 3px;" <?php if (count($inscriptions) > 0) echo 'disabled' ?> ><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer</button>
						
						<?php if ($character['dead'] == 0) { ?>
							<button class="btn btn-warning btn-lg btn-block tool" data-modal="modal-kill" style="margin: 3px;"><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Tuer</button>
						<?php } else { ?>
							<button class="btn btn-warning btn-lg btn-block tool" data-modal="modal-unkill" style="margin: 3px;"><i class="fa fa-child" aria-hidden="true"></i> &nbsp;Ressusciter</button>
						<?php } ?>					

						<button class="btn btn-default btn-lg btn-block tool" data-modal="modal-levelup" style="margin: 3px;"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;Level Up</button>
						<button class="btn btn-default btn-lg btn-block tool" data-modal="modal-edit" style="margin: 3px;"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Modifier</button>

					</div>


					<div class="row">
						<div class="col-md-6 col-xs-12">
							<h3><?php echo $character['name']; ?>
								<?php 
								echo '<span class="label label-default">Niveau '.$character['level'].'</span>';
								if ($character['dead']) echo '&nbsp;<span class="label label-danger">&nbsp;<img src="/inscriptions/img/ico-dead.svg.php?fill=fff" style="margin-bottom:4px; width:18px;"> '.'Mort'.'</span>';
								?>
							</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-xs-4 text-center">
							<h5>Race</h5>
							<img src="<?php echo $character['race']['picture_url']; ?>" class="img-thumbnail" width="140">
							<h4><?php echo $character['race']['name']; ?></h4>
						</div>
						<div class="col-md-2 col-xs-4 text-center">
							<h5>Profession</h5>
							<img src="<?php echo $character['profession']['picture_url']; ?>" class="img-thumbnail" width="140">
							<h4><?php echo $character['profession']['name']; ?></h4>
						</div>
						<div class="col-md-2 col-xs-4 text-center">
							<h5>Corporation</h5>
							<img src="<?php echo $character['corporation']['picture_url']; ?>" class="img-thumbnail" width="140">
							<h4><?php echo $character['corporation']['name']; ?></h4>
						</div>

						<div class="col-md-2 col-md-offset-2">
							<div>&nbsp;</div>
							<strong>Créé le</strong>
							<div><?php echo substr($character['date_created'], 0, 10); ?></div>

							<div>&nbsp;</div>
							<strong>Modifié le</strong>
							<div><?php echo substr($character['date_updated'], 0, 10); ?></div>
						</div>
					</div>

					<hr />
					<h3>Courtes description</h3>
					<p><?php echo nl2br($character['notes']); ?></p>
					
					<hr />
					<h3>Historique (Background)</h3>
					<p>
						<?php
						if ($character['background'] == ""){
							echo 'Il n`y a aucun historique d`entré pour ce personnage.';
						} else {
							echo nl2br($character['background']);
						}
						?>
					</p>

					<hr />

					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						
						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="headingOne">
								<h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="fa fa-user-circle"></i>&nbsp;
								  	Joueur
									<span class="caret"></span>
								</h3>
							</div>

							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-2"><img src="<?php echo $player['picture_url']; ?>" class="img-thumbnail" width="140"></div>
										<div class="col-sm-10">
											
											<form id="form-edit" action="/inscriptions/admin/players/display" method="post">
												<input type="hidden" name="submitaction" value="display">
												<input type="hidden" name="id" value="<?php echo $player['id']; ?>">
												<h3 style="margin-top:5px;"><?php echo $player['firstname']; ?> <?php echo $player['lastname']; ?>
													<button class=" btn btn-primary btn-xs" data-toggle="tooltip" title="Détails"><i class='fa fa-search'></i></button>
												</h3>
											</form>

											
											<table>

												<tr><th style="text-align: left; padding-right:20px;">Courriel<th><td><a href="mailto:<?php echo $player['email']; ?>"><?php echo $player['email']; ?></a><td></tr>
												<tr><th style="text-align: left; padding-right:20px;">Date de naissance<th><td>
													<?php
													$d = new DateTime($player['birthday']);
													echo $d->format('j').' '.$GLOBALS['month_abbr'][$d->format('n')].' '.$d->format('Y');
													?>
												<td></tr>
												<tr><th style="text-align: left; padding-right:20px;">Sexe<th><td>
													<?php
													if ($player['gender'] == 'M') {
														echo '<i class="fa fa-mars"></i> &nbsp;Masculin';
													} else {
														echo '<i class="fa fa-venus"></i> &nbsp;Féminin';
													}
													?>
												<td></tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="heading3">
								<h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
									<i class="glyphicon glyphicon-paperclip"></i>&nbsp;
								  	Liste des pièces jointes
									<span class="caret"></span>
								</h3>
							</div>

							<div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12 table-responsive">
											
											<?php if (count($files) > 0) { ?>
											<table class="table table-striped table-hover">
												<thead>
													<tr>
														<th width="60">Outils</th>
														<th>Nom</th>
														<th>Type</th>
														<th>Taille</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($files as $file) { ?>
													<tr class='action'>
														<td><button class="list-action btn btn-primary btn-xs" data-form="form-auto" data-id="0" data-action="<?php echo $file['path']; ?>" data-toggle="tooltip" title="Télécharger"><i class='fa fa-download'></i></button></td>
														<td><strong><?php echo str_cut($file['name'], 60); ?></strong></td>
														<td><?php echo str_cut($file['type'], 60); ?></td>
														<td><?php echo str_cut($file['size'], 60); ?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>

											<?php } else { ?>
												Ce client n'a pas de pièce jointe!
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="panel panel-primary">

							<div class="panel-heading" role="tab" id="heading2">
								<h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
									<i class="fa fa-calendar"></i>&nbsp;
								  	Liste des participations
									<span class="caret"></span>
								</h3>
							</div>

							<div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12 table-responsive">
											
											<?php if (count($inscriptions) > 0) { ?>
											<table class="table table-striped table-hover">
												<thead>
													<tr>
														<th width="60">Outils</th>
														<th>Date</th>
														<th>Nom</th>
														<th>Synopsis</th>
														<th>Nombre de place</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($inscriptions as $event) { ?>
													<tr class='action'>
														<td><button class="list-action btn btn-primary btn-xs" data-form="form-auto" data-id="<?php echo $inscriptions['id']; ?>" data-action="/inscriptions/admin/attendees/display/" data-toggle="tooltip" title="Détails"><i class='fa fa-search'></i></button></td>
														<td><strong><?php echo substr($event['date_event'], 0, 10); ?></strong></td>
														<td><?php echo str_cut($event['name'], 60); ?></td>
														<td><?php echo str_cut($event['synopsis'], 60); ?></td>
														<td><?php echo str_cut($event['max_places'], 60); ?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>

											<?php } else { ?>
												Ce client n'a participé à aucune évènement!
											<?php } ?>
										</div>
									</div>
								</div>
							</div>

						</div>



					</div>

				</div>



				
			</div>
			<div class="panel-footer text-right">

			</div>
			
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>


<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation de suppression</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir supprimer le personnage «<?php echo $character['name']; ?>»?</p>

      </div>
      <div class="modal-footer">
	    <form method="post" action="/inscriptions/admin/characters/erase/">
			<input name="submitaction" type="hidden" value="erase">
			<input name="id" type="hidden" value="<?php echo $character['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-primary"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-kill" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation de mort</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir tuer le personnnage «<?php echo $character['name']; ?>»? Ce dernier ne pourra plus être utilisé lors d'une inscription.</p>

      </div>
      <div class="modal-footer">
	    <form method="post" action="/inscriptions/admin/characters/kill/">
			<input name="submitaction" type="hidden" value="kill">
			<input name="id" type="hidden" value="<?php echo $character['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-primary"><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Tuer</button>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-unkill" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation de résurrection</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir ressuscité le personnage «<?php echo $character['name']; ?>»?</p>

      </div>
      <div class="modal-footer">
	    <form method="post" action="/inscriptions/admin/characters/kill/">
			<input name="submitaction" type="hidden" value="unkill">
			<input name="id" type="hidden" value="<?php echo $character['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-primary"><i class="fa fa-child" aria-hidden="true"></i> &nbsp;Ressusciter</button>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-levelup" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation de Level-Up</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir ajouter un niveau au personnage «<?php echo $character['name']; ?>» ?</p>

      </div>
      <div class="modal-footer">
	    <form method="post" action="/inscriptions/admin/characters/levelup/">
			<input name="submitaction" type="hidden" value="levelup">
			<input name="id" type="hidden" value="<?php echo $character['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-primary"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;Level Up</button>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier un personnage</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir modifier le personnage «<?php echo $character['name']; ?>» ?</p>

      </div>
      <div class="modal-footer">
	    <form method="post" action="/inscriptions/admin/characters/edit/">
			<input name="submitaction" type="hidden" value="edit">
			<input name="id" type="hidden" value="<?php echo $character['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Modifier</button>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<form id="form-auto" target="_blank" method="post" class="hidden">
	<input type="text" name="id">
</form>
