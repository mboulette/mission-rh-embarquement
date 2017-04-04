<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Recettes 
					<?php if (is_numeric($recipes['id'])) {?><small>Modifier <?php echo str_cut($recipes['name'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($recipes['id'])) {?><small>Création d'une nouvelle recette</small><?php } ?>
				</h1>
			</div>

			<form id="form_recipes" action="/inscriptions/admin/recipes" method="post" class="form-horizontal">

				<div class="panel-body">

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom" required maxlength="40" value="<?php echo $recipes['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="description" name="description" placeholder="Description" required maxlength="1000"><?php echo $recipes['description']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-sm-3 control-label">Lien</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="link" name="link" placeholder="http://www.exemple.com" maxlength="200" value="<?php echo $recipes['link']; ?>">
							<p class="help-block">URL vers une page d'information supplémentaire</p>
						</div>
					</div>

					<div class="form-group">
						<label for="feature_id" class="col-sm-3 control-label">Profession</label>
						<div class="col-sm-8">
							<select name="feature_id" class="selectpicker">
								<?php foreach ($professions as $profession) { ?>
									<option 
									data-content="<img src='<?php echo $profession['picture_url']; ?>' width='18'> &nbsp;<?php echo $profession['name']; ?></span>"
									value="<?php echo $profession['id']; ?>"
									<?php if ($recipes['feature_id'] == $profession['id']) echo 'selected'; ?>><?php echo $profession['name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="level" class="col-sm-3 control-label">Niveau</label>
						<div class="col-sm-8">
							<select name="level" class="selectpicker">
								<option value="1" <?php if ($recipes['level'] == 1) echo 'selected'; ?>>Mineure</option>
								<option value="2" <?php if ($recipes['level'] == 2) echo 'selected'; ?>>Majeure</option>
							</select>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<label for="recipies" class="col-sm-3 control-label">Ingrédients <span class="label label-success">Terrestre</span></label>
						<div class="col-sm-7 col-md-4">

							<?php foreach ($ressources as $ressource) { ?>
								<?php if ($ressource['level'] == 1) { ?>
									<?php
									if (!array_key_exists($ressource['id'], $recipes['recipies'])) {
										$recipes['recipies'][$ressource['id']] = 0;
									}
									?>

									<div class="input-group">
										<div class="input-group" style="margin-top: 5px;">
											<span class="input-group-addon credits"><?php echo $ressource['name']; ?></span>
											<input type="text" name="recipies[<?php echo $ressource['id']; ?>]" class="form-control input-number text-right" 
												value="<?php echo $recipes['recipies'][$ressource['id']]; ?>"
												min="0" max="10"
											>
											<span class="input-group-btn minus">
												<button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="recipies[<?php echo $ressource['id']; ?>]">
													<span class="glyphicon glyphicon-minus"></span>
												</button>
											</span>
											<span class="input-group-btn">
												<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="recipies[<?php echo $ressource['id']; ?>]">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
										</div>


									</div>

								<?php } ?>
							<?php } ?>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<label for="recipies" class="col-sm-3 control-label">Ingrédients <span class="label label-warning">Indigène</span></label>
						<div class="col-sm-7 col-md-4">

							<?php foreach ($ressources as $ressource) { ?>
								<?php if ($ressource['level'] == 2) { ?>
									<?php
									if (!array_key_exists($ressource['id'], $recipes['recipies'])) {
										$recipes['recipies'][$ressource['id']] = 0;
									}
									?>

									<div class="input-group">
										<div class="input-group" style="margin-top: 5px;">
											<span class="input-group-addon credits"><?php echo $ressource['name']; ?></span>
											<input type="text" name="recipies[<?php echo $ressource['id']; ?>]" class="form-control input-number text-right" 
												value="<?php echo $recipes['recipies'][$ressource['id']]; ?>"
												min="0" max="10"
											>
											<span class="input-group-btn minus">
												<button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="recipies[<?php echo $ressource['id']; ?>]">
													<span class="glyphicon glyphicon-minus"></span>
												</button>
											</span>
											<span class="input-group-btn">
												<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="recipies[<?php echo $ressource['id']; ?>]">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
										</div>


									</div>

								<?php } ?>
							<?php } ?>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<label for="recipies" class="col-sm-3 control-label">Ingrédients <span class="label label-danger">Hybride</span></label>
						<div class="col-sm-7 col-md-4">

							<?php foreach ($ressources as $ressource) { ?>
								<?php if ($ressource['level'] == 3) { ?>
									<?php
									if (!array_key_exists($ressource['id'], $recipes['recipies'])) {
										$recipes['recipies'][$ressource['id']] = 0;
									}
									?>

									<div class="input-group">
										<div class="input-group" style="margin-top: 5px;">
											<span class="input-group-addon credits"><?php echo $ressource['name']; ?></span>
											<input type="text" name="recipies[<?php echo $ressource['id']; ?>]" class="form-control input-number text-right" 
												value="<?php echo $recipes['recipies'][$ressource['id']]; ?>"
												min="0" max="10"
											>
											<span class="input-group-btn minus">
												<button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="recipies[<?php echo $ressource['id']; ?>]">
													<span class="glyphicon glyphicon-minus"></span>
												</button>
											</span>
											<span class="input-group-btn">
												<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="recipies[<?php echo $ressource['id']; ?>]">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
										</div>


									</div>

								<?php } ?>
							<?php } ?>
						</div>
					</div>


				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_recipes" name="id_recipes" value="<?php echo $recipes['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/recipes' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-recipes" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
