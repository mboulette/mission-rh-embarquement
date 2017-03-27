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
						<div class="col-xs-5" >

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
							</p>
						</div>
						<div class="col-xs-7" >

							<?php
							$options = array();
							$tmp ='';
							$id_transaction = array();
							$inscription_created = new DateTime($details[0]['date_created']);
							$inscription_updated = new DateTime($details[0]['date_updated']);
							$total = 0;

							foreach ($details as $lines) {

								$tmp = json_decode($lines['options'], true);
								$id_transaction[] = $lines['id_transaction'];

								$date_created = new DateTime($lines['date_created']);
								$date_updated = new DateTime($lines['date_updated']);

								if ($date_created->getTimestamp() < $inscription_created->getTimestamp()) $inscription_created = $date_created;
								if ($date_updated->getTimestamp() > $inscription_updated->getTimestamp()) $inscription_updated = $date_updated;

								$total += $lines['amount'];

								foreach ($tmp as $option) {
									
									$token = '';
									$description = array();
									foreach ($option as $key => $value) {
										if ($key != 'qty' && $key != 'total' && $key != 'price') {
											$token .=$key.$value;

											if ($key != 'name') {
												$description[] = $key . ' : ' . $value;
											} 
										}
									}

									if (!isset($options[md5($token)])) {
										$options[md5($token)] = array(
											'name' => $option['name'],
											'qty' => $option['qty'],
											'description' => implode(', ', $description)
										);
									} else {
										$options[md5($token)]['qty'] += $option['qty'];
									}

								}
							}
							?>
							<h3>Inscription</h3>
							<p>
								<strong>Transaction :</strong> <?php echo implode(', ', $id_transaction);?><br />
								<strong>Date d'inscription :</strong> <?php echo $inscription_created->format('Y-m-d H:i');?><br />
								<strong>Date mis à jour :</strong> <?php echo $inscription_updated->format('Y-m-d H:i');?><br />
								<strong>Total :</strong> <?php echo number_format($total, 2);?> $<br />
							</p>

							<h4>Compilations des options</h4>

							<?php
							foreach ($options as $option) {
								echo '<strong>'.$option['qty']. ' x '.$option['name'].' </strong>';
								if ($option['description'] != '')echo ' ('.$option['description'].') ';
								echo '<br />';
							}

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