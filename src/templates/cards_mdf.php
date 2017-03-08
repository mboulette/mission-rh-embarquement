<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-credit-card-alt"></i> Cartes de crédit <small>Ajouter une nouvelle carte</small></h1>
			</div>

			<form id="form_card" class="form-horizontal" novalidate action="/inscriptions/cards/edit" method="post">
				<input id="applicationId" type="hidden" value="<?php echo square_applicationId; ?>">
				<input type="hidden" id="card-nonce" name="nonce">
				<input type="hidden" id="postal-code" name="postal-code">

				<div class="bg-icon fa fa-redit-card-alt"></div>

				<div class="panel-body">


					<div class="form-group">
						<label for="cardholder_name" class="col-sm-3 control-label">Nom sur la carte</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="cardholder_name" name="cardholder_name" placeholder="Nom sur la carte" required maxlength="60">
						</div>
					</div>

					<div class="form-group">
						<label for="sq-card-number" class="col-sm-3 control-label required">Numéro de carte</label>
						<div class="col-sm-8">
							<div id="sq-card-number"></div>
						</div>
					</div>

					<div class="form-group">
						<label for="sq-cvv" class="col-sm-3 control-label required">CVV
							<i role="button" class="fa fa-info-circle" data-toggle="modal" data-target="#modal-cvv-info"></i>
						</label>
						<div class="col-sm-8">
							<div id="sq-cvv"></div>
						</div>
					</div>

					<div class="form-group">
						<label for="sq-expiration-date" class="col-sm-3 control-label required">Date d'expiration</label>
						<div class="col-sm-8">
							<div id="sq-expiration-date"></div>
						</div>
					</div>

					<div class="form-group">
						<label for="sq-postal-code" class="col-sm-3 control-label required">Code Postal</label>
						<div class="col-sm-8">
							<div id="sq-postal-code"></div>
						</div>
					</div>

					<div class="card-error alert alert-danger hidden">
						<a href="#" class="close alert-hide" aria-label="Fermer">&times;</a>
					</div>

				</div>
				<div class="panel-footer text-right">
					<a href='/inscriptions/cards' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-card" type="button" value="save" class="btn btn-primary btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			</form>	

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>


<div id="modal-cvv-info" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Qu’est-ce que le CVV?</h4>
      </div>
      <div class="modal-body">
        
		<p>Le CVV (ou valeur de vérification de la carte) est un élément de sécurité antifraude qui permet de vérifier si la carte de crédit est en votre possession. Pour les cartes Visa/Mastercard, le numéro CVV de trois chiffres est imprimé sur la plage de signature, au dos de la carte, à la suite du numéro de compte.</p>
		<p><img src="/inscriptions/img/cvv.png"></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

