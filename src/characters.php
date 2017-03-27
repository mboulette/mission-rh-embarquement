<?php
class characters extends dataObject 
{

	var $corporation;
	var $race;
	var $profession;


	function __construct() {

		$this->corporation = new corporations();
		$this->race = new races();
		$this->profession = new professions();

		parent::__construct('characters');

	}


	public function edit() {


		if (isset($_POST['background'])) $this->save();

		if (!isset($_POST['id_character'])) {
			return $this->getList();
		}

		$races_factory = new races();
		$professions_factory = new professions();
		$corporations_factory = new corporations();

		$race_lst = $races_factory->getAll();
		$professions_lst = $professions_factory->getAll();
		$corporations_lst = $corporations_factory->getAll();

		$character = $this->getOne($_POST['id_character']);
		if (!$character) {
			$character = $this->getMock();
			$character['id'] = uniqid();
			$character['id_player'] = $_SESSION['player']['id'];
		}
	
		$dir = $GLOBALS['attachments_path_characters'].$character['id'];
        $files = array();
        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {

                        $files[] = array(
                            'name' => $file,
                            'path' => '/inscriptions/'.$dir.'/'.$file,
                            'size' => human_filesize(filesize(realpath(__DIR__.'/../'.$dir.'/'.$file))),
                            'type' => mime_content_type(realpath(__DIR__.'/../'.$dir.'/'.$file)),
                        );
                    }
                }
                closedir($dh);
            }
        }

        $attachments_lst = get_template('partial/attachments_lst', array('files' => $files));


		$template = get_template('navbar', array('active_menu' => 'characters'));
		$template .= get_template('character_mdf', array(
			'current' => $character,
			'attachments_lst' => $attachments_lst,
			'races_lst' => $race_lst,
			'professions_lst' => $professions_lst,
			'corporations_lst' => $corporations_lst,
		));

		return render($template);


	}

	public function save() {

        $character = array(
            'id' => $_POST['id_character'],
            'id_player' => $_SESSION['player']['id'],
            'background' => $_POST['background'],
            'notes' => $_POST['notes'],
        );

        if (isset($_POST['name'])) $character['name'] = $_POST['name'];
        if (isset($_POST['id_race'])) $character['id_race'] = $_POST['id_race'];
        if (isset($_POST['id_profession'])) $character['id_profession'] = $_POST['id_profession'];
        if (isset($_POST['id_corporation'])) $character['id_corporation'] = $_POST['id_corporation'];

		if (is_numeric($character['id'])) {
			$this->update($character);

			$_SESSION['message'] = array(
				'type' => 'success',
				'body' => '<strong>Enregistré !</strong> Les modifications du personnage ont été enregistrés.'
			);

		} else {
			
			$id = $this->insert($character);

			$old_dir = realpath('.').'/'.$GLOBALS['attachments_path_characters'].$character['id'];
			$new_dir = realpath('.').'/'.$GLOBALS['attachments_path_characters'].$id;

			rename($old_dir, $new_dir);

			$_SESSION['message'] = array(
				'type' => 'success',
				'body' => '<strong>Enregistré !</strong> Le nouveau personnage a été enregistré.'
			);

		}

		unset($_POST['id_character']);
	}


	public function erase() {

		$character = $this->getOne($_POST['id_character']);
		if ($character) {

			if ($character['id_player'] != $_SESSION['player']['id']) {
				return false;
			} else {

				$this->deleteOne($_POST['id_character']);

					$_SESSION['message'] = array(
						'type' => 'danger',
						'body' => '<strong>Supprimer !</strong> La personnage a été supprimé.'
					);


				return 'Ok';
			}
		}

		return 'Error';
	}

	public function getList() {

		$characters_list = $this->getPlayerList($_SESSION['player']['id']);
		
		$template = get_template('navbar', array('active_menu' => 'characters'));
		$template .= get_template('characters_lst', array('charactersList' => $characters_list));

		return render($template);

	}


	public function getPlayerList($id) {

		$characters_list = parent::getList(array('id_player' => $id));

		foreach ($characters_list as &$character) {
			$character['corporation']	= $this->corporation->getOne($character['id_corporation']);
			$character['race']			= $this->race->getOne($character['id_race']);
			$character['profession']	= $this->profession->getOne($character['id_profession']);
		}

		return $characters_list;

	}

	public function getOne($id) {

		$character = parent::getOne($id);
		if (!$character) return false;

		$character['corporation']	= $this->corporation->getOne($character['id_corporation']);
		$character['race']			= $this->race->getOne($character['id_race']);
		$character['profession']	= $this->profession->getOne($character['id_profession']);

		if ($character['id_player'] != $_SESSION['player']['id'] && $_SESSION['player']['admin'] == 0) {
			return false;
		}

		return $character;

	}

	public function count($id_player) {
		$sql = '
		SELECT id
		FROM '.$this->objectName.'
		WHERE id_player=?
		AND dead=0
		';

		$stmt = $this->db->prepare($sql);
		$stmt->bind_param('i', $id_player);

		$stmt->execute();
		$stmt->store_result();

		$count = $stmt->num_rows;
		$stmt->close();

		return $count;
	}




    //****************************************************************************************************
    //** ADMIN
    //****************************************************************************************************

    public function search_array($array, $colomn, $value) {

		$results = array_search($value, array_column($array, $colomn));
        return $array[$results];
    }


    public function getAdminList() {

		$corporations = $this->corporation->getAll();
		$races = $this->race->getAll();
		$professions = $this->profession->getAll();
		$players_factory = new players();
		$players = $players_factory->getAll();

        $list = $this->getAll();


		foreach ($list as &$character) {

			$character['player']			= $this->search_array($players, 'id', $character['id_player']);
			$character['corporation']		= $this->search_array($corporations, 'id', $character['id_corporation']);
			$character['race']				= $this->search_array($races, 'id', $character['id_race']);
			$character['profession']		= $this->search_array($professions, 'id', $character['id_profession']);

			$character['player_name']		= $character['player']['firstname'].' '.$character['player']['lastname'];
			$character['corporation_name']	= $character['corporation']['name'];
			$character['race_name']			= $character['race']['name'];
			$character['profession_name']	= $character['profession']['name'];
		}

        $columns = array(
            'Joueur' => 'player_name',
            'Nom' => 'name',
            'Race' => 'race_name',
            'Profession' => 'profession_name',
            'Corporation' => 'corporation_name',
            'Grade' => 'rank',
        );

        $orderby = 'name';
        $orderdir = 'desc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-characters'));
        $template .= get_template('characters_lst', array(
            'list' => $list,
            'columns' => $columns,
            'orderby' => $orderby,
            'orderdir' => $orderdir
        ), 'admin/');

        return render($template);

    }



    public function display() {

        if (!isset($_POST['submitaction'])) {
            return $this->getAdminList();
        }

        $character = $this->getOne($_POST['id']);



        $players_factory = new players();
        $player = $players_factory->getOne($character['id_player']);

        $inscriptions_factory = new inscriptions();
        $inscriptions = $inscriptions_factory->characterParticipations($_POST['id']);

        $dir = $GLOBALS['attachments_path_characters'].$_POST['id'];
        $files = array();
        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {

                        $files[] = array(
                            'name' => $file,
                            'path' => '/inscriptions/'.$dir.'/'.$file,
                            'size' => human_filesize(filesize(realpath(__DIR__.'/../'.$dir.'/'.$file))),
                            'type' => mime_content_type(realpath(__DIR__.'/../'.$dir.'/'.$file)),
                        );
                    }
                }
                closedir($dh);
            }
        }

        $template = get_template('navbar', array('active_menu' => 'admin-characters'));
        $template .= get_template('characters_see', array(
            'player' => $player,
            'character' => $character,
            'inscriptions' => $inscriptions,
            'files' => $files
        ), 'admin/');

        return render($template);

    }

    public function adminErase() {

        if (!isset($_POST['submitaction']) || $_POST['submitaction'] != 'erase') {
            return $this->getAdminList();
        }

        $this->DeleteOne($_POST['id']);

        $_SESSION['message'] = array(
            'type' => 'success',
            'body' => 'Le personnage a été supprimé!'
        );

        return $this->getAdminList();
    }

	public function adminEdit() {


		if (isset($_POST['background'])) $this->adminSave();

		if (!isset($_POST['submitaction'])) {
			return $this->getAdminList();
		}

		$races_factory = new races();
		$professions_factory = new professions();
		$corporations_factory = new corporations();

		$race_lst = $races_factory->getAll();
		$professions_lst = $professions_factory->getAll();
		$corporations_lst = $corporations_factory->getAll();

		$character = $this->getOne($_POST['id']);
	
		$dir = $GLOBALS['attachments_path_characters'].$character['id'];
        $files = array();
        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {

                        $files[] = array(
                            'name' => $file,
                            'path' => '/inscriptions/'.$dir.'/'.$file,
                            'size' => human_filesize(filesize(realpath(__DIR__.'/../'.$dir.'/'.$file))),
                            'type' => mime_content_type(realpath(__DIR__.'/../'.$dir.'/'.$file)),
                        );
                    }
                }
                closedir($dh);
            }
        }

        $attachments_lst = get_template('partial/attachments_lst', array('files' => $files));
		$template = get_template('navbar', array('active_menu' => 'admin-characters'));
		$template .= get_template('character_mdf', array(
			'current' => $character,
			'attachments_lst' => $attachments_lst,
			'races_lst' => $race_lst,
			'professions_lst' => $professions_lst,
			'corporations_lst' => $corporations_lst,
		), 'admin/');

		return render($template);


	}


	public function adminSave() {

        $character = array(
            'id' => $_POST['id_character'],
            'id_player' => $_POST['id_player'],
            'background' => $_POST['background'],
            'notes' => $_POST['notes'],
            'name' => $_POST['name'],
            'id_race' => $_POST['id_race'],
            'id_profession' => $_POST['id_profession'],
            'id_corporation' => $_POST['id_corporation'],
        );

		$this->update($character);

		$_SESSION['message'] = array(
			'type' => 'success',
			'body' => '<strong>Enregistré !</strong> Les modifications du personnage ont été enregistrés.'
		);

		unset($_POST['submitaction']);
	}


    public function kill() {

        if (!isset($_POST['submitaction'])) {
            return $this->getAdminList();
        }

        if (isset($_POST['id'])) {

            $current = $this->getOne($_POST['id']);

            $character = array('id' => $_POST['id']);
            if ($_POST['submitaction'] == "kill") {
                $character['dead'] = 1;

                $_SESSION['message'] = array(
                    'type' => 'danger',
                    'body' => 'Le personnage «'.$current['name'].'» est mort!'
                );
            }
            
            if ($_POST['submitaction'] == "unkill") {
                $character['dead'] = 0;

                $_SESSION['message'] = array(
                    'type' => 'success',
                    'body' => 'Le personnage «'.$current['name'].'» a été réssucité!'
                );
            }
            
            $this->update($character);

        }

        $_POST['submitaction'] = 'display';
        return $this->display();
    }


    public function rankup() {

    	$current = $this->getOne($_POST['id']);
		$character = array('id' => $_POST['id']);
		$character['rank'] = 1+$current['rank'];

		$this->update($character);


        $_SESSION['message'] = array(
            'type' => 'success',
            'body' => 'Le personnage «'.$current['name'].'» a monté en grade!'
        );

        $_POST['submitaction'] = 'display';
        return $this->display();

    }


}