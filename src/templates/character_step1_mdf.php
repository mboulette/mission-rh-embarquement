<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-users"></i> Personnages (Étapes 1/3)
					<?php if (is_numeric($character['id'])) {?><small>Modifier <?php echo $character['name']; ?></small><?php } ?>
					<?php if (!is_numeric($character['id'])) {?><small>Choix de la corporation, race et profession</small><?php } ?>
				</h1>
			</div>


			<form id="form_character" method="post" class="form-horizontal">

				<div class="panel-body">

					<div class="form-group">
						<label class="col-sm-3 control-label required">Corporation</label>
						<div class="col-sm-8">

							<div id="alert-corpo" class="alert alert-info" role="alert" <?php if ($character['id_corporation'] == 100) echo 'style="display:none;"'; ?>>
								<p>Le choix de votre corporation ne doit pas être pris à la légère, en plus d'avoir une influence sur la personnalité de votre personnage et son style vestimentaire, elle déterminera avec quel groupe d’amis vous allez jouer le plus souvent. C'est au côté de votre corporation que vous évoluez. C'est elle qui définit la plupart de vos objectifs, elle vous nourrit, vous soutient et vous encourage à persévérer.</p>
								<p>Il existe 5 corporations bien différentes dans leurs styles et leurs objectifs, chacune a accès plus facilement à un type de ressource. Consultez le manuel des joueurs pour avoir plus de détails sur les corporations.</p>
							</div>

							<button type="button" class="btn btn-default char-choice choice-corpo" data-open="close" data-list="corpo" <?php if ($character['id_corporation'] != 0) echo 'style="display:none;"'; ?>>
								<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;
								Faites le choix de votre corporation
								<span class="caret"></span>
							</button>

							<?php foreach ($corporations_lst as $corporation) { ?>

								<button id='btn_corpo_<?php echo $corporation['id']; ?>' type="button" class="btn btn-default char-choice choice-corpo" data-open="close" data-list="corpo" <?php if ($character['id_corporation'] != $corporation['id']) echo 'style="display:none;"'; ?>>
									<img src="<?php echo $corporation['picture_url']; ?>" width="16">
									<?php echo $corporation['name']; ?>
									<span class="caret"></span>
								</button>

							<?php } ?>

							<div id="list-corpo" style="display:none;">
								<div>&nbsp;</div>
								<?php foreach ($corporations_tpl as $corporation_card) { ?>
									<?php echo $corporation_card; ?>
								<?php } ?>
							</div>

						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label required">Race</label>
						<div class="col-sm-8">


							<div id="alert-race"  class="alert alert-info" role="alert" <?php if ($character['id_race'] == 100) echo 'style="display:none;"'; ?>>
								<p>Le choix de la race doit être fait parmi les 4 disponibles dans notre univers. Ce sont tous des évolutions ou modifications mineures de l'humain que vous connaissez. Ce choix influencent en grande majorité votre maquillage et l'historique de votre personnage. La race peut modifier les traits physiques et la façon dont vous incarnez votre personnage. De plus, chacune d’entre elle est rattachée à un bonus de départ ainsi que trois habiletés uniques, parmis lesquelles vous devez faire un choix.</p>
								<p>Si vous éprouvez des difficultés à choisir, nous vous recommandons l'humain, curieusement, il a bien des points en commun avec vous. Consultez le manuel des joueurs pour avoir plus de détails sur les races.</p>
							</div>

							<button type="button" class="btn btn-default char-choice choice-race" data-open="close" data-list="race" <?php if ($character['id_race'] != 0) echo 'style="display:none;"'; ?>>
								<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;
								Faites le choix de votre race
								<span class="caret"></span>
							</button>

							<?php foreach ($races_lst as $race) { ?>

								<button id='btn_race_<?php echo $race['id']; ?>' type="button" class="btn btn-default char-choice choice-race" data-open="close" data-list="race" <?php if ($character['id_race'] != $race['id']) echo 'style="display:none;"'; ?>>
									<img src="<?php echo $race['picture_url']; ?>" width="16">
									<?php echo $race['name']; ?>
									<span class="caret"></span>
								</button>

							<?php } ?>


							<div id="list-race" style="display:none;">
								<div>&nbsp;</div>
								<?php foreach ($races_tpl as $race_card) { ?>
									<?php echo $race_card; ?>
								<?php } ?>						
							</div>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label required">Profession</label>
						<div class="col-sm-8">
	

							<div id="alert-prof" class="alert alert-info" role="alert" <?php if ($character['id_profession'] == 100) echo 'style="display:none;"'; ?>>
								<p>Le choix de votre profession est déterminant, il précise les grandes lignes de vos occupations sur le vaisseau. Vous devez choisir parmis les 5 professions qui vous sont offertes. Chacune d'entre elles débloquent des recettes de fabrication qui une fois complétées, vous permettent d'effectuer des actions spécifiques en jeu. Ces actions seront certainement sollicité régulièrement pour menné à bien des missions pour votre groupe.</p>
								<p>Choisissez en fonction de vos goûts et vos aptitudes, par exemple, ne devenez pas patrouilleur si le port d’arme (même factice) vous horripile. Analysez les recettes, car en choisissant une profession, vous adhéré à une vocation. Comme les corporations et les races, les professions sont détaillés dans le manuel est joueurs.</p>
							</div>

							<button type="button" class="btn btn-default char-choice choice-prof" data-open="close" data-list="prof" <?php if ($character['id_profession'] != 0) echo 'style="display:none;"'; ?>>
								<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;
								Faites le choix de votre profession
								<span class="caret"></span>
							</button>

							<?php foreach ($professions_lst as $profession) { ?>
								<button id="btn_prof_<?php echo $profession['id']; ?>" type="button" class="btn btn-default char-choice choice-prof" data-open="close" data-list="prof" <?php if ($character['id_profession'] != $profession['id']) echo 'style="display:none;"'; ?>>
									<img src="<?php echo $profession['picture_url']; ?>" width="16">
									<?php echo $profession['name']; ?>
									<span class="caret"></span>
								</button>

							<?php } ?>


							<div id="list-prof" style="display:none;">
								<div>&nbsp;</div>
								<?php foreach ($professions_tpl as $profession_card) { ?>
									<?php echo $profession_card; ?>
								<?php } ?>
							</div>	
						</div>
					</div>


					<div class="alert alert-danger alert-required" role="alert" style="display:none;">
						<strong>Erreur de validation :</strong> Pour continuer, vous devez obligatoirement choisir une corporation, une race et une profession.
					</div>

				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_character" name="id_character" value="<?php echo $character['id']; ?>">
					<input type="hidden" id="step" name="step" value="1">

					<a href='/inscriptions/characters' class="btn btn-default btn-lg backlink">Annuler</a>
					<button type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-step-forward"></i> &nbsp;Étape suivante</button>
				</div>
			</form>		
			

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>

<form id="form-auto" target="_blank" method="post" class="hidden">
</form>
