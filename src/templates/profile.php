<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-user-circle"></i> Profil <small>Mise à jour des renseignements du joueur</small></h1>
			</div>

			<form id="form_profile" method="post" class="form-horizontal">

				<div class="bg-icon hidden-xs fa fa-user-circle"></div>

				<div class="panel-body">

					<div class="form-group">
						<label class="col-sm-3 control-label">Photo</label>
						<div class="col-sm-8"> 
						    
						    <button class="btn btn-default file-btn"> 
								<div>
									<img id="picture" src="<?php echo $_SESSION['player']['picture_url']; ?>" width="160" height="160" alt="Avatar" class="img-thumbnail">
								</div>
						        <i class="fa fa-cloud-upload" aria-hidden="true"></i> &nbsp;Modifier
						        <input type="file" id="upload" value="Select" /> 
						    </button> 
						    <div class="crop"> 
						        <div id="upload-demo"></div> 
						        <button class="btn btn-primary btn-sm upload-result"><i class="fa fa-check"></i> &nbsp;Accepter</button> 
						        <button class="btn btn-default btn-sm upload-cancel"><i class="fa fa-times"></i> &nbsp;Annuler</button> 
						    </div> 
						    <textarea id="base64_picture" name="avatar" class="hidden"></textarea>

						</div>
					</div>

					<hr />


					<div class="form-group">
						<label for="firstname" class="col-sm-3 control-label">Prénom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" required maxlength="40" value="<?php echo $_SESSION['player']['firstname']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-sm-3 control-label">Nom de famille</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom de famille" required maxlength="40" value="<?php echo $_SESSION['player']['lastname']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="birthday" class="col-sm-3 control-label">Date de naissance</label>
						<div class="col-sm-3">
							<div class="input-group">
								<input type="text" class="form-control" id="birthday" name="birthday" placeholder="AAAA-MM-JJ" required maxlength="10" data-date-format="yyyy-mm-dd" value="<?php echo substr($_SESSION['player']['birthday'], 0, 10); ?>">
								<label for="birthday" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="gender" class="col-sm-3 control-label">Sexe</label>
						<div class="col-sm-8">
							<label class="radio-inline">
								<input type="radio" name="gender" value="M" <?php if ($_SESSION['player']['gender'] == "M") echo 'checked'; ?> required>
								<i class="fa fa-mars"></i> Masculin
							</label>
							<label class="radio-inline">
								<input type="radio" name="gender" value="F" <?php if ($_SESSION['player']['gender'] == "F") echo 'checked'; ?> required>
								<i class="fa fa-venus"></i> Féminin
							</label>
						</div>
					</div>


					<hr />

					<div data-toggle="modal" data-target="#modal-forget-password">
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Courriel 	<i role="button" class="glyphicon glyphicon-info-sign"></i></label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" placeholder="Courriel" value="<?php echo $_SESSION['player']['email']; ?>" disabled>

							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Mot de passe <i role="button" class="glyphicon glyphicon-info-sign"></i></label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="password" value="00000000" disabled>
							</div>
						</div>
					</div>

					
					<hr />

			        <div class="form-group">
						<label for="profil_attachments" class="col-sm-3 control-label">Joindre des documents</label>
						<div class="col-sm-8">
			            
							<div class="alert alert-info" role="alert">
								<p>Vous pouvez joindre à votre profil la Décharge de responsabilité, l'Autorisation parentale ou tous autres informations que vous jugez pertinantes d'être partager avec l'organisation.</p>
								<p>Nous acceptons les fichiers .PDF, .DOC, .DOCX ou .ODF</p>
							</div>

			            	<div id="files_lst" class="list-group">
			            		<?php echo $attachments_lst; ?>
							</div>


		            		<input id="profil_attachments" type="file" multiple>
			            </div>
			        </div>


				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_player" name="id_player" value="<?php echo $_SESSION['player']['id']; ?>">
					<button id="save-profile" type="submit" value="save" class="btn btn-primary btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>

<form id="form-auto" target="_blank" method="post" class="hidden">
</form>

<div id="modal-forget-password" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier mon courriel ou mon mot de passe !</h4>
      </div>
      <div class="modal-body">
        
		<p>Si vous vous connectez à partir des boutons Facebook ou Google, vous n’avez plus besoin de retenir de mot de passe.</p>
		<p>Par-contre, le système de Rh-PATAF utilise votre adresse courriel pour faire le lien avec votre compte de média social. Si vous la changé, assurez-vous de faire la même chose dans Facebook ou Google sinon, Rh-PATAF pourrait ne pas vous reconnaitre.</p>
		<p>Si vous voulez quand-même changer votre courriel ou votre mot de passe, utilisez le lien à cet effet dans le menu.</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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
	    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

