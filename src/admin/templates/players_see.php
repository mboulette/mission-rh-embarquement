<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Joueurs <small><?php echo str_cut($player['firstname'].' '.$player['lastname'] , 60); ?></small></h1>
			</div>


			<div class="panel-body">

				<div class="form-horizontal">

					<div class="hidden-xs">
						<a href="/inscriptions/admin/players" class="btn btn-warning backlink"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste</a>
						<?php if ($_SESSION['player']['admin'] > 2) { ?>
							<button class="btn btn-danger tool" data-modal="modal-delete" <?php if (count($inscriptions) > 0) echo 'disabled' ?> ><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer</button>
						<?php } ?>
						
						<?php if ($player['locked'] == 0) { ?>
							<button class="btn btn-primary tool" data-modal="modal-lock"><i class="fa fa-lock" aria-hidden="true"></i> &nbsp;Verrouiller</button>
						<?php } else { ?>
							<button class="btn btn-primary tool" data-modal="modal-unlock"><i class="fa fa-unlock" aria-hidden="true"></i> &nbsp;Déverrouiller</button>
						<?php } ?>					

						<?php if ($_SESSION['player']['admin'] > 3) { ?>
							<button class="btn btn-default tool" data-modal="modal-connectas"><i class="fa fa-user-secret" aria-hidden="true"></i> &nbsp;Incarner</button>
						<?php } ?>
						<button class="btn btn-default tool" data-modal="modal-send"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;Envoyer un message</button>

						<?php if ($_SESSION['player']['admin'] > 2) { ?>
							<button class="btn btn-default tool" data-modal="modal-animateur" <?php if ($player['admin'] > 0) echo 'disabled' ?> ><i class="fa fa-graduation-cap" aria-hidden="true"></i> &nbsp;Nouvel Animateur</button>
						<?php } ?>

						<hr />

						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							
							<p><strong><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste :</strong> Ce bouton permet de retourner à la liste des joueurs</p>
							<?php if ($_SESSION['player']['admin'] > 2) { ?>
								<p><strong><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer :</strong> Ce bouton permet de supprimer complètement un joueur du système. C'est essentiellement pour supprimer des spamers, ou des clients qui n'étaient pas réellement intéressés. Vous ne pouvez pas supprimer des joueurs qui ont déjà participé à des évènements, si vous voulez bannir ce dernier, utilisé plutôt le bouton Verrouillé.</p>
							<?php } ?>
							<p><strong><i class="fa fa-lock" aria-hidden="true"></i> &nbsp;Verrouillé :</strong> Ce bouton block les accès de ce joueur, ce dernier ne pourra plus ce connecter au système, ni créer un nouveau compte à partir de la même adresse courriel.</p>
							<?php if ($_SESSION['player']['admin'] > 3) { ?>							
								<p><strong><i class="fa fa-user-secret" aria-hidden="true"></i> &nbsp;Incarner :</strong> Ce bouton vous permet de vous connecter dans le système comme si vous étiez ce joueur. C'est essentiellement pour faire des modifications ou des transactions pour lui qui aurait des difficultés ou des empêchements. Vous conserverez la barre d'administration, mais le menu du joueur (en noir) sera personnalisé pour cette personne.</p>
							<?php } ?>
							<p><strong><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;Envoyer un message :</strong> Ce bouton permet d'envoyer un courriel à ce joueur.</p>

							<?php if ($_SESSION['player']['admin'] > 2) { ?>
								<p><strong><i class="fa fa-graduation-cap" aria-hidden="true"></i> &nbsp;Nouvel Animateur :</strong> Ce bouton permet d'upgrader un joueur en animateur.</p>
							<?php } ?>
							
						</div>


					</div>

					<div class="visible-xs-block">
						<a href="/inscriptions/admin/players" class="btn btn-warning btn-lg btn-block" style="margin: 3px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste</a>
						<?php if ($_SESSION['player']['admin'] > 2) { ?>
							<button class="btn btn-danger btn-lg btn-block tool" data-modal="modal-delete" style="margin: 3px;" <?php if (count($inscriptions) > 0) echo 'disabled' ?> ><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Supprimer</button>
						<?php } ?>
						<?php if ($player['locked'] == 0) { ?>
							<button class="btn btn-primary btn-lg btn-block tool" data-modal="modal-lock" style="margin: 3px;"><i class="fa fa-lock" aria-hidden="true"></i> &nbsp;Vérouiller</button>
						<?php } else { ?>
							<button class="btn btn-primary btn-lg btn-block tool" data-modal="modal-unlock" style="margin: 3px;"><i class="fa fa-unlock" aria-hidden="true"></i> &nbsp;Déverrouiller</button>
						<?php } ?>

						<?php if ($_SESSION['player']['admin'] > 3) { ?>
							<button class="btn btn-default btn-lg btn-block tool" data-modal="modal-connectas" style="margin: 3px;"><i class="fa fa-user-secret" aria-hidden="true"></i> &nbsp;Incarner</button>
						<?php } ?>
						<button class="btn btn-default btn-lg btn-block tool" data-modal="modal-send" style="margin: 3px;"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;Envoyer un message</button>
					
						<?php if ($_SESSION['player']['admin'] > 2) { ?>
							<button class="btn btn-default btn-lg btn-block tool" data-modal="modal-animateur" <?php if ($player['admin'] > 0) echo 'disabled' ?> ><i class="fa fa-graduation-cap" aria-hidden="true"></i> &nbsp;Nouvel Animateur</button>
						<?php } ?>

					</div>

					
					<form id="form_profile" method="post" class="form-horizontal">


						<div class="form-group">
							<label class="col-sm-3 control-label">Photo</label>
							<div class="col-sm-8"> 
								<img id="picture" src="<?php echo $player['picture_url']; ?>" width="160" height="160" alt="Avatar" class="img-thumbnail">
							</div>
						</div>

						<hr />

						<div class="form-group">
							<label for="firstname" class="col-sm-3 control-label">Prénom</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom"  readonly maxlength="40" value="<?php echo $player['firstname']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="lastname" class="col-sm-3 control-label">Nom de famille</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom de famille"  readonly maxlength="40" value="<?php echo $player['lastname']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="birthday-x" class="col-sm-3 control-label">Date de naissance</label>
							<div class="col-sm-4">
								<div class="input-group">
									<?php
									$today = new DateTime();
									$birthday = new DateTime($player['birthday']);
									$interval = $today->diff($birthday);
									?>
									<label for="birthday-x" class="input-group-addon"><?php echo $interval->format('%y ans'); ?></label>
									<input type="text" class="form-control" id="birthday-x" name="birthday-x" placeholder="AAAA-MM-JJ"  readonly maxlength="10" data-date-format="yyyy-mm-dd" value="<?php echo substr($player['birthday'], 0, 10); ?>">
									<label for="birthday-x" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="gender" class="col-sm-3 control-label">Sexe</label>
							<div class="col-sm-3">

								<?php if ($player['gender'] == "M") { ?>
									<div class="input-group">
										<label class="input-group-addon"><i class="fa fa-mars"></i></label>
										<input type="text" class="form-control" id="gender" name="gender"  readonly maxlength="10" value="Masculin">
									</div>
								<?php } else { ?>
									<div class="input-group">
										<label class="input-group-addon"><i class="fa fa-venus"></i></label>
										<input type="text" class="form-control" id="gender" name="gender"  readonly maxlength="10" value="Féminin">
									</div>
								<?php } ?>

							</div>
						</div>


						<div class="form-group">
							<label for="email" class="col-sm-3 control-label ">Courriel</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" placeholder="Courriel" value="<?php echo $player['email']; ?>"  readonly maxlength="200">
							</div>
						</div>

						<hr />

						<div class="form-group">
							<label for="date_created" class="col-sm-3 control-label">Date de création</label>
							<div class="col-sm-3">
								<div class="input-group">
									<input type="text" class="form-control" id="date_created" name="date_created" placeholder="AAAA-MM-JJ"  maxlength="10" readonly data-date-format="yyyy-mm-dd" value="<?php echo $player['date_created']; ?>">
									<label for="date_created" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="date_updated" class="col-sm-3 control-label">Date de mise à jour</label>
							<div class="col-sm-3">
								<div class="input-group">
									<input type="text" class="form-control" id="date_updated" name="date_updated" placeholder="AAAA-MM-JJ"  maxlength="10" readonly data-date-format="yyyy-mm-dd" value="<?php echo $player['date_updated']; ?>">
									<label for="date_updated" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
								</div>
							</div>
						</div>
				
						<div class="form-group">
							<label for="date_lastlogin" class="col-sm-3 control-label">Dernière connexion</label>
							<div class="col-sm-3">
								<div class="input-group">
									<input type="text" class="form-control" id="date_lastlogin" name="date_lastlogin" placeholder="AAAA-MM-JJ"  maxlength="10" readonly data-date-format="yyyy-mm-dd" value="<?php echo $player['date_lastlogin']; ?>">
									<label for="date_lastlogin" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="tags" class="col-sm-3 control-label">Tags</label>
							<div class="col-sm-8"  style="font-size:20px;">
								<?php if ($player['completed']) echo '<span class="label label-default">Complété</span>&nbsp;'; ?>
								<?php if ($player['locked']) echo '<span class="label label-primary">Verrouillé</span>&nbsp;'; ?>
								<?php if ($player['admin'] == 1) echo '<span class="label label-danger">Animateur</span>&nbsp;'; ?>
								<?php if ($player['admin'] == 2) echo '<span class="label label-danger">Scénariste</span>&nbsp;'; ?>
								<?php if ($player['admin'] == 3) echo '<span class="label label-danger">Admin</span>&nbsp;'; ?>
								<?php if ($player['admin'] == 4) echo '<span class="label label-danger">Super Admin</span>&nbsp;'; ?>
								<?php if ($player['combinaison']) echo '<span class="label label-primary">Combinaison</span>&nbsp;'; ?>
							</div>
						</div>

					</form>


				</div>


				<hr />

				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-warning">
						<div class="panel-heading" role="tab" id="headingOne">
							<h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<i class="glyphicon glyphicon-paperclip"></i>&nbsp;
							  	Liste des pièces jointes
								<span class="caret"></span>
							</h3>
						</div>

						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
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
								<i class="fa fa-users"></i>&nbsp;
							  	Liste des personnages
								<span class="caret"></span>
							</h3>
						</div>

						<div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12 table-responsive">
										
										<?php if (count($characters) > 0) { ?>
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th width="60">Outils</th>
													<th>Nom</th>
													<th>Race</th>
													<th>Profession</th>
													<th>Corporation</th>
													<th>Grade</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($characters as $character) { ?>
												<tr class='action'>
													<?php
													$race_pic = '';
													if ($character['race']['picture_url'] != '') $race_pic = '<img width="20" src="'.$character['race']['picture_url'].'"> &nbsp;';

													$profession_pic = '';
													if ($character['profession']['picture_url'] != '') $profession_pic = '<img width="20" src="'.$character['profession']['picture_url'].'"> &nbsp;';

													$corporation_pic = '';
													if ($character['corporation']['picture_url'] != '') $corporation_pic = '<img width="20" src="'.$character['corporation']['picture_url'].'"> &nbsp;';
													
													$dead = '';
													if ($character['dead'] > 0) $dead = '&nbsp;<img src="/inscriptions/img/ico-dead.svg.php?fill=d9534f" width="16">';
													?>
												
													<td><button class="list-action btn btn-warning btn-xs" data-form="form-auto" data-id="<?php echo $character['id']; ?>" data-action="/inscriptions/admin/characters/display" data-toggle="tooltip" title="Détails"><i class='fa fa-search'></i></button></td>
													<td><strong><?php echo str_cut($character['name'], 60); ?></strong></td>
													<td><?php echo $race_pic.str_cut($character['race']['name'], 60); ?></td>
													<td><?php echo $profession_pic.str_cut($character['profession']['name'], 60); ?></td>
													<td><?php echo $corporation_pic.str_cut($character['corporation']['name'], 60); ?></td>
													<td><?php echo $character['rank'].$dead; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>

										<?php } else { ?>
											Ce client n'a pas encore personnage!
										<?php } ?>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="panel panel-warning">

						<div class="panel-heading" role="tab" id="heading3">
							<h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
								<i class="fa fa-calendar"></i>&nbsp;
							  	Liste des participations
								<span class="caret"></span>
							</h3>
						</div>

						<div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
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

					<?php if ($_SESSION['player']['admin'] > 3) { ?>
					
					<div class="panel panel-warning">

						<div class="panel-heading" role="tab" id="heading4">
							<h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
								<i class="fa fa-credit-card-alt"></i>&nbsp;
							  	Liste des cartes de crédit
								<span class="caret"></span>
							</h3>
						</div>


						<div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12 table-responsive">
										
										<?php if (!is_null($creditcards)) { ?>
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>Étiquette</th>
													<th>Nom sur la carte</th>
													<th>Numéro</th>
													<th>Date d'expiration</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($creditcards as $card) { ?>
												<?php
												$cardnumber = str_pad('&nbsp;', 10, "*", STR_PAD_LEFT);
												$cardnumber = $cardnumber.$cardnumber.$cardnumber.$card->getLast4();
												?>

												<tr>
													<td><?php echo ucfirst(strtolower($card->getCardBrand())); ?></td>
													<td><?php echo $card->getCardholderName(); ?></td>
													<td><?php echo $cardnumber; ?></td>
													<td><?php echo $card->getExpMonth(); ?>/<?php echo $card->getExpYear(); ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>

										<?php } else { ?>
											Ce client n'a pas de cartes de crédit dans son dossier!
										<?php } ?>

									</div>
								</div>
							</div>
						</div>
					</div>

					<?php } ?>
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
		
		<p>Êtes-vous certain de vouloir supprimer le joueur «<?php echo $player['firstname'].' '.$player['lastname']; ?> »?</p>

	  </div>
	  <div class="modal-footer">
		<form method="post" action="/inscriptions/admin/players/erase/">
			<input name="submitaction" type="hidden" value="erase">
			<input name="id" type="hidden" value="<?php echo $player['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
		</form>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-lock" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Confirmation de bannissement</h4>
	  </div>
	  <div class="modal-body">
		
		<p>Êtes-vous certain de vouloir verrouiller le compte de du joueur «<?php echo $player['firstname'].' '.$player['lastname']; ?>»? Il ne sera plus en mesure de ce connecter, et il ne pourra pas créer de nouveau compte avec cette même adresse courriel.</p>

	  </div>
	  <div class="modal-footer">
		<form method="post" action="/inscriptions/admin/players/lock/">
			<input name="submitaction" type="hidden" value="lock">
			<input name="id" type="hidden" value="<?php echo $player['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-lock" aria-hidden="true"></i> &nbsp;Verrouiller</button>
		</form>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-unlock" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Confirmation d'activation</h4>
	  </div>
	  <div class="modal-body">
		
		<p>Êtes-vous certain de vouloir déverrouiller le compte de du joueur «<?php echo $player['firstname'].' '.$player['lastname']; ?>»? Il pourra ce connecter à nouveau dans son compte.</p>

	  </div>
	  <div class="modal-footer">
		<form method="post" action="/inscriptions/admin/players/lock/">
			<input name="submitaction" type="hidden" value="unlock">
			<input name="id" type="hidden" value="<?php echo $player['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-unlock" aria-hidden="true"></i> &nbsp;Déverrouiller</button>
		</form>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-connectas" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Confirmation de connexion</h4>
	  </div>
	  <div class="modal-body">
		
		<p>Êtes-vous certain de vouloir vous connectez dans le compte de du joueur «<?php echo $player['firstname'].' '.$player['lastname']; ?>» ?</p>

	  </div>
	  <div class="modal-footer">
		<form method="post" action="/inscriptions/admin/players/connectas/">
			<input name="submitaction" type="hidden" value="connectas">
			<input name="id" type="hidden" value="<?php echo $player['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-user-secret" aria-hidden="true"></i> &nbsp;Connexion</button>
		</form>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-animateur" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Confirmation d'un nouvel animateur</h4>
	  </div>
	  <div class="modal-body">
		
		<p>Êtes-vous certain de vouloir transformer le joueur «<?php echo $player['firstname'].' '.$player['lastname']; ?>» en animateur?</p>

	  </div>
	  <div class="modal-footer">
		<form method="post" action="/inscriptions/admin/players/upgrade/">
			<input name="submitaction" type="hidden" value="upgrade">
			<input name="id" type="hidden" value="<?php echo $player['id']; ?>">

			<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-check-circle" aria-hidden="true"></i> &nbsp;Transformer</button>
		</form>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="modal-send" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Envoyer un message à <?php echo $player['firstname'].' '.$player['lastname']; ?></h4>
			</div>

			<form method="post" action="/inscriptions/admin/players/send/">
				<div class="modal-body">

					<div class="form-group">
						<label class="control-label">De</label> &nbsp;
						<?php echo $GLOBALS['app_email']; ?>
					</div>
					<div class="form-group">
						<label class="control-label">À</label> &nbsp;
						<?php echo $player['email']; ?>
					</div>

					<div class="form-group">
						<label for="subject">Sujet</label>
						<input type="text" class="form-control" name="subject" required placeholder="Sujet" maxlength="200">
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea class="form-control" rows="5" name="message" required placeholder="Message" maxlength="1000"></textarea>
					</div>

				</div>
				<div class="modal-footer">
					<input name="submitaction" type="hidden" value="send">
					<input name="id" type="hidden" value="<?php echo $player['id']; ?>">

					<button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
					<button type="submit" class="btn btn-warning"><i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;Envoyer</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<form id="form-auto" target="_blank" method="post" class="hidden">
	<input type="text" name="id">
	<input type="text" name="submitaction">
</form>
