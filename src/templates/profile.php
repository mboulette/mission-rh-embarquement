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
						    
						    <div class="btn btn-default file-btn"> 
								<div>
									<img id="picture" src="<?php echo $_SESSION['player']['picture_url']; ?>" width="160" height="160" alt="Avatar" class="img-thumbnail">
								</div>
						        <i class="fa fa-cloud-upload" aria-hidden="true"></i> &nbsp;Modifier
						        <input type="file" id="upload" value="Select" /> 
						    </div> 
						    <div class="crop"> 
						        <div id="upload-demo"></div> 
						        <button class="btn btn-warning btn-sm upload-result"><i class="fa fa-check"></i> &nbsp;Accepter</button> 
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
						<label for="birthday_picker" class="col-sm-3 control-label">Date de naissance</label>
						<div class="col-sm-4 col-lg-3">
							<div class="input-group">
								<input type="text" class="form-control" id="birthday_picker" name="birthday_picker" placeholder="AAAA-MM-JJ" required maxlength="10" value="<?php echo substr($_SESSION['player']['birthday'], 0, 10); ?>">
								<label for="birthday_picker" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>
							</div>

							<input type="hidden" class="form-control" id="birthday" name="birthday"value="<?php echo substr($_SESSION['player']['birthday'], 0, 10); ?>">
						</div>
					</div>


					<div class="form-group">
						<label for="gender-x" class="col-sm-3 control-label required">Sexe</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" id="gender-x" name="gender-x" data-toggle="toggle" data-onstyle="warning" data-off="<i class='fa fa-mars'></i> Masculin" data-on="<i class='fa fa-venus'></i> Féminin" <?php if ($_SESSION['player']['gender'] == "F") echo 'checked'; ?>>
							<input type="hidden" id="gender" name="gender" value="<?php echo $_SESSION['player']['gender']; ?>">
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
			            
							<div class="alert alert-warning" role="alert">
								<p>Vous pouvez joindre à votre profil la Décharge de responsabilité, l'Autorisation parentale ou tous autres informations que vous jugez pertinantes d'être partager avec l'organisation.</p>
								<p>Nous acceptons les documents .PDF, .DOC, .DOCX, .ODF ou les images .JPG, .PNG</p>
							</div>

			            	<div id="files_lst" class="list-group">
			            		<?php echo $attachments_lst; ?>
							</div>


		            		<input id="profil_attachments" type="file" multiple>
			            </div>
			        </div>

					<hr />


			        <div class="form-group">
						<label class="col-sm-3 control-label">Décharge de responsabilité</label>
						<div class="col-sm-8">

							<div class="panel panel-default">
						        <div class="terms">
									<p><strong>Je déclare dégager de toutes responsabilités en cas d'accident de quelque nature que ce soit ou de dommages sans aucune exception ni réserve le Grandeur-Nature Mission Rh-PATAF et son organisme mère Grandeur Nature Abeas Corpus, ainsi que toutes les personnes oeuvrant pour cet organisation, et ce, pour toutes les évènements chapeauté par cet organisation ayant lieu entre le 1<sup>er</sup> janvier <?php echo date("Y"); ?> et le 31 décembre <?php echo date("Y"); ?>.</strong></p>
									<p>Il est de ma responsabilité de veiller à ma propre sécurité en usant des précautions nécessaires lors de mes déplacements et activités sur le terrain.</p>

									<p>Je déclare avoir lu et accepté les clauses suivantes :</p>
									<ul>
										<li>Je suis conscient des risques encourus par la pratique du jeu d'immersione et des activités proposées par Grandeur nature Abeas Corpus et que les activités proposées comprennent des activités de combat à l'aide d'armes factices.</li>
										<li>Je m'engage à respecter les consignes de sécurité qui me seront communiquées par l'organisation au début de chaque activité. Je m'engage également à respecter la règle interdisant la consommation ou la possession de toutes drogues ou alcools lors des activités organisées par Grandeur nature Abeas Corpus.</li>
										<li>Je prends en compte que les organisateurs s'engagent à faire respecter les règles de sécurité qu’ils ont établies pour éviter tout danger. Un participant refusant de respecter les règles établies, ou qui sont considérées immatures pour le jeu, et pouvant nuire à sa sécurité et au déroulement des activités sera expulsé du jeu.</li>
										<li>J’assume la responsabilité de tout dommage que je pourrais causer aux biens, meubles ou immeubles ou encore à la personne d'autrui. Je m'engage également à faire preuve de respect envers l'équipement des autres et les constructions présentes sur le terrain et à rendre tout matériel ne m'appartenant pas à la fin de l'activité.</li>
										<li>Je décharge les membres de l'organisation de Grandeur nature Abeas Corpus de leur responsabilité sur les dommages à ma personne et/ou à mes biens, qui pourraient survenir à l'occasion des activités organisées Grandeur nature Abeas Corpus.</li>
										<li>J'accepte sans réserve tous les risques liés à la participation au jeu de rôle grandeur nature même s'ils découlent de la négligence ou de la négligence grave, notamment les complications ou l'aggravation de lésions occasionnées par des opérations ou procédures de sauvetage négligentes, de la part des organisateurs ou des personnes qui y sont liées ou qui y participent.</li>
										<li>Je dégage la responsabilité total et définitif les organisateurs, les personnes et organismes qui y sont liés et les responsables du jeu de rôle grandeur nature, notamment ses administrateurs, ses officiels, ses mandataires et ses bénévoles, les autres participants, les commanditaires, les publicitaires, les propriétaires et les bailleurs des lieux où se déroule l'activité, les organismes d'homologation, le personnel médical et les secouristes (les renonciataires), en ce qui concerne les lésions, les invalidités, les décès, les préjudices personnels ou les dommages matériels, qu'ils soient occasionnés par la négligence, la négligence grave ou le sauvetage négligent par ou pour les personnes et organismes mentionnés ci-avant ou par d'autres moyens.</li>
										<li>Je m'engage de ne pas intenter des poursuites contre les renonciataires en ce qui concerne les sinistres, lésions, coûts ou dommages, quelles que soient leur nature et leur cause, et peu importe qu'ils soient causés directement ou indirectement par la participation au jeu d'immersion.</li>
										<li>Je dégage de toutes responsabilités les renonciataires, collectivement et individuellement, en ce qui concerne les frais judiciaires, les frais juridiques, la responsabilité, les dommages-intérêts, les dédommagements ou les coûts, sous quelque forme que ce soit, dont ils peuvent faire l'objet par suite d'une réclamation présentée contre eux, collectivement ou individuellement, que cette dernière repose sur leur négligence grave ou qu’elle découle pour d'autres raisons de la participation au jeu de rôle grandeur nature.</li>
										<li>Il est entendu qu'en consentant à ce document, j'abandonne des droits importants reconnus par la loi. J'ai lu cet abandon de responsabilités et suppositions des risques et je comprends que par ma signature j'accepte de ma part et de ma succession, mes successeurs et assignés de ne pas poursuivre Grandeur nature Abeas Corpus ou de les tenir responsable pour toutes blessures, incluant la mort, résultant du fait que je joue le du jeu de rôle grandeur nature. Je suis lié par cette entente.</li>
									</ul>
						        </div>

							</div>				

							<label class="row decharge">

								<div class="col-xs-2 col-sm-1 text-right">
									<i class="fa fa-square-o fa-2x"></i>
									<i class="fa fa-check-square hidden fa-2x"></i>
								</div>
								<div class="col-xs-10 col-sm-11">
									<input class="hidden" type="checkbox" name="decharge" id="decharge" value="<?php echo date('Y-m-d H:i'); ?>">
									<h4>
										J'affirme avoir lu et approuvé la précédente décharge de responsabilité.<br>
										<small>Je coche cette case volontairement et sans contrainte.</small>
									</h4>
								</div>
							</label>
							<div class="alert alert-danger hidden alert-decharge" role="alert">Vous devez approuver la décharge de responsabilité pour compléter votre profil.</div>

							
						
						</div>
					</div>

				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_player" name="id_player" value="<?php echo $_SESSION['player']['id']; ?>">
					<button id="save-profile" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
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
	    <button type="button" data-dismiss="modal" class="btn btn-warning" id="delete"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

