<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-envelope-o"></i> Profil <small>Changement de votre adresse courriel</small></h1>
			</div>

			<form id="form_email_update" method="post" class="form-horizontal">

				<div class="bg-icon hidden-xs fa fa-envelope-o"></div>

				<div class="panel-body">


					<div class="alert alert-warning" role="alert">
						<p><strong>Attention!</strong> Le système de Rh-PATAF utilise votre adresse courriel pour faire le lien avec vos compte de média social. Si vous utilisé la connexion automatique de Facebook ou Google, assurez-vous de faire le même changement dans Facebook ou Google sinon, Rh-PATAF pourrait ne pas vous reconnaitre.</p>
						<p>Soyez certain que vous ne faites aucune erreur dans votre nouvelle adresse, c'est aussi votre nom d'utilisateur et votre adresse pour réinitailiser votre mot de passe.</p>
					</div>


					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Nouveau courriel</label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="email" name="email" placeholder="Courriel" maxlength="200" required value="<?php echo $_POST['email']; ?>">

						</div>
					</div>


	                <!--
	                <div class="form-group">
	                  <label class="col-sm-3 control-label" for="signin_password">Mot de passe</label>

						<div class="col-sm-9">
							<div class="input-group">
								<input type="password" class="form-control" id="signin_password" name="signin_password" placeholder="Mot de passe" required>

								<span class="input-group-addon">
									<label><input id="signin_show_password" type="checkbox"> &nbsp;Afficher</lable>
								</span>
							</div>
						</div>
	                </div>
	            	-->


				</div>
				<div class="panel-footer text-right">
					<button id="save-profile" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
		

			</form>

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>