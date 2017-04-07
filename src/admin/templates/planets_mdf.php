<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Planètes 
					<?php if (is_numeric($planets['id'])) {?><small>Modifier <?php echo str_cut($planets['name'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($planets['id'])) {?><small>Création d'une nouvelle planète</small><?php } ?>
				</h1>
			</div>

			<form id="form_feats" action="/inscriptions/admin/planets" method="post" class="form-horizontal">

				<div class="panel-body">

					<div class="form-group">
						<label for="code" class="col-sm-3 control-label">Code</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="code" name="code" placeholder="Code" required maxlength="40" value="<?php echo $planets['code']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom" required maxlength="40" value="<?php echo $planets['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="description" name="description" placeholder="Description" required maxlength="500"><?php echo $planets['description']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label required">Position</label>
						<div class="col-sm-8">
							<div class="form-inline">
								<div class="input-group">
									<div class="input-group-addon">&Xscr;</div>
									<input type="number" class="form-control" id="position-x" name="position[x]" required min="-1500" max="1500" value="<?php echo $planets['position']['x']; ?>">
								</div>
								
								<div class="input-group">
									<div class="input-group-addon">&Yscr;</div>
									<input type="number" class="form-control" id="position-y" name="position[y]" required min="-1500" max="1500" value="<?php echo $planets['position']['y']; ?>">
								</div>
								
								<div class="input-group">
									<div class="input-group-addon">&Zscr;</div>
									<input type="number" class="form-control" id="position-z" name="position[z]" required min="-1500" max="1500" value="<?php echo $planets['position']['z']; ?>">
								</div>
								<p class="help-block">Nombre entre -1500 et 1500</p>
							</div>
						</div>
					</div>

					<hr />

					<div class="form-group">
						<label for="rhodium" class="col-sm-3 control-label">Niveau de Rhodium</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" id="rhodium" name="rhodium" required min="1" max="5" value="<?php echo $planets['rhodium']; ?>">
						</div>
						<div class="col-sm-6">
							<p class="help-block">Quantité de Rhodium exploitable, cote de 1 à 5</p>
						</div>

					</div>

					<div class="form-group">
						<label for="hazard" class="col-sm-3 control-label">Niveau de Danger</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" id="hazard" name="hazard" required min="1" max="5" value="<?php echo $planets['hazard']; ?>">
						</div>
						<div class="col-sm-6">
							<p class="help-block">Cote 1 à 5 mesurent l'hostilité de l'environement et de l'espèce dominante</p>
						</div>

					</div>


					<div class="form-group">
						<label for="texture" class="col-sm-3 control-label">Image d'embalage</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="texture" name="texture" placeholder="diffuseTexture" required maxlength="100" value="<?php echo $planets['texture']; ?>">
						</div>
					</div>


					<div class="form-group">
						<label for="bump" class="col-sm-3 control-label">Texture</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="bump" name="bump" placeholder="bumpTexture" maxlength="100" value="<?php echo $planets['bump']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="color" class="col-sm-3 control-label">Couleur émise</label>
						<div class="col-sm-2">
							<input type="color" class="form-control" id="color" name="color" value="<?php echo $planets['color']; ?>">
						</div>
					</div>

				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_planets" name="id_planets" value="<?php echo $planets['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/planets' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-planets" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
