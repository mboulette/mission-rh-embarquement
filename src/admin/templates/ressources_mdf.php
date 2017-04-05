<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Ressources 
					<?php if (is_numeric($ressources['id'])) {?><small>Modifier <?php echo str_cut($ressources['name'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($ressources['id'])) {?><small>Création d'une nouvelle ressource</small><?php } ?>
				</h1>
			</div>

			<form id="form_ressources" action="/inscriptions/admin/ressources" method="post" class="form-horizontal">

				<div class="panel-body">

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom" required maxlength="40" value="<?php echo $ressources['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="description" name="description" placeholder="Description" required maxlength="1000"><?php echo $ressources['description']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-sm-3 control-label">Lien</label>
						<div class="col-sm-8">
							<input type="url" class="form-control" id="link" name="link" placeholder="http://www.exemple.com" maxlength="200" value="<?php echo $ressources['link']; ?>">
							<p class="help-block">URL vers une page d'information supplémentaire</p>
						</div>
					</div>

					<div class="form-group">
						<label for="level" class="col-sm-3 control-label">Niveau</label>
						<div class="col-sm-8">
							<select name="level" class="selectpicker">
								<option value="1" <?php if ($ressources['level'] == 1) echo 'selected'; ?>>Terrestre</option>
								<option value="2" <?php if ($ressources['level'] == 2) echo 'selected'; ?>>Indigène</option>
								<option value="3" <?php if ($ressources['level'] == 3) echo 'selected'; ?>>Hybride</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="credits" class="col-sm-3 control-label">Coût</label>
						<div class="col-sm-7 col-md-4">

							<?php foreach ($professions as $profession) { ?>
								<?php
								if (!array_key_exists($profession['id'], $ressources['credits'])) {
									$ressources['credits'][$profession['id']] = 5;
								}
								?>

								<div class="input-group">
									<div class="input-group" style="margin-top: 5px;">
										<span class="input-group-addon credits"><?php echo $profession['name']; ?></span>
										<input type="text" name="credits[<?php echo $profession['id']; ?>]" class="form-control input-number text-right" 
											value="<?php echo $ressources['credits'][$profession['id']]; ?>"
											min="1" max="10"
										>
										<span class="input-group-btn minus">
											<button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="credits[<?php echo $profession['id']; ?>]">
												<span class="glyphicon glyphicon-minus"></span>
											</button>
										</span>
										<span class="input-group-btn">
											<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="credits[<?php echo $profession['id']; ?>]">
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
					<input type="hidden" id="id_ressources" name="id_ressources" value="<?php echo $ressources['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/ressources' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-ressources" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
