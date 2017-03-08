<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-home"></i> Accueil</h1>
			</div>


				<div class="bg-icon hidden-xs fa fa-home"></div>

				<div class="panel-body">

					<?php echo $step; ?>

					<h2 class="text-center">Message d'intérêt générale</h2>
					<div>&nbsp;</div>
					<div class='row'>
						
						<?php if (!empty($event) && $event['isActive'] == 'Ouvert' && $event['isRegistered'] == 0) { ?>
							<?php
							$gn = $event;
							$date_event = new DateTime($gn['date_event']);
							?>

							<div class="col-md-6 card-conteiner">
								<div class="card card-event <?php if ($gn['isActive'] != 'Ouvert') echo 'disabled' ?>" style="background-color:#fff;">
									
									<form action="/inscriptions/events/register" method="post">
										<div class="row">
											<div class="col-xs-3 col-sm-3">
												
												<h1><?php echo $date_event->format('d'); ?></h1>
												<h2><?php echo  $GLOBALS['month_abbr'][$date_event->format('n')]; ?></h2>

												<div class="participants">
													<?php echo $gn['nbInscription']. '/'.$gn['max_places']; ?><br />
													<span>Participants</span>
												</div>
											</div>
											<div class="col-xs-9 col-sm-9">

												<h3><?php echo $gn['name']; ?></h3>
												<hr>
												<p><?php echo $gn['synopsis']; ?></p>
												<p>
													<input type="hidden" name="id_event" value="<?php echo $gn['id']; ?>">
													<?php if ($gn['isActive'] == 'Ouvert') { ?>
														<button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart"></i> &nbsp;Participer</button>
													<?php }?>
													<?php if ($gn['link'] != '' && $gn['link'] != NULL) { ?>
														<a target="_blank" class="btn btn-default" href="<?php echo $gn['link']; ?>"><i class="fa fa-search "></i> &nbsp;Détails</a>
													<?php }?>
												</p>

											</div>
											
										</div>
										
										<div class="alert alert-warning lead text-center" style="margin-top:10px;">Présentement ouvert pour l'inscription!</div>
										
										<div class="row">

											<?php
											if ($gn['isRegistered'] == 0) {
												echo '<div class="col-sm-9 text-right pull-right text-warning hidden-xs">Inscrivez-vous avant le : '.substr($gn['inscription_end'], 0, -3).'</div>';
											} elseif ($gn['isRegistered'] == 1) {
												echo '<div class="col-sm-9 text-right pull-right text-success hidden-xs">Vous avez un personnage inscrit à cette évènement!</div>';
											} else {
												echo '<div class="col-sm-9 text-right pull-right text-success hidden-xs">Vous avez '.$gn['isRegistered'].' personnages inscrit à cette évènement!</div>';
											}
											?>
										</div>


										
										<?php if ($gn['isActive'] == 'Ouvert') { ?>
											<?php if ($gn['isRegistered'] > 0) { ?>
												<div class="ribbon ribbon-success"><span>INSCRIT</span></div>
											<?php } else { ?>
												<div class="ribbon ribbon-warning"><span><?php echo $gn['isActive']; ?></span></div>												
											<?php } ?>	
										<?php } else { ?>
											<div class="ribbon"><span><?php echo $gn['isActive']; ?></span></div>
										<?php } ?>
									</form>

								</div>
							</div>

						<?php }	?>



						<?php foreach ($news as $media) { ?>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="media-left">
											<?php if ($media['picture_url'] != '') { ?>
											<img class="media-object img-thumbnail" src="<?php echo $media['picture_url']; ?>" width="100" alt="<?php echo $media['title']; ?>">
											<?php } ?>
										</div>
										<div class="media-body">
											<h4 class="media-heading"><?php echo $media['title']; ?></h4>
											<?php echo nl2br($media['message']); ?>

											<?php if ($media['link'] != '') { ?>
												<div>
												<a class="text-warning" target="_blank" href="<?php echo $media['link']; ?>" role="button">Lire la suite...</a>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php }	?>

						<?php if (empty($news)) { ?>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="media-left">
										</div>
										<div class="media-body">
											<h4 class="media-heading">Saviez-vous que ?</h4>
											Avec leur diamètre de plus de 5000 km, Ganymède (satellite de Jupiter) et Titan (satellite de Saturne), dépassent tous les deux en taille la planète Mercure.
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="media-left">
										</div>
										<div class="media-body">
											<h4 class="media-heading">Saviez-vous que ?</h4>
											La sonde Voyager 1 est à ce jour l'objet de fabrication humaine le plus éloigné du Soleil, elle s'éloigne à la vitesse de 17,1 km/s. Elle est située actuellement à 15 milliards de km du Soleil et, malgré sa vitesse, n'atteindra Proxima Centauri (l'étoile la plus proche de nous) que dans 40 000 ans!
										</div>
									</div>
								</div>
							</div>
						<?php }	?>
					</div>

				</div>
				<div class="panel-footer text-right">

				</div>
		

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>

