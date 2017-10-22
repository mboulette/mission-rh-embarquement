<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-users"></i> Personnages  (Étapes 2/3)
					<?php if (is_numeric($character['id'])) {?><small>Modifier <?php echo $character['name']; ?></small><?php } ?>
					<?php if (!is_numeric($character['id'])) {?><small>Choix des habiletés et talents</small><?php } ?>
				</h1>
			</div>

			<form id="form_character" method="post" class="form-horizontal">

				<div class="panel-body">

					<div class="form-group">
						<label class="col-sm-3 control-label required">Habileté</label>
						<div class="col-sm-8">

							<div id="alert-corpo" class="alert alert-info" role="alert">
								<p>Toutes les races offrent 3 choix d’habiletés, normalement ces habiletés influencent le calcul de votre bilant de santé à la fin d’un évènement ou améliore le cout de certaines ressources primaires avant un évènement.</p>
								<p>Vous devez choisir une seule habileté parmi les suivantes, ce sont elles qui sont offertes par votre race.</p>
								<br />
								<button id="rnd-skills" type="button" class="btn btn-default">
									<i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;
									Choisir pour moi
								</button>
							</div>

							<?php foreach ($skills_tpl as $skill_card) { ?>
								<?php echo $skill_card; ?>
							<?php } ?>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label required">Talents</label>
						<div class="col-sm-8">

							<div id="alert-corpo" class="alert alert-info" role="alert">
								<p>Les talents sont des capacités spécifique à votre personnage, des actions que vous pouvez utiliser autant de fois que vous le voulez, tant que la situation de jeu respecte les prérequis décrient dans chaque talent. Le choix des talents n’est pas lié à une corporation, une race ou une profession, et avec les nombreuses options disponibles, ils donneront une couleur unique à votre rôle.</p>
								<p>Vous devez choisir 2 talents, <strong class="trois-talents <?php if ($character['id_skill'] != '22') echo 'hidden'; ?>">et un 3e à cause de votre habileté raciale, </strong>lisez-les attentivement, car, ce choix sera définitif jusqu'à la mort de votre personnage.</p>
								<br />
								<button id="rnd-feats" type="button" class="btn btn-default">
									<i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;
									Choisir pour moi
								</button>

							</div>

							<?php foreach ($feats_tpl as $feat_card) { ?>
								<?php echo $feat_card; ?>
							<?php } ?>

						</div>
					</div>

					<div class="alert alert-danger alert-required" role="alert" style="display:none;">
						<strong>Erreur de validation :</strong> Pour continuer, vous devez obligatoirement choisir une habileté, et 2 talents<strong class="trois-talents  <?php if ($character['id_skill'] != '22') echo 'hidden'; ?>"> et un 3e à cause de votre habileté raciale</strong>.
					</div>

				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_character" name="id_character" value="<?php echo $character['id']; ?>">
					<input type="hidden" id="step" name="step" value="2">

					<input type="hidden" id="id_race" name="id_race" value="<?php echo $character['id_race']; ?>">
					<input type="hidden" id="id_profession" name="id_profession" value="<?php echo $character['id_profession']; ?>">
					<input type="hidden" id="id_corporation" name="id_corporation" value="<?php echo $character['id_corporation']; ?>">

					<a href='/inscriptions/characters' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="btn_char_stepback" type="button" class="btn btn-default btn-lg"><i class="fa fa-step-backward"></i> &nbsp;Étape précédente</button>
					<button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-step-forward"></i> &nbsp;Étape suivante</button>
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
	<input type="hidden" id="id_race" name="id_race" value="<?php echo $character['id_race']; ?>">
	<input type="hidden" id="id_profession" name="id_profession" value="<?php echo $character['id_profession']; ?>">
	<input type="hidden" id="id_corporation" name="id_corporation" value="<?php echo $character['id_corporation']; ?>">
</form>
