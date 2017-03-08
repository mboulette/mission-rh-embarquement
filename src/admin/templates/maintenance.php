<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-wrench"></i> Maintenance <small>Arrêter le site pour des mises à jours</small></h1>
			</div>

			<form id="form_maintenance" method="post" class="form-horizontal">

				<div class="bg-icon hidden-xs fa fa-wrench"></div>

				<div class="panel-body">

					<div class="alert alert-info" role="alert">
						En cas de problèmes, vous pouvez choisir d'arrêter le système pour les joueurs et/ou pour les administrateurs.
					</div>

					<div class="form-group">
						<label for="lock_players-x" class="col-sm-3 control-label required">Joueurs</label>
						<div class="col-sm-2">
							<input type="checkbox" class="form-control" id="lock_players-x" name="lock_players-x" data-toggle="toggle" data-onstyle="danger" data-offstyle="primary" data-on="Arrêté" data-off="Fonctionnel" <?php if ($maintenance['lock_players']) echo 'checked'; ?>>
							<input type="hidden" id="lock_players" name="lock_players" value="<?php echo $maintenance['lock_players']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="lock_admins-x" class="col-sm-3 control-label required">Administrateurs</label>
						<div class="col-sm-2">
							<input type="checkbox" class="form-control" id="lock_admins-x" name="lock_admins-x" data-toggle="toggle" data-onstyle="danger" data-offstyle="primary" data-on="Arrêté" data-off="Fonctionnel" <?php if ($maintenance['lock_admins']) echo 'checked'; ?>>
							<input type="hidden" id="lock_admins" name="lock_admins" value="<?php echo $maintenance['lock_admins']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Message</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="description" name="description" placeholder="Description" required maxlength="500"><?php echo $maintenance['description']; ?></textarea>
							<p class="help-block">Ce message sera affiché au utilisateurs si le système est arrêté.</p>
						</div>
					</div>


				</div>
				<div class="panel-footer text-right">
					<button id="save-maintenance" type="submit" value="save" class="btn btn-primary btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>

