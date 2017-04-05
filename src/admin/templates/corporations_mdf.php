<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Corporations 
					<?php if (is_numeric($corporations['id'])) {?><small>Modifier <?php echo str_cut($corporations['name'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($corporations['id'])) {?><small>Création d'une nouvelle corporation</small><?php } ?>
				</h1>
			</div>

			<form id="form_corporations" action="/inscriptions/admin/corporations" method="post" class="form-horizontal">

				<div class="panel-body">

					<div class="form-group">
						<label class="col-sm-3 control-label">Image</label>
						<div class="col-sm-8"> 
						    
						    <button class="btn btn-default file-btn"> 
								<div>
									<img id="picture" src="<?php echo ($corporations['picture_url'] == "" ? "/inscriptions/img/blank_upload_pic.png" : $corporations['picture_url']); ?>" width="160" height="160" alt="Picture" class="img-thumbnail">
								</div>
						        <i class="fa fa-cloud-upload" aria-hidden="true"></i> &nbsp;Upload
						        <input type="file" id="upload" value="Select" /> 
						    </button> 
						    <div class="crop"> 
						        <div id="upload-demo"></div> 
						        <button class="btn btn-warning btn-sm upload-result"><i class="fa fa-check"></i> &nbsp;Accepter</button> 
						        <button class="btn btn-default btn-sm upload-cancel"><i class="fa fa-times"></i> &nbsp;Annuler</button> 
						    </div> 
						    <textarea id="base64_picture" name="picture_url" class="hidden"></textarea>

						</div>
					</div>

					<hr />

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Nom" required maxlength="40" value="<?php echo $corporations['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="description" name="description" placeholder="Description" required maxlength="500"><?php echo $corporations['description']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-sm-3 control-label">Lien</label>
						<div class="col-sm-8">
							<input type="url" class="form-control" id="link" name="link" placeholder="http://www.exemple.com" maxlength="200" value="<?php echo $corporations['link']; ?>">
							<p class="help-block">URL vers une page d'information supplémentaire</p>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<label for="malus" class="col-sm-3 control-label">Malus de départ</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="malus" name="malus" placeholder="Modificateur de santé" required maxlength="1000"><?php echo $corporations['malus']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="ressource_id" class="col-sm-3 control-label">Ressource type</label>
						<div class="col-sm-8">
							<select name="ressource_id" class="selectpicker">
								<optgroup label="Terrestre">
								<?php foreach ($ressources as $ressource) { ?>
									<?php if ($ressource['level'] == 1) { ?>
										<option value="<?php echo $ressource['id']; ?>"
										<?php if ($corporations['ressource_id'] == $ressource['id']) echo 'selected'; ?>><?php echo $ressource['name']; ?></option>
									<?php } ?>
								<?php } ?>
								</optgroup>
								<!--
								<optgroup label="Indigène">
								<?php foreach ($ressources as $ressource) { ?>
									<?php if ($ressource['level'] == 2) { ?>
										<option value="<?php echo $ressource['id']; ?>"
										<?php if ($corporations['ressource_id'] == $ressource['id']) echo 'selected'; ?>><?php echo $ressource['name']; ?></option>
									<?php } ?>
								<?php } ?>
								</optgroup>
								<optgroup label="Hybride">
								<?php foreach ($ressources as $ressource) { ?>
									<?php if ($ressource['level'] == 3) { ?>
										<option value="<?php echo $ressource['id']; ?>"
										<?php if ($corporations['ressource_id'] == $ressource['id']) echo 'selected'; ?>><?php echo $ressource['name']; ?></option>
									<?php } ?>
								<?php } ?>
								</optgroup>
								-->
							</select>
							<p class="help-block">Le joueur de cette corporation recevra automatiquement 2 ressources de ce type à chaque inscription.</p>
						</div>
					</div>


				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_corporations" name="id_corporations" value="<?php echo $corporations['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/corporations' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-corporations" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
