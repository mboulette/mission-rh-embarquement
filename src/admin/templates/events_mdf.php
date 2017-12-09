<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Évènements
					<?php if (is_numeric($events['id'])) {?><small>Modifier <?php echo str_cut($events['name'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($events['id'])) {?><small>Création d'un nouvel évènement</small><?php } ?>
				</h1>
			</div>

			<form id="form_events" action="/inscriptions/admin/events" method="post" class="form-horizontal">

				<div class="panel-body">


					<div class="form-group">
						<label for="date_event_picker" class="col-sm-3 control-label">Date</label>
						<div class="col-sm-4 col-lg-3">
							<div class="input-group">
								<input type="text" class="form-control" id="date_event_picker" name="date_event_picker" placeholder="AAAA-MM-JJ HH:MM" required maxlength="16" value="<?php echo $events['date_event']; ?>">
								<label for="date_event_picker" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
							</div>

							<input type="hidden" class="form-control" id="date_event" name="date_event"value="<?php echo $events['date_event']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom" required maxlength="60" value="<?php echo $events['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="synopsis" class="col-sm-3 control-label">Synopsis</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="synopsis" name="synopsis" placeholder="Synopsis" required maxlength="1000"><?php echo $events['synopsis']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-sm-3 control-label">Lien</label>
						<div class="col-sm-8">
							<input type="url" class="form-control" id="link" name="link" placeholder="http://www.exemple.com" maxlength="200" value="<?php echo $events['link']; ?>">
							<p class="help-block">URL vers une page d'information supplémentaire</p>
						</div>
					</div>

					<div class="form-group">
						<label for="max_places" class="col-sm-3 control-label">Nombre de places</label>
						<div class="col-sm-4 col-lg-3">
							<input type="number" class="form-control" id="max_places" name="max_places" placeholder="10" required step="10" min="10" max="300" value="<?php echo $events['max_places']; ?>">
						</div>
					</div>


					<div class="form-group">
						<label for="date_inscription_group" class="col-sm-3 control-label required">Période d'inscription</label>
						<div class="col-sm-5 col-lg-4">
							<div class="input-group ">
								<input type="text" id="date_inscription_group" class="form-control" required readonly>
								<label for="date_inscription_group" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>

								<input type="hidden" id="inscription_begin" name="inscription_begin" value="<?php echo $events['inscription_begin']; ?>">
								<input type="hidden" id="inscription_end" name="inscription_end" value="<?php echo $events['inscription_end']; ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="max_places" class="col-sm-3 control-label">Portée</label>
						<div class="col-sm-4 col-lg-3">
							<select name='animateur' class='form-control'>
								<option value="0" <?php if ($events['animateur'] == 0) echo 'selected';?>>Tous le monde</option>
								<option value="1" <?php if ($events['animateur'] == 1) echo 'selected';?>>Animateurs</option>
								<option value="2" <?php if ($events['animateur'] == 2) echo 'selected';?>>Scénaristes</option>
								<option value="3" <?php if ($events['animateur'] == 3) echo 'selected';?>>Admin</option>
							</select>
						</div>
					</div>					

					<hr>

					<div class="form-group">
						<label for="credits" class="col-sm-3 control-label">Credits des membres</label>
						<div class="col-sm-7 col-md-4">

							<?php foreach ($corporations as $corporation) { ?>

									<?php
									if (!array_key_exists($corporation['id'], $events['credits'])) {
										$events['credits'][$corporation['id']] = 20;
									}
									?>

									<div class="input-group">
										<div class="input-group" style="margin-top: 5px;">
											<span class="input-group-addon credits"><img src="<?php echo $corporation['picture_url']; ?>" width='18'> &nbsp;<?php echo $corporation['name']; ?></span>
											<input type="text" name="credits[<?php echo $corporation['id']; ?>]" class="form-control input-number text-right" 
												value="<?php echo $events['credits'][$corporation['id']]; ?>"
												min="0" max="99"
											>
											<span class="input-group-btn minus">
												<button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="credits[<?php echo $corporation['id']; ?>]">
													<span class="glyphicon glyphicon-minus"></span>
												</button>
											</span>
											<span class="input-group-btn">
												<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="credits[<?php echo $corporation['id']; ?>]">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
										</div>


									</div>

							<?php } ?>
						</div>
					</div>


				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_events" name="id_events" value="<?php echo $events['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/events' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-events" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
