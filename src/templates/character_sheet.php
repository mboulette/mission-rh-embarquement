<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Participant <small><?php echo str_cut($player['firstname'].'  '.$player['lastname'], 60); ?></small></h1>
			</div>


			<div class="panel-body">

				<div class="form-horizontal">
				
					<a href="/inscriptions/events" class="btn btn-warning backlink"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste</a>

					<hr>

					<div class="row">
						<div class="col-xs-6 col-sm-4 col-md-2" >
							<div style="width:120px; height:120px; background:url(https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $inscription['id_transaction'];?>) center no-repeat;"></div>
						</div>
						<div class="col-sm-4 col-md-2">
							<img class="img-rounded" src="<?php echo $player['picture_url'];?>" width="120">
						</div>
						<div class="hidden-xs hidden-sm col-md-2 pull-right">
							<img class="img-rounded" src="<?php echo  $character['corporation']['picture_url'];?>" width="120">
						</div>
						<div class="hidden-xs hidden-sm col-md-2 pull-right">
							<img class="img-rounded" src="<?php echo  $character['race']['picture_url'];?>" width="120">
						</div>
						<div class="hidden-xs hidden-sm	col-md-2 pull-right">
							<img class="img-rounded" src="<?php echo  $character['profession']['picture_url'];?>" width="120">
						</div>
					</div>

					
					<hr>

					<div class="row">
						<div class="col-md-6" >
							<h3>Joueur</h3>
							<p>
								<strong>Nom :</strong> <?php echo $player['firstname'].'  '.$player['lastname'];?><br />
								<strong>Date de naissance :</strong> <?php echo substr($player['birthday'], 0, 10);?><br />
								<strong>Sexe :</strong> <?php echo $player['gender'];?><br />
								<strong>Courriel :</strong> <?php echo $player['email'];?><br />
							</p>

							<h3>Personnage</h3>
							
							<p>
								<strong>Nom :</strong> <?php echo $character['name'];?><br />
								<strong>Corporation :</strong> <?php echo $character['corporation']['name'];?><br />
								<strong>Race :</strong> <?php echo $character['race']['name'];?><br />
								<strong>Profession :</strong> <?php echo $character['profession']['name'];?><br />
								<strong>Grade :</strong> <?php echo $character['rank'];?><br />
								<strong>Bilan de santé :</strong> <?php echo $character['health_points'];?> / 100<br />
								<br />
								<strong>Habiletés :</strong> <?php echo $character['skill']['name'];?><br />
								<?php echo $character['skill']['description'];?>

							</p>

							<h3>Talents</h3>
							<?php
							foreach ($character['feats'] as $feats) {
								echo '<strong>- </strong>'.$feats['name'].'<br />';
							}
							?>

						</div>

						<div class="col-md-6" >

							<h3>Évènement</h3>

							<p>
								<strong>Nom :</strong> <?php echo $event['name'];?><br />
								<strong>Date de l'évènement :</strong> <?php echo $event['date_event'];?><br />
								<strong>Nombre de places :</strong> <?php echo $event['max_places'];?><br />
							</p>

							<?php
							$inscription_created = new DateTime($inscription['date_created']);
							$inscription_updated = new DateTime($inscription['date_updated']);
							?>
							<h3>Inscription</h3>
							<p>
								<strong>Transaction :</strong> <?php echo $inscription['id_transaction'];?><br />
								<strong>Date d'inscription :</strong> <?php echo $inscription_created->format('Y-m-d H:i');?><br />
								<strong>Date mis à jour :</strong> <?php echo $inscription_updated->format('Y-m-d H:i');?><br />
								<strong>Total :</strong> <?php echo number_format($inscription['amount'], 2);?> $<br />
							</p>

							<h3>Options</h3>
							<?php
							foreach (json_decode($inscription['options'], true) as $option) {
								echo '<strong>'.$option['qty']. ' x </strong>'.$option['name'];

								foreach ($option as $key => $value) {
									if ($key != 'name' && $key != 'qty' && $key != 'total'  && $key != 'price') {
										echo '&nbsp;<span class="label label-default">'.$key.':'.$value.'</span>';
									}
								}

								echo '<br />';
							}

							?>

							<h3>Ressources</h3>
							<?php

							$corpo_ressource = true;

							foreach (json_decode($inscription['ressources'], true) as $ressource) {
								if ($character['corporation']['ressource']['name'] == $ressource['name']) {
									echo '<strong>'.($ressource['qty']+2). ' x '.$ressource['name'].'</strong><br />';
									$corpo_ressource = false;
								} else {
									echo '<strong>'.$ressource['qty']. ' x </strong>'.$ressource['name'].'<br />';									
								}
							}

							if ($corpo_ressource) {
								echo '<strong>2 x '.$character['corporation']['ressource']['name'].'</strong><br />';
							}

							echo '<strong>'.$inscription['credits']. ' x </strong>Crédits restants<br />';
							?>
						</div>
					</div>


				</div>
				
			</div>
			<div class="panel-footer text-right">

			</div>
			
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>


<form id="form-auto" target="_blank" method="post" class="hidden">
	<input type="text" name="id">
	<input type="text" name="submitaction">
</form>
