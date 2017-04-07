
	<?php
	if ($_SESSION['player']['admin'] != 0) {
		include('src/admin/templates/navbar.php');
	}
	?>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" target="_blank" href="http://www.mission-rh.org">
          	<img src="/inscriptions/img/logo-rh-pataf-small.png">
          </a>
        </div>


        <div id="navbar" class="navbar-collapse collapse">

			<ul class="nav navbar-nav ">

				<li class="<?php echo ($active_menu=='home' ? 'active' : '');?>"><a href="/inscriptions/home"><i class="fa fa-home"></i> &nbsp;Accueil</a></li>
				<li class="<?php echo ($active_menu=='characters' ? 'active' : '');?>"><a href="/inscriptions/characters"><i class="fa fa-users"></i> &nbsp;Personnages</a></li>
				<li class="<?php echo ($active_menu=='cards' ? 'active' : '');?>"><a href="/inscriptions/cards"><i class="fa fa-credit-card-alt"></i> &nbsp;Cartes <span class="visible-lg-inline visible-xs-inline">de crédit</span></a></li>
				<li class="<?php echo ($active_menu=='events' ? 'active' : '');?>"><a href="/inscriptions/events"><i class="fa fa-calendar"></i> &nbsp;Évènements</a></li>


				<li class="nav-divider visible-xs"></li>
				<li class="visible-xs" <?php echo ($active_menu=='profile' ? 'active' : '');?>>
					<a href="/inscriptions/profile">
						<img class="img-circle" src='<?php echo $_SESSION['player']['picture_url'] ;?>' width="18" />
						<?php echo $_SESSION['player']['firstname'] ;?> <?php echo $_SESSION['player']['lastname'] ;?> <small>- <?php echo $_SESSION['player']['email'] ;?></small>
					</a>
				</li>
				<li class="visible-xs <?php echo ($active_menu=='update-email' ? 'active' : '');?>"><a href="/inscriptions/update-email">Changer mon Courriel</a></li>
				<li class="visible-xs <?php echo ($active_menu=='update-password' ? 'active' : '');?>"><a href="/inscriptions/update-password">Changer mon Mot de passe</a></li>
				<li class="nav-divider visible-xs"></li>
				<li class="visible-xs"><a href="/inscriptions/signout"><i class="fa fa-power-off"></i> &nbsp;Déconnexion</a></li>

				<?php if (isset($_SESSION['player-admin'])) { ?>
					<li class="visible-xs"><a href="/inscriptions/admin/players/back"><i class="fa fa-user-secret"></i> &nbsp;Session Admin</a></li>
				<?php } ?>

			</ul>


			<ul class="nav navbar-nav navbar-right hidden-xs">

				<li class="dropdown">

					<ul class="nav navbar-nav usercard dropdown-toggle" data-toggle="dropdown" role="button">
						<li>
							<img class="img-circle" src='<?php echo $_SESSION['player']['picture_url'] ;?>' width="40" />
							
						</li>
						<li class="hidden-sm">
							<strong><?php echo $_SESSION['player']['firstname'] ;?> <?php echo $_SESSION['player']['lastname'] ;?></strong><br />
							<?php echo $_SESSION['player']['email'] ;?>
							<span class="caret"></span>
					 	</li>

					</ul>

					<ul class="dropdown-menu">
						<li class="<?php echo ($active_menu=='profile' ? 'active' : '');?>"><a href="/inscriptions/profile"><i class="fa fa-user-circle"></i> &nbsp;Profil</a></li>
						<li class="nav-divider"></li>
						<li class="<?php echo ($active_menu=='update-email' ? 'active' : '');?>"><a href="/inscriptions/update-email">Changer mon Courriel</a></li>
						<li class="<?php echo ($active_menu=='update-password' ? 'active' : '');?>"><a href="/inscriptions/update-password">Changer mon Mot de passe</a></li>
						<li class="nav-divider"></li>
						<li><a href="/inscriptions/signout"><i class="fa fa-power-off"></i> &nbsp;Déconnexion</a></li>

						<?php if (isset($_SESSION['player-admin'])) { ?>
							<li><a href="/inscriptions/admin/players/back"><i class="fa fa-user-secret"></i> &nbsp;Session Admin</a></li>
						<?php } ?>



					</ul>
				</li>

			</ul>



        </div>
      </div>
    </nav>


