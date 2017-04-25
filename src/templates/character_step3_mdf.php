<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-users"></i> Personnages  (Étapes 3/3)
					<?php if (is_numeric($character['id'])) {?><small>Modifier <?php echo $character['name']; ?></small><?php } ?>
					<?php if (!is_numeric($character['id'])) {?><small>Choix du nom et création de l'historique du personnage</small><?php } ?>
				</h1>
			</div>


			<form id="form_character" method="post" class="form-horizontal">

				<div class="panel-body">

					<?php if ($character['rank'] != 0) { ?>
						<div class="alert alert-danger" role="alert">Puisque ce personnage a déjà participé à un évènement, vous ne pouvez pas le modifier dans sont intégralité, si vous voulez modifier autre chose que son nom, sa description ou son historique, contactez un administrateur.</div>
					<?php } ?>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom du personnage</label>
						<div class="col-sm-8">


							<div class="input-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Nom du personnage" required maxlength="40" value="<?php echo $character['name']; ?>">
 								<div class="input-group-btn">
								<button id="rnd-name" type="button" class="btn btn-default" data-url="//uinames.com/api/?gender=<?php echo ($_SESSION['player']['gender'] == 'F' ? 'female' : 'male'); ?>&region=canada">
									<i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;
									Choisir pour moi
								</button>
								</div>
							</div>
						
						</div>
					</div>

					<div class="form-group">
						<label for="notes" class="col-sm-3 control-label">Courtes description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="3" id="notes" name="notes" placeholder="Notes" required maxlength="500"><?php echo $character['notes']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="background" class="col-sm-3 control-label">Historique (Background)</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="background" name="background" placeholder="Historique" maxlength="5000"><?php echo $character['background']; ?></textarea>
						</div>
					</div>


					<div class="form-group">
						<label for="characters_attachments" class="col-sm-3 control-label">Joindre des documents</label>
						<div class="col-sm-8">
						
							<div class="alert alert-info" role="alert">
								<p>Vous pouvez joindre à votre personnage des document d'historique, des descriptions ou tous autres informations que vous jugez pertinantes d'être partager avec les scénaristes.</p>
								<p>Nous acceptons les documents .PDF, .DOC, .DOCX, .ODF ou des images .JPG, .PNG</p>
							</div>

			            	<div id="files_lst" class="list-group">
			            		<?php echo $attachments_tpl; ?>
							</div>

							<input id="characters_attachments" type="file" multiple>
						</div>
					</div>


				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_character" name="id_character" value="<?php echo $character['id']; ?>">
					<input type="hidden" id="id_player" name="id_player" value="<?php echo $character['id_player']; ?>">
					<input type="hidden" id="step" name="step" value="3">

					<input type="hidden" id="id_race" name="id_race" value="<?php echo $character['id_race']; ?>">
					<input type="hidden" id="id_profession" name="id_profession" value="<?php echo $character['id_profession']; ?>">
					<input type="hidden" id="id_corporation" name="id_corporation" value="<?php echo $character['id_corporation']; ?>">

					<input type="hidden" id="id_skill" name="id_skill" value="<?php echo $character['id_skill']; ?>">
					<input type="hidden" id="feats" name="feats" value='<?php echo $character['feats']; ?>'>

					<a href='/inscriptions/characters' class="btn btn-default btn-lg backlink">Annuler</a>
					<?php if ($character['rank'] == 0) { ?>
						<button id="btn_char_stepback" type="button" class="btn btn-default btn-lg"><i class="fa fa-step-backward"></i> &nbsp;Étape précédente</button>
					<?php } ?>
					<button id="save-character" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			</form>		
			

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>

<form id="form-auto" target="_blank" method="post" class="hidden">
</form>

<form id="frm_char_stepback" action="/inscriptions/characters/edit" method="post" class="hidden">
	<input type="hidden" name="id_character" value="<?php echo $character['id']; ?>">
	<input type="hidden" id="step" name="step" value="1">
	<input type="hidden" id="id_race" name="id_race" value="<?php echo $character['id_race']; ?>">
	<input type="hidden" id="id_profession" name="id_profession" value="<?php echo $character['id_profession']; ?>">
	<input type="hidden" id="id_corporation" name="id_corporation" value="<?php echo $character['id_corporation']; ?>">

	<input type="hidden" id="id_skill" name="id_skill" value="<?php echo $character['id_skill']; ?>">
	<input type="hidden" id="feats" name="feats" value='<?php echo $character['feats']; ?>'>
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