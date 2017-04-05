<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Habileté 
					<?php if (is_numeric($skills['id'])) {?><small>Modifier <?php echo str_cut($skills['name'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($skills['id'])) {?><small>Création d'une nouvelle habileté</small><?php } ?>
				</h1>
			</div>

			<form id="form_feats" action="/inscriptions/admin/skills" method="post" class="form-horizontal">

				<div class="panel-body">

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom" required maxlength="40" value="<?php echo $skills['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="description" name="description" placeholder="Description" required maxlength="1000"><?php echo $skills['description']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-sm-3 control-label">Lien</label>
						<div class="col-sm-8">
							<input type="url" class="form-control" id="link" name="link" placeholder="http://www.exemple.com" maxlength="200" value="<?php echo $skills['link']; ?>">
							<p class="help-block">URL vers une page d'information supplémentaire</p>
						</div>
					</div>

					<div class="form-group">
						<label for="feature_id" class="col-sm-3 control-label">Race</label>
						<div class="col-sm-8">
							<select name="feature_id" class="selectpicker">
								<?php foreach ($races as $race) { ?>
									<option 
									data-content="<img src='<?php echo $race['picture_url']; ?>' width='18'> &nbsp;<?php echo $race['name']; ?></span>"
									value="<?php echo $race['id']; ?>"
									<?php if ($skills['feature_id'] == $race['id']) echo 'selected'; ?>><?php echo $race['name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<label for="script" class="col-sm-3 control-label">Script</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="script" name="script" placeholder="Script" maxlength="1000"><?php echo $skills['script']; ?></textarea>
							<p class="help-block">Ne pas modifier - À l'usage de la programmation</p>
						</div>
					</div>


				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_skills" name="id_skills" value="<?php echo $skills['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/skills' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-feats" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
