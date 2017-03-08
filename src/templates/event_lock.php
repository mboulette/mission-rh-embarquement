<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-shopping-cart"></i> Inscription - <?php echo $current['name']; ?></h1>
			</div>


			<div class="bg-icon hidden-xs fa fa-shopping-cart"></div>

			<div class="panel-body">

				<?php echo $step; ?>

				<div class="alert alert-warning" role="alert">
					<p><strong>Désolé!</strong> Pour vous inscrire à un évènement, vous devez d'abord créer un personnage et entrée une carte de crédit dans le système.</p>
				</div>

			</div>
			<div class="panel-footer text-right">
				<a href='/inscriptions/events' class="btn btn-warning btn-lg">Annuler</a>
			</div>
			

		</div>
		
		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>