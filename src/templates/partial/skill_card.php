
	<label style="width:100%">
		<div class="card card-skill <?php if ($skill['id'] == $checked) echo 'active'; ?>">
			<div class="row">
				<div class="col-xs-2">
					<input type="radio" data-group='skill' name="id_skill" class="radio_card hidden" value="<?php echo $skill['id']; ?>" <?php if ($skill['id'] == $checked) echo 'checked'; ?>>
					
					<i class="fa fa-square-o fa-3x"></i>
					<i class="fa fa-square fa-3x"></i>
					<i class="fa fa-check-square fa-3x"></i>
				</div>
				<div class="col-xs-10">
					<h3><?php echo $skill['name']; ?></h3>
					<hr />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					&nbsp;
				</div>
				<div class="col-xs-10">
					<p><strong>Description :</strong> <?php echo str_cut($skill['description'], 500); ?></p>
					<?php if ($skill['link'] != '' && $skill['link'] != NULL) { ?>
						<a target="_blank" class="btn btn-default" href="<?php echo $skill['link']; ?>"><i class="fa fa-search "></i> &nbsp;Plus d'informations</a>
					<?php }?>
				</div>

			</div>
		</div>

	</label>
