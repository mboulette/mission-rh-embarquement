<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="/inscriptions/img/apple-touch-icon.png">
    <link rel="icon" href="/inscriptions/img/favicon.ico">

    <title><?php echo $GLOBALS['app_name']; ?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <style media="print">
		.alert-info {
			background-color: #9acfea !important;
		}

		.panel-heading {
			background-color: #e8e8e8 !important;
		}
    </style>

  <body>
  <div class="container">
	<div class="alert alert-info" role="alert">
		<h3><?php echo $event['name'];?></h3>

		<p>
			<strong>Date de l'évènement :</strong> <?php echo $event['date_event'];?><br />
			<strong>Nombre de places :</strong> <?php echo $event['max_places'];?><br />
		</p>
	</div>


		<?php foreach ($inscriptions as $inscription) { ?>
			<div class="panel panel-default" style="page-break-inside: avoid;">
				<?php
				$player = $inscription['player'];
				$character = $inscription['character'];
				$details = $inscription['details'];
				?>

				<div class="panel-heading">
					<?php echo $inscription['player_name'];?>
					<small>- <?php echo $inscription['character_name'];?></small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-xs-4" >

							<?php
							$inscription_created = new DateTime($inscription['date_created']);
							$inscription_updated = new DateTime($inscription['date_updated']);
							?>
							<h3>Inscription</h3>
							<p>
								<strong>Transaction :</strong> <?php echo $inscription['code'];?><br />
								<strong>Date d'inscription :</strong> <?php echo $inscription_created->format('Y-m-d H:i');?><br />
								<strong>Date mis à jour :</strong> <?php echo $inscription_updated->format('Y-m-d H:i');?><br />
								<strong>Total :</strong> <?php echo number_format($inscription['total'], 2);?> $<br />
							</p>

							<h3>Joueur</h3>
							<p>
								<strong>Nom :</strong> <?php echo $player['firstname'].'  '.$player['lastname'];?><br />
								<strong>Date de naissance :</strong> <?php echo substr($player['birthday'], 0, 10);?><br />
								<strong>Sexe :</strong> <?php echo $player['gender'];?><br />
								<strong>Courriel :</strong> <?php echo $player['email'];?><br />
							</p>

						</div>
						<div class="col-xs-3" >

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
						<div class="col-xs-5" >
							
							<h3>Options</h3>
							<?php
							foreach (json_decode($inscription['details'][0]['options'], true) as $option) {
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

							foreach (json_decode($inscription['details'][0]['ressources'], true) as $ressource) {
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

							echo '<strong>'.$inscription['details'][0]['credits']. ' x </strong>Crédits restants<br />';
							?>


						</div>
					</div>

				</div>
			</div>
		<?php } ?>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>