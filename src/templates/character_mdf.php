<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-users"></i> Personnages 
					<?php if (is_numeric($character['id'])) {?><small>Modifier <?php echo $character['name']; ?></small><?php } ?>
					<?php if (!is_numeric($character['id'])) {?><small>Création d'un nouveau personnage</small><?php } ?>
				</h1>
			</div>


			<form id="form_character" method="post" class="form-horizontal">

				<div class="bg-icon hidden-xs fa fa-users"></div>

				<div class="panel-body">

					<?php if ($character['rank'] != 0) { ?>
						<div class="alert alert-danger" role="alert">Puisque ce personnage a déjà participé à un évènement, vous ne pouvez pas le modifier dans sont intégralité, si vous voulez modifier autre chose que son nom, sa description ou son historique, contactez un administrateur.</div>
					<?php } ?>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom du personnage</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom du personnage" required maxlength="40" value="<?php echo $character['name']; ?>">
						//https://uinames.com/api/?gender=female&region=canada
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
						<label class="col-sm-3 control-label required">Corporation</label>
						<div class="col-sm-8">

							<div class="alert alert-info" role="alert">
								<p>Le choix de votre corporation ne doit pas être pris à la légère, en plus d'avoir une influence sur la personnalité de votre personnage et son style vestimentaire, elle déterminera avec quel groupe d’amis vous allez jouer le plus souvent. C'est au côté de votre corporation que vous évoluez. C'est elle qui définit la plupart de vos objectifs, elle vous nourrit, vous soutient et vous encourage à persévérer.</p>
								<p>Il existe 5 corporations bien différentes dans leurs styles et leurs objectifs, chacune a accès plus facilement à un type de ressource. Consultez le manuel des joueur pour avoir plus de détails sur les corporations.</p>
							</div>

							<?php foreach ($corporations_tpl as $corporation_card) { ?>
								<?php echo $corporation_card; ?>
							<?php } ?>

						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label required">Race</label>
						<div class="col-sm-8">

							<div class="alert alert-info" role="alert">
								<p>Le choix de la race doit être fait parmi les 4 disponibles dans notre univers. Ce sont tous des évolutions ou modifications mineures de l'humain que vous connaissez. Ce choix influencent en grande majorité votre maquillage et l'historique de votre personnage. La race peut modifier les traits physiques et la façon dont vous incarnez votre personnage. De plus, chacune d’entre elle est rattachée à une tare de départ ainsi que trois habiletés uniques, parmis lesquelles vous devez faire un choix.</p>
								<p>Si vous éprouvez des difficultés à choisir, nous vous recommandons l'humain, curieusement, il a bien des points en commun avec vous. Consultez le manuel des joueur pour avoir plus de détails sur les races.</p>
							</div>


							<?php foreach ($races_tpl as $race_card) { ?>
								<?php echo $race_card; ?>
							<?php } ?>						

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label required">Profession</label>
						<div class="col-sm-8">
	
							<div class="alert alert-info" role="alert">
								<p>Le choix de votre profession est déterminant, il précise les grandes lignes de vos occupations sur le vaisseau. Vous devez choisir parmis les 5 professions qui vous sont offertes. Chacune d'entre elles débloquent des recettes de fabrication qui une fois complétées, vous permettent d'effectuer des actions spécifiques en jeu. Ces actions seront certainement sollicité régulièrement pour menné à bien des missions pour votre groupe.</p>
								<p>Choisissez en fonction de vos goûts et vos aptitudes, par exemple, ne devenez pas patrouilleur si le port d’arme (même factice) vous horripile. Analysez les recettes, car en choisissant une profession, vous adhéré à une vocation. Comme les corporations et les races, les professions sont détaillés dans le manuel est joueur.</p>
							</div>

							<?php foreach ($professions_tpl as $profession_card) { ?>
								<?php echo $profession_card; ?>
							<?php } ?>
	
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
			            		<?php echo $attachments_lst; ?>
							</div>

							<input id="characters_attachments" type="file" multiple>
						</div>
					</div>




				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_character" name="id_character" value="<?php echo $character['id']; ?>">
					<input type="hidden" id="id_player" name="id_player" value="<?php echo $character['id_player']; ?>">

					<a href='/inscriptions/characters' class="btn btn-default btn-lg backlink">Annuler</a>
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