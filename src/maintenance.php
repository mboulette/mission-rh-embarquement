<?php

class maintenance extends dataObject 
{

	function __construct() {

		parent::__construct('maintenance');

	}

	public function edit() {
		
		if (isset($_POST['description'])) $this->save();

		$template = get_template('navbar', array('active_menu' => 'admin-maintenance'));
		$template .= get_template('maintenance', array('maintenance' => $this->getOne(1)), 'admin/');

		return render($template);
		
	}

	public function isLock() {

		$lock = 0;
		
		$maintenance = $this->getOne(1);

		if ($maintenance['lock_players'] == 1) $lock = 1;
		if ($maintenance['lock_admins'] == 1) $lock = 2;
		if ($maintenance['lock_players'] == 1 && $maintenance['lock_admins'] == 1) $lock = 3;

		if (isset($_SESSION['player'])) {
			if ($maintenance['super'] == $_SESSION['player']['id']) $lock = 0;
		}

		return $lock;

	}

	public function screenLock($full) {

		$maintenance = $this->getOne(1);

		if (!$full) {
			$template .= get_template('navbar', array('active_menu' => 'maintenance'));
		}
		$template .= get_template('maintenance', array('maintenance' => $maintenance));

		return render($template);
	}


	public function save() {

            $message = array(
                'id' => 1,
                'description' => $_POST['description'],
                'lock_players' => $_POST['lock_players'],
                'lock_admins' => $_POST['lock_admins'],
                'super' => $_SESSION['player']['id']
            );

            $this->update($message);

            if ($_POST['lock_admins']) {
				$_SESSION['message'] = array(
					'type' => 'danger',
					'body' => '<strong>Maintenance</strong> Le système est maintenant arrêté pour les administrateurs.'
				);
			}

            if ($_POST['lock_players']) {
				$_SESSION['message'] = array(
					'type' => 'success',
					'body' => '<strong>Maintenance</strong> Le système est maintenant arrêté pour tous les joueurs.'
				);
			}
	}


}
