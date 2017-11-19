<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Personnage <small><?php echo str_cut($character['name'], 60); ?></small></h1>
			</div>


			<div class="panel-body">

				<div class="form-horizontal">

					<div class="hidden-xs">
						<a href="/inscriptions/admin/characters" class="btn btn-warning backlink"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste</a>
						<?php if ($_SESSION['player']['admin'] > 1) { ?>
							<button class="btn btn-danger tool" data-modal="modal-delete" <?php if (count($inscriptions) > 0) echo 'disabled' ?> ><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer</button>
						<?php } ?>
						<?php if ($character['dead'] == 0) { ?>
							<button class="btn btn-primary tool" data-modal="modal-kill"><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Tuer</button>
						<?php } else { ?>
							<button class="btn btn-primary tool" data-modal="modal-unkill"><i class="fa fa-child" aria-hidden="true"></i> &nbsp;Ressusciter</button>
						<?php } ?>

						<button class="btn btn-default tool" data-modal="modal-rankup"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;Monter de grade</button>
						<button class="btn btn-default tool" data-modal="modal-health"><i class="fa fa-heartbeat" aria-hidden="true"></i> &nbsp;Changer le bilan</button>

						<?php if ($_SESSION['player']['admin'] > 1) { ?>
							<button class="btn btn-default tool" data-modal="modal-edit"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Modifier</button>
						<?php } ?>

						<hr />

						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							<p><strong><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste :</strong> Ce bouton permet de retourner à la liste des personnages</p>
							<?php if ($_SESSION['player']['admin'] > 1) { ?>
								<p><strong><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer :</strong> Ce bouton permet de supprimer complètement le personnage. C'est essentiellement pour supprimer des spamers, ou des tests de certains clients. Vous ne pouvez pas supprimer des personnages qui ont déjà participé à des évènements.</p>
							<?php } ?>
							<p><strong><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Tuer :</strong> Ce bouton permet de tuer un personnage, ce dernier ne pourra plus être utilisé lors d'une inscription.</p>
							<p><strong><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;Monter de grade :</strong> Ce bouton vous permet d'élever ce personnage en grade, en montant de grade, certaines nouvelles ressources lui seront disponible.</p>
							<p><strong><i class="fa fa-heartbeat" aria-hidden="true"></i> &nbsp;Changer le bilan :</strong> Ce bouton vous permet de changer la valeur du bilan de santé de ce personnage.</p>
							<?php if ($_SESSION['player']['admin'] > 1) { ?>
								<p><strong><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Modifier :</strong> Ce bouton permet de modifier un personnage, il permet de faire des changements impossible par le joueur.</p>
							<?php } ?>
						</div>


					</div>

					<div class="visible-xs-block">

						<a href="/inscriptions/admin/characters" class="btn btn-warning btn-lg btn-block" style="margin: 3px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste</a>
						<button class="btn btn-danger btn-lg btn-block tool" data-modal="modal-delete" style="margin: 3px;" <?php if (count($inscriptions) > 0) echo 'disabled' ?> ><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer</button>
						
						<?php if ($character['dead'] == 0) { ?>
							<button class="btn btn-primary btn-lg btn-block tool" data-modal="modal-kill" style="margin: 3px;"><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Tuer</button>
						<?php } else { ?>
							<button class="btn btn-primary btn-lg btn-block tool" data-modal="modal-unkill" style="margin: 3px;"><i class="fa fa-child" aria-hidden="true"></i> &nbsp;Ressusciter</button>
						<?php } ?>

						<button class="btn btn-default btn-lg btn-block tool" data-modal="modal-rankup" style="margin: 3px;"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;Monter de grade</button>
						<button class="btn btn-default btn-lg btn-block tool" data-modal="modal-health" style="margin: 3px;"><i class="fa fa-heartbeat" aria-hidden="true"></i> &nbsp;Changer le bilan</button>
						<?php if ($_SESSION['player']['admin'] > 1) { ?>
							<button class="btn btn-default btn-lg btn-block tool" data-modal="modal-edit" style="margin: 3px;"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Modifier</button>
						<?php } ?>

					</div>


					<form id="form_character" method="post" class="form-horizontal">

						<div class="form-group">
							<label for="rank" class="col-sm-3 control-label">Grade</label>
							<div class="col-sm-8">
								<span style="font-size:24px;">
									<span class="label label-default">Grade <?php echo $character['rank']; ?></span>
									<?php if ($character['dead'] > 0) echo '&nbsp;<span class="label label-danger"><img src="/inscriptions/img/ico-dead.svg.php?fill=fff" style="margin-bottom:4px; width:18px;"> '.'Mort'.'</span>'; ?>
								</span>
								<?php 
								if ($character['dead'] == 1) $dead_details = 'Mort en mission, ramené sur le vaisseau.';
								if ($character['dead'] == 2) $dead_details = 'Mort en mission, laissé sur le terrain.';
								if ($character['dead'] == 3) $dead_details = 'Changement de personnage volontaire.';
								if ($character['dead'] > 0) echo '&nbsp;<code class="hidden-sm hidden-xs">'.$dead_details.'</code>';
								?>
							</div>
						</div>

						<div class="form-group">
							<label for="health_points" class="col-sm-3 control-label">Bilan de santé</label>
							<div class="col-sm-2">
							    <div class="input-group">
							      <input type="number" class="form-control" id="health_points" name="health_points" placeholder="Bilan de santé"  maxlength="5" readonly value="<?php echo $character['health_points']; ?>">
							      <div class="input-group-addon">%</div>
							    </div>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="col-sm-3 control-label">Nom du personnage</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="name" name="name" placeholder="Nom du personnage"  maxlength="40" readonly value="<?php echo $character['name']; ?>">
							</div>
						</div>


						<div class="form-group">
							<label for='id_race' class="col-sm-3 control-label ">Race</label>
							<div class="col-sm-8">
								<img src="<?php echo $character['race']['picture_url']; ?>" class="img-thumbnail" width="34" style="background-color:#eee;"> &nbsp;
								<?php echo $character['race']['name']; ?>
							</div>
						</div>
						<div class="form-group">
							<label for='id_corporation' class="col-sm-3 control-label ">Corporation</label>
							<div class="col-sm-8">
								<img src="<?php echo $character['corporation']['picture_url']; ?>" class="img-thumbnail" width="34" style="background-color:#eee;"> &nbsp;
								<?php echo $character['corporation']['name']; ?>
							</div>
						</div>
						<div class="form-group">
							<label for='id_profession' class="col-sm-3 control-label ">Profession</label>
							<div class="col-sm-8">
								<img src="<?php echo $character['profession']['picture_url']; ?>" class="img-thumbnail" width="34" style="background-color:#eee;"> &nbsp;
								<?php echo $character['profession']['name']; ?>
							</div>
						</div>


						<div class="form-group">
							<label for="notes" class="col-sm-3 control-label">Courtes description</label>
							<div class="col-sm-8">
								<textarea class="form-control" rows="3" id="notes" name="notes" placeholder="Notes"  maxlength="500" readonly><?php echo $character['notes']; ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="background" class="col-sm-3 control-label">Historique (Background)</label>
							<div class="col-sm-8">
								<textarea class="form-control" rows="6" id="background" name="background" placeholder="Historique" maxlength="5000" readonly><?php echo $character['background']; ?></textarea>
							</div>
						</div>

						<hr />

						<div class="form-group">
							<label for="date_created" class="col-sm-3 control-label">Date de création</label>
							<div class="col-sm-3">
								<div class="input-group">
									<input type="text" class="form-control" id="date_created" name="date_created" placeholder="AAAA-MM-JJ"  maxlength="10" readonly data-date-format="yyyy-mm-dd" value="<?php echo $character['date_created']; ?>">
									<label for="date_created" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="date_updated" class="col-sm-3 control-label">Date de mise à jour</label>
							<div class="col-sm-3">
								<div class="input-group">
									<input type="text" class="form-control" id="date_updated" name="date_updated" placeholder="AAAA-MM-JJ"  maxlength="10" readonly data-date-format="yyyy-mm-dd" value="<?php echo $character['date_updated']; ?>">
									<label for="date_updated" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
								</div>
							</div>
						</div>

					</form>

					<hr />

					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						
						<div class="panel panel-warning">
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
													<button class=" btn btn-warning btn-xs" data-toggle="tooltip" title="Détails"><i class='fa fa-search'></i></button>
												</h3>
											</form>

											
											<table>

												<tr><th style="text-align: left; padding-right:20px;">Courriel<th><td><a class="text-warning" href="mailto:<?php echo $player['email']; ?>"><?php echo $player['email']; ?></a><td></tr>
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

						<div class="panel panel-warning">
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
														<td><button class="list-action btn btn-warning btn-xs" data-form="form-auto" data-id="0" data-action="<?php echo $file['path']; ?>" data-toggle="tooltip" title="Télécharger"><i class='fa fa-download'></i></button></td>
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


						<div class="panel panel-warning">

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
														<td><button class="list-action btn btn-warning btn-xs" data-form="form-auto" data-id="<?php echo $event['inscription_id']; ?>" data-action="/inscriptions/admin/attendees/display/" data-toggle="tooltip" title="Détails"><i class='fa fa-search'></i></button></td>
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
			<button type="submit" class="btn btn-warning"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
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
      <form method="post" action="/inscriptions/admin/characters/kill/">
	      <div class="modal-body">
			<p>Êtes-vous certain de vouloir tuer le personnnage «<?php echo $character['name']; ?>»? Ce dernier ne pourra plus être utilisé lors d'une inscription.</p>

			<h4>Circonstances de la mort</h4>
			<label><input type="radio" name="circonstance" value="1" checked> &nbsp; Mort en mission, ramené sur le vaisseau.</label></br>
			<label><input type="radio" name="circonstance" value="2"> &nbsp; Mort en mission, laissé sur le terrain.</label></br>
			<label><input type="radio" name="circonstance" value="3"> &nbsp; Changement de personnage volontaire.</label></br>
	      </div>
	      <div class="modal-footer">
				<input name="submitaction" type="hidden" value="kill">
				<input name="id" type="hidden" value="<?php echo $character['id']; ?>">

				<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
				<button type="submit" class="btn btn-warning"><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Tuer</button>
	      </div>
	  </form>
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
			<button type="submit" class="btn btn-warning"><i class="fa fa-child" aria-hidden="true"></i> &nbsp;Ressusciter</button>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-rankup" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation de nouveau grade</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir élever en grade ce personnage «<?php echo $character['name']; ?>» ?</p>

      </div>
      <div class="modal-footer">
	    <form method="post" action="/inscriptions/admin/characters/rankup/">
			<input name="submitaction" type="hidden" value="rankup">
			<input name="id" type="hidden" value="<?php echo $character['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;Monter de grade</button>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-health" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier le blian de santé</h4>
      </div>
      <form method="post" action="/inscriptions/admin/characters/health/">
	      <div class="modal-body">
			<p>Entrez la nouvelle valeur de santé pour ce personnage «<?php echo $character['name']; ?>» ?</p>

			<div class="row">
				<label for="health_check" class="col-sm-3 control-label">Bilan de santé</label>
				<div class="col-sm-4">
				    <div class="input-group">
				      <input type="number" class="form-control" id="health_check" name="health_check" min="0" max="125" value="<?php echo $character['health_points']; ?>">
				      <div class="input-group-addon">%</div>
				    </div>
				</div>
			</div>

	      </div>
	      <div class="modal-footer">
			<input name="submitaction" type="hidden" value="health_check">
			<input name="id" type="hidden" value="<?php echo $character['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-save" aria-hidden="true"></i> &nbsp;Enregistrer</button>
	      </div>
  	  </form>
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
			<button type="submit" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Modifier</button>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<form id="form-auto" target="_blank" method="post" class="hidden">
	<input type="text" name="id">
	<input type="text" name="submitaction">
</form>
