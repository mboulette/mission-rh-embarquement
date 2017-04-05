<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Talents 
					<?php if (is_numeric($feats['id'])) {?><small>Modifier <?php echo str_cut($feats['name'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($feats['id'])) {?><small>Création d'un nouveau talent</small><?php } ?>
				</h1>
			</div>

			<form id="form_feats" action="/inscriptions/admin/feats" method="post" class="form-horizontal">

				<div class="panel-body">

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom" required maxlength="40" value="<?php echo $feats['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="description" name="description" placeholder="Description" required maxlength="1000"><?php echo $feats['description']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-sm-3 control-label">Lien</label>
						<div class="col-sm-8">
							<input type="url" class="form-control" id="link" name="link" placeholder="http://www.exemple.com" maxlength="200" value="<?php echo $feats['link']; ?>">
							<p class="help-block">URL vers une page d'information supplémentaire</p>
						</div>
					</div>


					<div class="form-group">
						<label for="prerequisites" class="col-sm-3 control-label">Prérequis</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="prerequisites" name="prerequisites" placeholder="Conditions préalables" maxlength="1000"><?php echo $feats['prerequisites']; ?></textarea>
						</div>
					</div>

				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_feats" name="id_feats" value="<?php echo $feats['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/feats' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-feats" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
