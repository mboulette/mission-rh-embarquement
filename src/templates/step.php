
	<?php if (!$player_has_registrations) { ?>
		<h2 class="text-center">Les étapes pour participer à un évènement</h2>
		<div class="row">
			<?php if (!$profile_completed) { ?>
				<div class="col-sm-3 text-center lead">
					<form action="/inscriptions/profile" class="home-step" method="post">
						<div>
							<span class="fa-stack fa-3x">
								<i class="fa fa-circle-thin fa-stack-2x"></i>
								<i class="fa fa-step">1</i>
							</span>
						</div>
						Compléter votre profil
					</form>
				</div>
			<?php } else { ?>
				<div class="col-sm-3 text-center lead text-success">
					<div>
						<span class="fa-stack fa-3x">
							<i class="fa fa-check-circle  fa-stack-2x"></i>
						</span>
					</div>
					Profil complété
				</div>
			<?php } ?>

			<?php if (!$character_completed) { ?>
				<div class="col-sm-3 text-center lead">
					<form action="/inscriptions/characters/edit" class="home-step" method="post">
						<input type="hidden" name="id_character" value="0">

						<div>
							<span class="fa-stack fa-3x">
								<i class="fa fa-circle-thin fa-stack-2x"></i>
								<i class="fa fa-step">2</i>
							</span>
						</div>
						Créer un personange

					</form>
				</div>
			<?php } else { ?>
				<div class="col-sm-3 text-center lead text-success">
					<div>
						<span class="fa-stack fa-3x">
							<i class="fa fa-check-circle  fa-stack-2x"></i>
						</span>
					</div>
					Personange créé
				</div>
			<?php } ?>

			<?php if (!$creditcard_completed) { ?>
				<div class="col-sm-3 text-center lead">
					<form action="/inscriptions/cards/edit" class="home-step" method="post">
						<input type="hidden" name="id_card" value="0">

						<div>
							<span class="fa-stack fa-3x">
								<i class="fa fa-circle-thin fa-stack-2x"></i>
								<i class="fa fa-step">3</i>
							</span>
						</div>
						Ajouter une carte de crédit
					</form>
				</div>
			<?php } else { ?>
				<div class="col-sm-3 text-center lead text-success">
					<div>
						<span class="fa-stack fa-3x">
							<i class="fa fa-check-circle  fa-stack-2x"></i>
						</span>
					</div>
					Carte de crédit ajouté
				</div>
			<?php } ?>
			<div class="col-sm-3 text-center lead">
				<form action="/inscriptions/events" class="home-step" method="post">
					<div>
						<span class="fa-stack fa-3x">
							<i class="fa fa-circle-thin fa-stack-2x"></i>
							<i class="fa fa-step">4</i>
						</span>
					</div>
					Procéder à l'inscription
				</form>
			</div>
		</div>
		<hr />
	<?php } ?>
