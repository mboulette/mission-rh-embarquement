<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Participant <small><?php echo str_cut($character['name'], 60); ?></small></h1>
			</div>


			<div class="panel-body">

				<div class="form-horizontal">
				
					<a href="/inscriptions/admin/attendees" class="btn btn-warning backlink"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Retour à la liste</a>

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

							<h3>Évènement <button class="list-action btn btn-warning btn-xs" data-form="form-auto" data-id="<?php echo $event['id']; ?>" data-action="/inscriptions/admin/events/edit" data-toggle="tooltip" data-original-title="Modifier"><i class="fa fa-pencil"></i></button></h3>

							<p>
								<strong>Nom :</strong> <?php echo $event['name'];?><br />
								<strong>Date de l'évènement :</strong> <?php echo $event['date_event'];?><br />
								<strong>Nombre de places :</strong> <?php echo $event['max_places'];?><br />
							</p>

							<h3>Joueur <button class="list-action btn btn-warning btn-xs" data-form="form-auto" data-id="<?php echo $player['id']; ?>" data-action="/inscriptions/admin/players/display" data-toggle="tooltip" data-original-title="Détails"><i class="fa fa-search"></i></button></h3>
							<p>
								<strong>Nom :</strong> <?php echo $player['firstname'].'  '.$player['lastname'];?><br />
								<strong>Date de naissance :</strong> <?php echo substr($player['birthday'], 0, 10);?><br />
								<strong>Sexe :</strong> <?php echo $player['gender'];?><br />
								<strong>Courriel :</strong> <?php echo $player['email'];?><br />
							</p>

							<h3>Personnage  <button class="list-action btn btn-warning btn-xs" data-form="form-auto" data-id="<?php echo $character['id']; ?>" data-action="/inscriptions/admin/characters/display" data-toggle="tooltip" data-original-title="Détails"><i class="fa fa-search"></i></button></h3>
							
							<p>
								<strong>Nom :</strong> <?php echo $character['name'];?><br />
								<strong>Corporation :</strong> <?php echo $character['corporation']['name'];?><br />
								<strong>Race :</strong> <?php echo $character['race']['name'];?><br />
								<strong>Profession :</strong> <?php echo $character['profession']['name'];?><br />
								<strong>Level :</strong> <?php echo $character['level'];?><br />
							</p>

						</div>

						<div class="col-md-6" >

							<?php
							$options = array();
							$tmp ='';
							$id_transaction = array();
							$inscription_created = new DateTime($inscription['date_created']);
							$inscription_updated = new DateTime($inscription['date_updated']);
							$total = 0;

							foreach ($inscriptions as $lines) {

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
