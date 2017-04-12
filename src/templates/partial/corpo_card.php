
	<label style="width:100%">
		<div class="card card-corpo <?php if ($corpo['id'] == $checked) echo 'active'; ?>">
			<div class="row">
				<div class="col-xs-2">
					<input type="radio" data-group='corpo' name="id_corporation" class="radio_card hidden" value="<?php echo $corpo['id']; ?>" <?php if ($corpo['id'] == $checked) echo 'checked'; ?>>
					
					<i class="fa fa-square-o fa-3x"></i>
					<i class="fa fa-square fa-3x"></i>
					<i class="fa fa-check-square fa-3x"></i>
				</div>
				<div class="col-xs-10">
					<h3><?php echo $corpo['name']; ?></h3>
					<hr />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					<img src="<?php echo $corpo['picture_url']; ?>" alt="<?php echo $corpo['name']; ?>" width="100%" class="img-thumbnail">
				</div>
				<div class="col-xs-10">
					<p><strong>Description :</strong> <?php echo str_cut($corpo['description'], 500); ?></p>
					<p><strong>Modificateur de santé :</strong> <?php echo str_cut($corpo['malus'], 1000); ?></p>
					<p><strong>Ressource primaire :</strong> Les membres de cette corporation reçoivent automatiquement 2 ressources «<a class="text-warning" data-container="body" data-toggle="tooltip" data-placement="top" title="<?php echo $corpo['ressource']['description']; ?>"><?php echo $corpo['ressource']['name']; ?></a>» gratuitement lors de chaque inscription.</p>
					<?php if ($corpo['link'] != '' && $corpo['link'] != NULL) { ?>
						<a target="_blank" class="btn btn-default" href="<?php echo $corpo['link']; ?>"><i class="fa fa-search "></i> &nbsp;Plus d'informations</a>
					<?php }?>
				</div>

			</div>
		</div>

	</label>
