<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-credit-card-alt"></i> Cartes de crédit <small>Liste de vos méthodes de paiements</small></h1>
			</div>


				<div class="bg-icon hidden-xs fa fa-credit-card-alt"></div>

				<div class="panel-body">


					<div class="alert alert-warning" role="alert">

						<p>Dans cette section vous pouvez ajouter les cartes de crédit qui seront utiles lors du paiement de votre inscription. Soyez sans crainte, aucune transaction ne sera effectuée sans votre consentement. Les transactions sont toutes cryptées et sécurisées.</p>
						<p>Aucune donnée n’est conservé ni ne transige par les serveurs de Mission Rh-PATAF, le tout est pris en charge par 
						<a class="text-warning" href="https://squareup.com/ca/fr" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="16" height="16" style="display:inline; margin-bottom:-2px;">
						  <path fill="#8a6d3b" d="M36.65 0h-29.296c-4.061 0-7.354 3.292-7.354 7.354v29.296c0 4.062 3.293 7.354 7.354 7.354h29.296c4.062 0 7.354-3.292 7.354-7.354v-29.296c.001-4.062-3.291-7.354-7.354-7.354zm-.646 33.685c0 1.282-1.039 2.32-2.32 2.32h-23.359c-1.282 0-2.321-1.038-2.321-2.32v-23.36c0-1.282 1.039-2.321 2.321-2.321h23.359c1.281 0 2.32 1.039 2.32 2.321v23.36z"></path>
						  <path fill="#8a6d3b" d="M17.333 28.003c-.736 0-1.332-.6-1.332-1.339v-9.324c0-.739.596-1.339 1.332-1.339h9.338c.738 0 1.332.6 1.332 1.339v9.324c0 .739-.594 1.339-1.332 1.339h-9.338z"></path>
						</svg>&nbsp;Square</a>, une entreprise sérieuse spécialisée dans le paiement mobile et le paiement électronique.</p>
					</div>

					<div class="row">


						<?php if (!is_null($cardsList)) { ?>
						<?php foreach ($cardsList as $card) { ?>

						<div class="col-md-6 card-conteiner">
							<div class="card card-credit">
								
								<div class="row">
									<div class="col-xs-2">
										<h2 style="margin-top: 8px;">
										<i class='fa fa-cc-<?php echo strtolower($card->getCardBrand()); ?>'></i>
										</h2>
									</div>
									<div class="col-xs-10">
										<?php
										$cardnumber = str_pad('&nbsp;', 10, "*", STR_PAD_LEFT);
										$cardnumber = $cardnumber.$cardnumber.$cardnumber.$card->getLast4();
										?>

										<h4><?php echo $card->getCardholderName(); ?></h4>
										<h3><?php echo $cardnumber; ?></h3>
										<p>Date d'expiration : <?php echo $card->getExpMonth(); ?>/<?php echo $card->getExpYear(); ?></p>
										<hr>
										<p>
											<button data-id="<?php echo $card->getId(); ?>" type="button" class="btn btn-warning delete_card"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
											&nbsp;
											<button type="button" class="btn btn-default updcard" data-toggle="modal" data-target="#info-update"><i class="fa fa-info-circle"></i> &nbsp;Modifier</button>
										</p>
									</div>
								</div>

							</div>
						</div>

						<?php } ?>
						<?php } ?>


						<div class="col-md-3">
							<form action="/inscriptions/cards/edit" method="post">
								<input type="hidden" name="id_card" value="0">

								<button type="submit" class="btn btn-warning btn-block">
									<i class="fa fa-plus-circle" style="font-size:300%;"></i>

									<div>Nouvelle carte de crédit</div>
								</button>
							</form>

						</div>

					</div>

				</div>
				<div class="panel-footer text-right">
					
				</div>
		

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>


<div id="info-update" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modification d'une carte</h4>
      </div>
      <div class="modal-body">
        
		<p>Malheureusement vous ne pouvez pas modifier une carte de crédit. Si vous avez fait un erreur ou si vous devez changer la date d'expiration, veuillez supprimer cette carte et en créer une nouvelle.</p>

      </div>
      <div class="modal-footer">
	    <button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
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
        
		<p>Êtes-vous certain de vouloir supprimer cette carte de crédit?</p>

      </div>
      <div class="modal-footer">
	    <button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
	    <button type="button" data-dismiss="modal" class="btn btn-warning" id="delete"><i class="fa fa-trash "></i> &nbsp;Supprimer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
