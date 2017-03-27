<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-shopping-cart"></i> Inscription - <?php echo $current['name']; ?></h1>
			</div>


			<form id="form_register" method="post" class="form-horizontal">

				<div class="bg-icon hidden-xs fa fa-shopping-cart"></div>

				<div class="panel-body">



					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-warning">

						<div class="panel-heading" role="tab" id="headingOne">
							<h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<i class="fa fa-users"></i>&nbsp;
								Choisir votre personnage
								<span class="caret"></span>
							</h3>
						</div>

						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						  <div class="panel-body">
							<div class="row">
								<?php foreach ($characters_lst as $char) { ?>

								<div class="col-md-6 card-conteiner">
									<label style="width:100%">
										<div class="card card-character <?php if ($char['dead']) echo 'disabled'; ?>">
											<div class="row">
												<div class="col-xs-2">											
													<input type="radio" data-group='character' name="id_character" class="radio_card hidden" value="<?php echo $char['id']; ?>">
													
													<?php if ($char['dead']) { ?>
														<img src="/inscriptions/img/ico-dead.svg.php?fill=d9534f" style="margin-bottom:4px; width:24px;">
													<?php } else { ?>
														<i class="fa fa-square-o fa-3x"></i>
														<i class="fa fa-check-square fa-3x"></i>
													<?php } ?>
												</div>
												<div class="col-xs-10">

													<h3><?php echo $char['name']; ?></h3>
													<hr>
													<p><?php echo str_cut($char['notes'], 250); ?></p>

													<div>
														<img src="<?php echo $char['profession']['picture_url']; ?>" alt="<?php echo $char['profession']['name']; ?>" title="<?php echo $char['profession']['name']; ?>" width="15%" class="img-thumbnail">
														<img src="<?php echo $char['race']['picture_url']; ?>" alt="<?php echo $char['race']['name']; ?>" title="<?php echo $char['race']['name']; ?>"  width="15%" class="img-thumbnail">
														<img src="<?php echo $char['corporation']['picture_url']; ?>" alt="<?php echo $char['corporation']['name']; ?>" title="<?php echo $char['corporation']['name']; ?>"  width="15%" class="img-thumbnail">
													</div>

												</div>
												
											</div>
											<div class="ribbon"><span>Grade <?php echo $char['rank']; ?></span></div>
										</div>

									</label>
								</div>

								<?php } ?>
							</div>
						  </div>
						</div>
					  </div>
					  <div class="panel panel-warning">
						<div class="panel-heading" role="tab" id="headingThree">
						  <h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							  <i class="fa fa-shopping-cart"></i>&nbsp;
							  Choisir vos options
							  <span class="caret"></span>
						  </h3>
						</div>
						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						  <div class="panel-body">

							<?php
							foreach ($options_lst as $option) {
								
								if ($option['locked']) continue;

								$precision_html = '';

								if ($option['options'] != '') {
									$precision_html .= '<div class="form-inline">';

									$precision_array = json_decode($option['options'], true);
									
									foreach ($precision_array as $precision => $precision_value) {
										$precision_html .= '<select class="selectpicker" data-width="fit" title="'.$precision.'" name="options['.$precision.']['.$option['id'].']">';

										foreach ($precision_value as $value) {
											$precision_html .= '<option>'.$value.'</option>';
										}

										$precision_html .= '</select> &nbsp;';
									}


									$precision_html .= '</div>';
								}

								if ($current['isRegistered'] > 0) $option['mandatory'] = 0;

								$more_link = '';
								if ($option['link'] != '') $more_link = '<a class="text-warning" href="'.$option['link'].'" target="_blank">En savoir plus...</a>';

								echo '
									<row>
										<div class="col-sm-7">
											<strong>'.$option['name'].' - $'.number_format($option['price'], 2).'</strong>
											<div class="hidden-xs"><small>'.$option['description'].' &nbsp;'.$more_link.'</small></div>
											<div>'.$precision_html.'</div>
										</div>
										<div class="col-sm-3">
											<div class="input-group" style="width:160px; margin-top: 5px;">
												<span class="input-group-btn">
													<button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="qty['.$option['id'].']" disabled>
														<span class="glyphicon glyphicon-minus"></span>
													</button>
												</span>
												<input type="text" name="qty['.$option['id'].']" class="form-control input-number text-right" 
													data-price="'.$option['price'].'" data-id="'.$option['id'].'" 
													value="'.$option['mandatory'].'" 
													min="'.($option['mandatory'] == 1 ? 1 : 0).'" max="'.($option['mandatory'] == 1 ? 1 : 10).'"
													'.($option['mandatory'] == 1 ? 'readonly' : '').'
												>
												<span class="input-group-btn">
													<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="qty['.$option['id'].']" '.($option['mandatory'] == 1 ? 'disabled' : '').'>
														<span class="glyphicon glyphicon-plus"></span>
													</button>
												</span>
											</div>
										</div>
										<div class="col-xs-6 visible-xs-block">'.$more_link.'</div>
										<div class="col-xs-6 col-sm-2 text-right">
											Sous-total :
											$<span id="total-'.$option['id'].'">'.number_format($option['price'] * $option['mandatory'], 2).'</span>
										</div>
									</row>
									<row>
										<div class="col-sm-12"><hr></div>
									</row>
								';
							}

							/*

							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Nom <span class="hidden-xs">et description</span></th>
										<th class="text-center hidden-xs" width="100">Prix</th>
										<th class="text-center" width="150">Quantité</th>
										<th class="text-center" width="100">Sous-total</th>
									</tr>
								</thead>

								<tbody>
										//var_dump($option['options']);
										$precision_html = '';

										if ($option['options'] != '') {
											$precision_html .= '<div class="form-inline">';

											$precision_array = json_decode($option['options'], true);
											
											foreach ($precision_array as $precision => $precision_value) {
												$precision_html .= '<select class="selectpicker" data-width="fit" title="'.$precision.'" name="'.$precision.'['.$option['id'].']">';

												foreach ($precision_value as $value) {
													$precision_html .= '<option>'.$value.'</option>';
												}

												$precision_html .= '</select> &nbsp;';
											}


											$precision_html .= '</div>';
										}


										echo '
										<tr>
											<td class="option-description">
												'.$option['name'].'
												<div class="hidden-xs"><small>'.$option['description'].'</small></div>
												'.$precision_html.'
											</td>
											<td class="text-right hidden-xs">'.number_format($option['price'], 2).'</td>
											<td>
												<div class="input-group">
													<span class="input-group-btn">
														<button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="qty['.$option['id'].']" disabled>
															<span class="glyphicon glyphicon-minus"></span>
														</button>
													</span>
													<input type="text" name="qty['.$option['id'].']" class="form-control input-number text-right" 
														data-price="'.$option['price'].'" data-id="'.$option['id'].'" 
														value="'.$option['mandatory'].'" 
														min="'.($option['mandatory'] == 1 ? 1 : 0).'" max="'.($option['mandatory'] == 1 ? 1 : 10).'"
														'.($option['mandatory'] == 1 ? 'readonly' : '').'
													>
													<span class="input-group-btn">
														<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="qty['.$option['id'].']" '.($option['mandatory'] == 1 ? 'disabled' : '').'>
															<span class="glyphicon glyphicon-plus"></span>
														</button>
													</span>
												</div>
											</td>

											<th class="text-right">$ <span id="total-'.$option['id'].'">'.number_format($option['price'] * $option['mandatory'], 2).'</span></th>
										</tr>
										';
									
									}
									
								</tbody>
							</table>
							*/
							?>

							<div class="row">
								<div class="col-sm-3 col-sm-offset-9">

									<div class="panel panel-default text-right">
									  <div class="panel-body cart-total">
										<strong>TOTAL : $ <span id="total">0.00</span></strong>
									  </div>
									</div>

								</div>
							</div>
						  </div>
						</div>
					  </div>
					  <div class="panel panel-warning">
						<div class="panel-heading" role="tab" id="headingTwo">
						  <h3 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							  <i class="fa fa-credit-card-alt"></i>&nbsp;
							  Choisir votre carte de crédit
							  <span class="caret"></span>
						  </h3>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						  <div class="panel-body">
							<div class="row">
								<?php if (!is_null($cards_lst)) { ?>
								<?php foreach ($cards_lst as $card) { ?>

									<div class="col-sm-6 card-conteiner">
										<label style="width:100%">
											<div class="card card-credit">
												
												<div class="row">
													<div class="col-xs-2">
														<input type="radio" name="id_card" data-group='credit' class="radio_card hidden" value="<?php echo $card->getId(); ?>">
														
														<i class="fa fa-square-o fa-3x"></i>
														<i class="fa fa-check-square fa-3x"></i>
													</div>
													<div class="col-xs-10">
														<?php
														$cardnumber = str_pad('&nbsp;', 10, "*", STR_PAD_LEFT);
														$cardnumber = $cardnumber.$cardnumber.$cardnumber.$card->getLast4();
														?>

														<i class='fa fa-3x fa-cc-<?php echo strtolower($card->getCardBrand()); ?>'></i>
														<h4><?php echo $card->getCardholderName(); ?></h4>
														<h3><?php echo $cardnumber; ?></h3>
														<p>Date d'expiration : <?php echo $card->getExpMonth(); ?>/<?php echo $card->getExpYear(); ?></p>
													</div>


												</div>

											</div>
										</label>
									</div>


								<?php } ?>
								<?php } ?>
							</div>
						  </div>
						</div>
					  </div>

					</div>


				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_event" name="id_event" value="<?php echo $current['id']; ?>">
					<input type="hidden" name="save" value="save">

					<a href='/inscriptions/events' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="register-event" type="submit" value="pay" class="btn btn-warning btn-lg"><i class="fa fa-usd"></i> &nbsp;Payer</button>
				</div>
			</form>		
			

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>


<div id="register-valid" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Compléter un inscription</h4>
	  </div>
	  <div class="modal-body">
		
		<p>Pour compléter un inscription, vous devez absoluement choisir un personnage et une carte de crédit. Assurez-vous aussi de vérifier vos options avant de continuer.</p>

	  </div>
	  <div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default btn-lg">&nbsp; Ok &nbsp;</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="confirm" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Confirmation de votre inscription</h4>
	  </div>
	  <div class="modal-body">
		
		<p>Êtes-vous certain de vouloir compléter cet inscription, un montant de $<span id="total-modal">0.00</span> sera chargé sur votre carte de crédit.</p>

	  </div>
	  <div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default btn-lg">Annuler</button>
		<button type="button" class="btn btn-warning btn-lg" id="payment"><i class="fa fa-usd"></i> &nbsp;Payer</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->