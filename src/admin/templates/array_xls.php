<table border=1>
	<thead>
		<tr>
		<?php foreach ($columns as $column_name => $field_name) { ?>
			<th><?php echo $column_name; ?></th>
		<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($list as $current) { ?>
			<tr>
			<?php foreach ($columns as $column_name => $field_name) { ?>
				<td><?php echo str_cut($current[$field_name], 60); ?></td>
			<?php } ?>
			</tr>
		<?php } ?>
	</tbody>
</table>