

<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-calendar"></i> Évènements <small>Inscrivez un personnage à un évènement</small></h1>
			</div>


				<div class="bg-icon hidden-xs fa fa-calendar"></div>

				<div class="panel-body">


					<div class="row">
						<?php foreach ($eventsList as $gn) { ?>						
							
							<?php 
							if (  ($gn['animateur'] > $_SESSION['player']['admin'])  && ($gn['animateur'] != 4)  ) continue;
							if (  ($gn['animateur'] == 4)  && (!$oldPlayers)  ) continue;
							?>


							<?php $date_event = new DateTime($gn['date_event']); ?>

							<div class="col-md-6 card-conteiner">
								<div class="card card-event <?php if ($gn['isActive'] != 'Ouvert' || $gn['isRegistered'] != 0) echo 'disabled' ?>">
									
										<div class="row">
											<div class="col-xs-3 col-sm-3">
												
												<h1><?php echo $date_event->format('d'); ?></h1>
												<h2><?php echo  $GLOBALS['month_abbr'][$date_event->format('n')]; ?></h2>

												<div class="participants">

													<div class="marquee">
														<div class="marquee-content">

															<div>
																<?php echo $gn['nbInscription']. '/'.$gn['max_places']; ?><br />
																<span>Participants</span>
															</div>

															<?php
															foreach ($gn['nbInscriptionCorpo'] as $corpo) {
																echo '<div>';
																echo $corpo['nbInscriptions'].'<br />';
																echo '<span>'.$corpo['name'].'</span>';
																echo '</div>';
															}
															?>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-9 col-sm-9">

												<h3><?php echo $gn['name']; ?></h3>
												<hr>
												<p><?php echo $gn['synopsis']; ?></p>
												<p>
													<?php if ($gn['isActive'] == 'Ouvert' && $gn['isRegistered'] == 0) { ?>
														<form action="/inscriptions/events/register" method="post">
															<input type="hidden" name="id_event" value="<?php echo $gn['id']; ?>">
															<button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart"></i> &nbsp;Participer</button>
														</form>
													<?php }?>
													<?php if ($gn['isRegistered'] == 1) { ?>
														<form action="/inscriptions/events/sheet" method="post">
															<input type="hidden" name="id_event" value="<?php echo $gn['id']; ?>">
															<button type="submit" class="btn btn-primary"><i class="fa fa-id-card-o"></i> &nbsp;Feuille de personnage</button>
														</form>
													<?php }?>
													<?php if ($gn['link'] != '' && $gn['link'] != NULL) { ?>
														<a target="_blank" class="btn btn-default" href="<?php echo $gn['link']; ?>"><i class="fa fa-search "></i> &nbsp;Détails</a>
													<?php }?>
												</p>

											</div>
											
										</div>
										<div class="row">
											
											<?php
											if ($gn['isRegistered'] == 0) {
												echo '<div class="col-sm-9 text-right pull-right text-warning hidden-xs">Inscrivez-vous avant le : '.substr($gn['inscription_end'], 0, -3).'</div>';
											} else {
												echo '<div class="col-sm-9 text-right pull-right text-success hidden-xs">Vous êtes inscrit à cette évènement!</div>';
											}
											?>
										</div>
											

										<?php if ($gn['isRegistered'] > 0) { ?>
											<div class="ribbon ribbon-success"><span>INSCRIT</span></div>
										<?php } else { ?>									
											<?php if ($gn['isActive'] == 'Ouvert') { ?>
												<div class="ribbon ribbon-warning"><span><?php echo $gn['isActive']; ?></span></div>												
											<?php } else { ?>
												<div class="ribbon"><span><?php echo $gn['isActive']; ?></span></div>
											<?php } ?>
										<?php } ?>
								</div>
							</div>


						<?php } ?>


					</div>

				</div>
				<div class="panel-footer text-right">
					
				</div>
		

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>