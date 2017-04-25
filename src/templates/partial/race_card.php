
	<label style="width:100%">
		<div class="card card-race <?php if ($race['id'] == $checked) echo 'active'; ?>">
			<div class="row">
				<div class="col-xs-2">
					<input type="radio" data-group='race' name="id_race" class="radio_card hidden" value="<?php echo $race['id']; ?>" <?php if ($race['id'] == $checked) echo 'checked'; ?>>
					
					<i class="fa fa-square-o fa-3x"></i>
					<i class="fa fa-square fa-3x"></i>
					<i class="fa fa-check-square fa-3x"></i>
				</div>
				<div class="col-xs-10">
					<h3><?php echo $race['name']; ?></h3>
					<hr />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					<img src="<?php echo $race['picture_url']; ?>" alt="<?php echo $race['name']; ?>" width="100%" class="img-thumbnail">
				</div>
				<div class="col-xs-10">
					<p><strong>Description :</strong> <?php echo str_cut($race['description'], 500); ?></p>
					<p><strong>Bonus :</strong> <?php echo str_cut($race['malus'], 1000); ?></p>

					<p><strong>Habiletés :</strong> L'héritié de cette lignée peut choisir l'une des habiletés suivantes :<br />
						<?php
						$skills = array();
						foreach($race['skills'] as $skill) {
							$skills[] = '<a class="text-warning" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$skill['description'].'">'.$skill['name'].'</a>';
						}
						echo implode(', ', $skills);
						?>
					</p>

					<?php if ($race['link'] != '' && $race['link'] != NULL) { ?>
						<a target="_blank" class="btn btn-default" href="<?php echo $race['link']; ?>"><i class="fa fa-search "></i> &nbsp;Plus d'informations</a>
					<?php }?>
				</div>

			</div>
		</div>

	</label>
