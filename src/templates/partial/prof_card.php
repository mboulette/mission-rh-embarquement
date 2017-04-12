
	<label style="width:100%">
		<div class="card card-profession <?php if ($profession['id'] == $checked) echo 'active'; ?>">
			<div class="row">
				<div class="col-xs-2">
					<input type="radio" data-group='profession' name="id_profession" class="radio_card hidden" value="<?php echo $profession['id']; ?>" <?php if ($profession['id'] == $checked) echo 'checked'; ?>>
					
					<i class="fa fa-square-o fa-3x"></i>
					<i class="fa fa-square fa-3x"></i>
					<i class="fa fa-check-square fa-3x"></i>
				</div>
				<div class="col-xs-10">
					<h3><?php echo $profession['name']; ?></h3>
					<hr />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					<img src="<?php echo $profession['picture_url']; ?>" alt="<?php echo $profession['name']; ?>" width="100%" class="img-thumbnail">
				</div>
				<div class="col-xs-10">
					<p><strong>Description :</strong> <?php echo str_cut($profession['description'], 1000); ?></p>
					<p><strong>Recettes :</strong> Les individus qui partagent cette profession peuvent utiliser 12 recettes propres à leur spécialité. <a class="text-warning" data-toggle="modal" href="#recettes-<?php echo $profession['id']; ?>">Cliquez ici</a> pour consulter ces recettes.</p>

					<?php if ($profession['link'] != '' && $profession['link'] != NULL) { ?>
						<a target="_blank" class="btn btn-default" href="<?php echo $profession['link']; ?>"><i class="fa fa-search "></i> &nbsp;Plus d'informations</a>
					<?php }?>
				</div>

			</div>
		</div>

	</label>



	<div class="modal fade" id="recettes-<?php echo $profession['id']; ?>" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Recettes - <?php echo $profession['name']; ?></h4>
	      </div>
	      <div class="modal-body">
	        <?php foreach ($profession['recipes'] as $recipe) { ?>

	        	<div>
	        		<h4><?php echo $recipe['name'];?></h4>
					<div class="panel panel-default">
						<div class="panel-heading" data-toggle="collapse" data-target="#more-recipe-<?php echo $recipe['id'];?>">
							<?php echo $recipe['description'];?>
							<span class="caret"></span>
						</div>
						<div class="panel-body collapse" id="more-recipe-<?php echo $recipe['id'];?>">
							<p><strong>Méthode d’utilisation</strong> : <?php echo $recipe['method'];?></p>
							<p><strong>Effet immédiat</strong> : <?php echo $recipe['effect'];?></p>
							<p><strong>Effet sur le bilan</strong> : <?php echo $recipe['bilan'];?></p>
							
							<p><strong>Ingrédients</strong> : 
								<?php
								foreach ($ressources as $ressource) {
									if (array_key_exists($ressource['id'], $recipe['recipies'])){
										if ($recipe['recipies'][$ressource['id']] != 0){
											if ($ressource['level'] == 1) echo '<span class="label label-success">';
											if ($ressource['level'] == 2) echo '<span class="label label-warning">';
											if ($ressource['level'] == 3) echo '<span class="label label-danger">';
											echo $ressource['name'].': '.$recipe['recipies'][$ressource['id']];
											echo '</span> &nbsp;';
										}
									} 
								}
								?>
							</p>				
						</div>
					</div>

	        	</div>

	        <?php }?>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	      </div>
	    </div>
	  </div>
	</div>