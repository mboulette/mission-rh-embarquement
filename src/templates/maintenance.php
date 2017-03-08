
<div class="container">
	<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<div class="signin-logo">
			<img class="center-block" width="250" alt="Rh-PATAF" src="/inscriptions/img/home-header-logo.png">
			</div>
		</div>

		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">
				<div class="panel-heading text-center"><h4>Le système est présentement verrouillé</h4></div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-3 col-sm-2 text-danger text-center">
							<i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i>
						</div>
						<div class="col-xs-9 col-sm-10">
							<?php
							echo nl2br($maintenance['description']);
							?>
						</div>
					</div>
				</div>
			</div>
			<?php require_once('src/templates/footer.php'); ?>
		</div>

	</div>

</div>



