<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-users"></i> Personnages <small>Modifier <?php echo $current['name']; ?></small></h1>
			</div>


			<form id="form_character" method="post" class="form-horizontal">

				<div class="bg-icon hidden-xs fa fa-users"></div>

				<div class="panel-body">

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom du personnage</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom du personnage" required maxlength="40" value="<?php echo $current['name']; ?>">
						</div>
					</div>


					<div class="form-group">
						<label for='id_race' class="col-sm-3 control-label">Race</label>
						<div class="col-sm-8">
							<?php foreach ($races_lst as $race) { ?>
								<label class="radio-inline">
									<input type="radio" name="id_race" value="<?php echo $race['id']; ?>" <?php if ($current['id_race'] == $race['id']) echo 'checked'; ?> required>
									<?php echo $race['name']; ?>
								</label>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label for='id_corporation' class="col-sm-3 control-label">Corporation</label>
						<div class="col-sm-8">
							<?php foreach ($corporations_lst as $corporation) { ?>
								<label class="radio-inline">
									<input type="radio" name="id_corporation" value="<?php echo $corporation['id']; ?>" <?php if ($current['id_corporation'] == $corporation['id']) echo 'checked'; ?> required>
									<?php echo $corporation['name']; ?>
								</label>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label for='id_profession' class="col-sm-3 control-label">Profession</label>
						<div class="col-sm-8">
							<?php foreach ($professions_lst as $profession) { ?>
								<label class="radio-inline">
									<input type="radio" name="id_profession" value="<?php echo $profession['id']; ?>" <?php if ($current['id_profession'] == $profession['id']) echo 'checked'; ?> required>
									<?php echo $profession['name']; ?>
								</label>
							<?php } ?>
						</div>
					</div>


					<div class="form-group">
						<label for="notes" class="col-sm-3 control-label">Courtes description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="3" id="notes" name="notes" placeholder="Notes" required maxlength="500"><?php echo $current['notes']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="background" class="col-sm-3 control-label">Historique (Background)</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="background" name="background" placeholder="Historique" maxlength="5000"><?php echo $current['background']; ?></textarea>
						</div>
					</div>


					<div class="form-group">
						<label for="characters_attachments" class="col-sm-3 control-label">Joindre des documents</label>
						<div class="col-sm-8">
						
							<div class="alert alert-warning" role="alert">
								<p>Vous pouvez joindre à votre personnage des document d'historique, des descriptions ou tous autres informations que vous jugez pertinantes d'être partager avec les scénaristes.</p>
								<p>Nous acceptons les documents .PDF, .DOC, .DOCX, .ODF ou les images .JPG, .PNG</p>
							</div>

							<div id="files_lst" class="list-group">
			            		<?php echo $attachments_lst; ?>
							</div>

							<input id="characters_attachments" type="file" multiple>
						</div>
					</div>




				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_character" name="id_character" value="<?php echo $current['id']; ?>">
					<input type="hidden" id="id_player" name="id_player" value="<?php echo $current['id_player']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="display">


					<a href='/inscriptions/admin/characters' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-character" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			</form>		
			

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>


<form id="form-auto" target="_blank" method="post" class="hidden">
</form>


<div id="modal-attachements" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Attendre!</h4>
	  </div>
	  <div class="modal-body">
		
		<p>Certaines pièces jointes n'ont pas terminé d'être téléversé sur le serveur. Veillez attendre la fin du transfert avant d'enregistrer</p>
		<p>Remarquez que vous devez cliquer sur le bouton «Transférer» pour démarrer l'upload. Le transfert peut être long selon le poids de vos documents et la vitesse de votre connexion internet.</p>


	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="confirm" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation de suppression</h4>
      </div>
      <div class="modal-body">
        
		<p>Êtes-vous certain de vouloir supprimer ce fichier ?</p>

      </div>
      <div class="modal-footer">
	    <button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
	    <button type="button" data-dismiss="modal" class="btn btn-warning" id="delete"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->