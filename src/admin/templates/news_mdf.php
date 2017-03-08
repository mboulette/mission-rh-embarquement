<div class="main">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1><i class="fa fa-newspaper-o"></i> Nouvelles 
					<?php if (is_numeric($news['id'])) {?><small>Modifier <?php echo str_cut($news['title'], 60); ?></small><?php } ?>
					<?php if (!is_numeric($news['id'])) {?><small>Création d'une nouvelle publication</small><?php } ?>
				</h1>
			</div>

			<form id="form_news" action="/inscriptions/admin/news" method="post" class="form-horizontal">

				<div class="bg-icon hidden-xs fa fa-newspaper-o"></div>

				<div class="panel-body">

					<div class="form-group">
						<label class="col-sm-3 control-label">Image</label>
						<div class="col-sm-8"> 
						    
						    <button class="btn btn-default file-btn"> 
								<div>
									<img id="picture" src="<?php echo ($news['picture_url'] == "" ? "/inscriptions/img/blank_upload_pic.png" : $news['picture_url']); ?>" width="160" height="160" alt="Picture" class="img-thumbnail">
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
						<label for="title" class="col-sm-3 control-label">Titre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="title" name="title" placeholder="Titre" required maxlength="200" value="<?php echo $news['title']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="message" class="col-sm-3 control-label">Message</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="6" id="message" name="message" placeholder="Corps de la nouvelle" required maxlength="5000"><?php echo $news['message']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-sm-3 control-label">Lien</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="link" name="link" placeholder="http://www.exemple.com" maxlength="200" value="<?php echo $news['link']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="date_publication_group" class="col-sm-3 control-label required">Date de publication</label>
						<div class="col-sm-4">
							<div class="input-group ">
								<input type="text" id="date_publication_group" class="form-control" required readonly>
								<label for="date_publication_group" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></label>

								<input type="hidden" id="date_publication" name="date_publication" value="<?php echo $news['date_publication']; ?>">
								<input type="hidden" id="date_end" name="date_end" value="<?php echo $news['date_end']; ?>">

							</div>
						</div>
					</div>




				</div>
				<div class="panel-footer text-right">
					<input type="hidden" id="id_news" name="id_news" value="<?php echo $news['id']; ?>">
					<input type="hidden" id="submitaction" name="submitaction" value="save">
					<a href='/inscriptions/admin/news' class="btn btn-default btn-lg backlink">Annuler</a>
					<button id="save-news" type="submit" value="save" class="btn btn-warning btn-lg"><i class="fa fa-check"></i> &nbsp;Enregistrer</button>
				</div>
			
			</form>
		</div>

		<?php require_once('src/templates/footer.php'); ?>

	</div>
</div>
