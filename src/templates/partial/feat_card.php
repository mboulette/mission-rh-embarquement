
	<label style="width:100%">
		<div class="card card-feat <?php if ($feat['id'] == $checked) echo 'active'; ?>">
			<div class="row">
				<div class="col-xs-2">
					<input type="checkbox" data-group='feat' name="id_feat[]" class="checkbox_card hidden" value="<?php echo $feat['id']; ?>" <?php if ($feat['id'] == $checked) echo 'checked'; ?>>
					
					<i class="fa fa-square-o fa-3x"></i>
					<i class="fa fa-square fa-3x"></i>
					<i class="fa fa-check-square fa-3x"></i>
				</div>
				<div class="col-xs-10">
					<h3><?php echo $feat['name']; ?></h3>
					<hr />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					&nbsp;
				</div>
				<div class="col-xs-10">
					<p><strong>Description :</strong> <?php echo str_cut($feat['description'], 500); ?></p>
					<p><strong>Prérequis :</strong> <?php echo str_cut($feat['prerequisites'], 500); ?></p>
					<?php if ($feat['link'] != '' && $feat['link'] != NULL) { ?>
						<a target="_blank" class="btn btn-default" href="<?php echo $feat['link']; ?>"><i class="fa fa-search "></i> &nbsp;Plus d'informations</a>
					<?php }?>
				</div>

			</div>
		</div>

	</label>
