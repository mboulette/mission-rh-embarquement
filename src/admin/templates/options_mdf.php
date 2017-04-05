<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Options 
					<?php if (is_numeric($options['id'])) {?><small>Modifier <?php echo str_cut($options['name'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($options['id'])) {?><small>Création d'une nouvelle option</small><?php } ?>
				</h1>
			</div>

			<form id="form_options" action="/inscriptions/admin/options" method="post" class="form-horizontal">

				<div class="panel-body">


					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom" required maxlength="40" value="<?php echo $options['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="description" name="description" placeholder="Description" required maxlength="500"><?php echo $options['description']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-sm-3 control-label">Lien</label>
						<div class="col-sm-8">
							<input type="url" class="form-control" id="link" name="link" placeholder="http://www.exemple.com" maxlength="200" value="<?php echo $options['link']; ?>">
							<p class="help-block">URL vers une page d'information supplémentaire</p>
						</div>
					</div>

					<div class="form-group">
						<label for="price" class="col-sm-3 control-label">Prix</label>
						<div class="col-sm-3">
							<div class="input-group">
								<input type="number" class="form-control" id="price" name="price" placeholder="0.00" pattern='^\d+(\.\d{2})?$' max="200" min="0" step="0.01" title="(99.99)" required value="<?php echo number_format($options['price'], 2); ?>" >
								<div class="input-group-addon">$</div>
							</div>

						</div>
					</div>

					<div class="form-group">
						<label for="mandatory-x" class="col-sm-3 control-label required">Obligatoire</label>
						<div class="col-sm-2">
							<input type="checkbox" class="form-control" id="mandatory-x" name="mandatory-x" data-toggle="toggle" data-on="Obligatoire" data-off="Facultatif" data-onstyle="warning" <?php if ($options['mandatory']) echo 'checked'; ?>>
							<input type="hidden" id="mandatory" name="mandatory" value="<?php echo $options['mandatory']; ?>">
						</div>
						<div class="col-sm-offset-3 col-sm-8  col-lg-offset-0 col-lg-6 help-block">
							Une option obligatoire sera automatiquement ajouté au panier lors de l'inscription.
						</div>
					</div>

					<div class="form-group">
						<label for="locked-x" class="col-sm-3 control-label required">Activé</label>
						<div class="col-sm-2">
							<input type="checkbox" class="form-control" id="locked-x" name="locked-x" data-toggle="toggle" data-on="Désactivé" data-off="Activé" data-onstyle="danger" <?php if ($options['locked']) echo 'checked'; ?>>
							<input type="hidden" id="locked" name="locked" value="<?php echo $options['locked']; ?>">
						</div>
						<div class="col-sm-offset-3 col-sm-8  col-lg-offset-0 col-lg-6 help-block">
							Une option désactivé ne s'affichera pas lors de la prochaine inscription.
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-offset-3 col-sm-8">
							<h3>Précisions</h3>
						</div>
					</div>

					<div class="precision-container">

					</div>

					<div class="row">
						<div class="col-sm-offset-3 col-sm-8">
							<button id="add_precision" type="button" class="btn btn-warning"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Ajouter une précision</button>
						</div>
					</div>

					
				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_options" name="id_options" value="<?php echo $options['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/options' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-options" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
				<div class="template hidden">
									
					<textarea name="options"><?php echo $options['options']; ?></textarea>
					<div class="form-group component-precision">
							<label class="col-sm-3 control-label">::CHOIX::</label>
							<div class="col-sm-4 col-lg-3 ">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Nouvelle valeur">
									<span class="input-group-btn">
										<button type='button' class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button>
										<button type='button' class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
									</span>
								</div>
								<div style="margin-top:3px;">
									<select name="precision[::CHOIX::]" multiple class="form-control"></select>
								</div>
							</div>
					</div>
				</div>

			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
