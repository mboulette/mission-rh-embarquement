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


		if (isset($_POST['step'])) return $this->save();

		if (!isset($_POST['id_character'])) {
			return $this->getList();
		}

		$character = $this->getOne($_POST['id_character']);
		if (!$character) {
			$character = $this->getMock();
			$character['id'] = uniqid();
			$character['id_race'] = $_POST['id_race'];
			$character['id_profession'] = $_POST['id_profession'];
			$character['id_corporation'] = $_POST['id_corporation'];

		}

		$races_factory = new races();
		$professions_factory = new professions();
		$corporations_factory = new corporations();
		$ressources_factory = new ressources();
		$skills_factory = new skills();
		$recipes_factory = new recipes();

		$races_lst = $races_factory->getOrderedList('name');
		$professions_lst = $professions_factory->getOrderedList('name');
		$corporations_lst = $corporations_factory->getOrderedList('name');
		$ressources_lst = $ressources_factory->getAll();


		$corporations_tpl = array();
		foreach ($corporations_lst as $corpo) {
			$corpo['ressource'] = search_array($ressources_lst, 'id', $corpo['ressource_id']);
			$corporations_tpl[] = get_template('partial/corpo_card', array(
				'corpo' => $corpo,
				'checked' => $character['id_corporation']
			));
		}

		$races_tpl = array();
		foreach ($races_lst as $race) {
			$race['skills'] = $skills_factory->getRaceList($race['id']);
			$races_tpl[] = get_template('partial/race_card', array(
				'race' => $race,
				'checked' => $character['id_race']
			));
		}

		$professions_tpl = array();
		foreach ($professions_lst as $profession) {
			$profession['recipes'] = $recipes_factory->getProfessionList($profession['id']);	
			$professions_tpl[] = get_template('partial/prof_card', array(
				'profession' => $profession,
				'ressources' => $ressources_lst,
				'checked' => $character['id_profession']
			));
		}

	
		$template = get_template('navbar', array('active_menu' => 'characters'));
		$template .= get_template('character_step1_mdf', array(
			'character' => $character,
			'races_tpl' => $races_tpl,
			'professions_tpl' => $professions_tpl,
			'corporations_tpl' => $corporations_tpl,
			
			'races_lst' => $races_lst,
			'professions_lst' => $professions_lst,
			'corporations_lst' => $corporations_lst,
		));

		return render($template);

	}

	private function edit_step_2($character) {

		if ($character['feats'] == '') $character['feats'] = '[]';

		$skills_factory = new skills();
		$feats_factory = new feats();

		$skills_lst = $skills_factory->getRaceList($character['id_race']);
		$feats_lst = $feats_factory->getAll();

		$orderby = 'name';
		$orderdir = 'desc';
        usort($feats_lst, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });
	

		$skills_tpl = array();
		foreach ($skills_lst as $skill) {
			$skills_tpl[] = get_template('partial/skill_card', array(
				'skill' => $skill,
				'checked' => $character['id_skill']
			));
		}

		$feats_tpl = array();
		foreach ($feats_lst as $feat) {

			$feats_tpl[] = get_template('partial/feat_card', array(
				'feat' => $feat,
				'checked' => (in_array($feat['id'], json_decode($character['feats'], true )) ? $feat['id'] : 0)
			));
		}

		$template = get_template('navbar', array('active_menu' => 'characters'));
		$template .= get_template('character_step2_mdf', array(
			'character' => $character,
			'skills_tpl' => $skills_tpl,
			'feats_tpl' => $feats_tpl,
		));

		return render($template);


	}

	private function edit_step_3($character) {

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

        $attachments_tpl = get_template('partial/attachments_lst', array('files' => $files));

		$template = get_template('navbar', array('active_menu' => 'characters'));
		$template .= get_template('character_step3_mdf', array(
			'character' => $character,
			'attachments_tpl' => $attachments_tpl,
		));

		return render($template);


	}

	public function save() {

		$character = parent::getOne($_POST['id_character']);
		if (!$character) {
			$character = $this->getMock();
			$character['id'] = $_POST['id_character'];
		}

		if (isset($_POST['id_character'])) $character['id'] = $_POST['id_character'];
		if (isset($_POST['id_race'])) $character['id_race'] = $_POST['id_race'];
		if (isset($_POST['id_profession'])) $character['id_profession'] = $_POST['id_profession'];
		if (isset($_POST['id_corporation'])) $character['id_corporation'] = $_POST['id_corporation'];

		if (isset($_POST['id_skill'])) $character['id_skill'] = $_POST['id_skill'];
		if (isset($_POST['feats'])) $character['feats'] = $_POST['feats'];


		switch ($_POST['step']) {
			case '1':
        		return $this->edit_step_2($character);
			break;

			case '2':
        		if (isset($_POST['id_feat'])) $character['feats'] = json_encode($_POST['id_feat']);

        		return $this->edit_step_3($character);
			break;


			case '3':
        		$character['name'] = $_POST['name'];
        		$character['id_player'] = $_SESSION['player']['id'];
        		$character['background'] = $_POST['background'];
        		$character['notes'] = $_POST['notes'];

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

				return $this->getList();

			break;
			

		}

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

		$characters_list = parent::getList(array('id_player' => $id), 'rank desc, name');

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

    public function lastKilled($id_player) {
        $sql = '
        SELECT *
        FROM characters
        WHERE id_player='.$id_player.'
        AND dead>0
        ORDER BY date_dead desc
        LIMIT 1
        ';
        $stmt = $this->db->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $array;
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
                $character['dead'] = $_POST['circonstance'];

		        $date = new DateTime('now');
		        $character['date_dead'] = $date->format('Y-m-d H:i:s');

                $_SESSION['message'] = array(
                    'type' => 'danger',
                    'body' => 'Le personnage «'.$current['name'].'» est mort!'
                );
            }
            
            if ($_POST['submitaction'] == "unkill") {
                $character['dead'] = 0;
                $character['date_dead'] = null;

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