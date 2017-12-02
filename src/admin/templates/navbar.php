	<?php
	$active_menu_clients = ($active_menu=='admin-players' || $active_menu=='admin-characters') ? 'active' : '';
	$active_menu_inscriptions = ($active_menu=='admin-events' || $active_menu=='admin-options' || $active_menu=='admin-attendees') ? 'active' : '';
	$active_menu_maintenance = ($active_menu=='admin-news' || $active_menu=='admin-maintenance') ? 'active' : '';

	$active_menu_rules = ($active_menu=='admin-races' || $active_menu=='admin-corporations' || $active_menu=='admin-professions' || $active_menu=='admin-ressources' || $active_menu=='admin-recipes' || $active_menu=='admin-feats' || $active_menu=='admin-skills') ? 'active' : '';

	?>

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-admin" aria-expanded="false" aria-controls="navbar-admin" style="padding:5px 14px;">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-lock" style="font-size: 1.5em;"></span>
				</button>
				<a class="navbar-brand" href="#"><i class="fa fa-lock"></i> &nbsp;
					<?php
					if ($_SESSION['player']['admin'] == 1) echo 'ANIMATEUR';
					if ($_SESSION['player']['admin'] == 2) echo 'SCÉNARISTE';
					if ($_SESSION['player']['admin'] == 3) echo 'ADMIN';
					if ($_SESSION['player']['admin'] == 4) echo 'SUPER ADMIN';
					?>
				</a>
			</div>
			<div id="navbar-admin" class="navbar-collapse navbar-right collapse">
				<?php if ($_SESSION['player']['admin'] > 1) { ?>
				<ul class="nav navbar-nav">

					<li class="dropdown <?php echo $active_menu_clients;?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clients <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="<?php echo ($active_menu=='admin-players' ? 'active' : '');?>"><a href="/inscriptions/admin/players">Joueurs</a></li>
							<li class="<?php echo ($active_menu=='admin-characters' ? 'active' : '');?>"><a href="/inscriptions/admin/characters">Personnages</a></li>
						</ul>
					</li>

					<li class="dropdown <?php echo $active_menu_inscriptions;?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inscriptions <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="<?php echo ($active_menu=='admin-events' ? 'active' : '');?>"><a href="/inscriptions/admin/events">Évènements</a></li>
							<li class="<?php echo ($active_menu=='admin-options' ? 'active' : '');?>"><a href="/inscriptions/admin/options">Options</a></li>
							<li class="<?php echo ($active_menu=='admin-attendees' ? 'active' : '');?>"><a href="/inscriptions/admin/attendees">Participants</a></li>
						</ul>
					</li>

					<?php if ($_SESSION['player']['admin'] > 2) { ?>
					<li class="dropdown <?php echo $active_menu_rules;?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Règles <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="<?php echo ($active_menu=='admin-races' ? 'active' : '');?>"><a href="/inscriptions/admin/races">Races</a></li>
							<li class="<?php echo ($active_menu=='admin-professions' ? 'active' : '');?>"><a href="/inscriptions/admin/professions">Professions</a></li>
							<li class="<?php echo ($active_menu=='admin-corporations' ? 'active' : '');?>"><a href="/inscriptions/admin/corporations">Corporations</a></li>
							<li class="nav-divider"></li>
							<li class="<?php echo ($active_menu=='admin-ressources' ? 'active' : '');?>"><a href="/inscriptions/admin/ressources">Ressources</a></li>
							<li class="<?php echo ($active_menu=='admin-recipes' ? 'active' : '');?>"><a href="/inscriptions/admin/recipes">Recettes</a></li>
							<li class="<?php echo ($active_menu=='admin-feats' ? 'active' : '');?>"><a href="/inscriptions/admin/feats">Talents</a></li>
							<li class="<?php echo ($active_menu=='admin-skills' ? 'active' : '');?>"><a href="/inscriptions/admin/skills">Habiletés</a></li>

						</ul>
					</li>
					<?php } ?>


					<li class="dropdown <?php echo $active_menu_maintenance;?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Maintenance <span class="caret"></span></a>
						<ul class="dropdown-menu">
					
							<li class="<?php echo ($active_menu=='admin-news' ? 'active' : '');?>"><a href="/inscriptions/admin/news">Nouvelles</a></li>
							<?php if ($_SESSION['player']['admin'] > 2) { ?>
								<li class="<?php echo ($active_menu=='admin-planets' ? 'active' : '');?>"><a href="/inscriptions/admin/planets">Planètes</a></li>
								<li class="<?php echo ($active_menu=='admin-maintenance' ? 'active' : '');?>"><a href="/inscriptions/admin/maintenance">Arrêter le système</a></li>
							<?php } ?>
						</ul>
					</li>
				</ul>
				<?php } ?>
			</div>
		</div>
	</nav>