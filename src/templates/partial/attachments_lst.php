<?php if (!empty($files)) { ?>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="90">Outils</th>
				<th>Fichier</th>
				<th>Type</th>
				<th>Taille</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($files as $file) { ?>
			<tr class='action'>
				<td>
					<button class="list-action btn btn-warning btn-xs" data-form="form-auto" data-id="0" data-action="<?php echo $file['path']; ?>" data-toggle="tooltip" title="Télécharger"><i class='fa fa-download'></i></button>
					<button class="delete btn btn-danger btn-xs" data-form="form-auto" data-id="<?php echo $file['path']; ?>" data-url="/inscriptions/atachements/delete/" data-toggle="tooltip" title="Supprimer"><i class='fa fa-trash'></i></button>
				</td>
				<td><i class="fa fa-paperclip" aria-hidden="true"></i> &nbsp;<?php echo str_cut($file['name'], 60); ?></td>
				<td><?php echo str_cut($file['type'], 60); ?></td>
				<td><?php echo str_cut($file['size'], 60); ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>