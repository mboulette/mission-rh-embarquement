<?php
class ressources extends dataObject 
{


	function __construct() {

		parent::__construct('ressources');

	}

    public function getLevelName($level) {
        $level_name = array(
            1 => 'Terrestre',
            2 => 'Indigène',
            3 => 'Hybride',
        );

        return $level_name[$level];
    }

    public function getOne($id) {
        $tmp = parent::getOne($id);
        $tmp['credits'] = json_decode($tmp['credits'], true);
        if (is_null($tmp['credits'])) $tmp['credits'] = array();
        $tmp['level_name'] = $this->getLevelName($tmp['level']);

        return $tmp;
    }

    public function getOrderedList($orderby) {
        $ressources = $this->getAll();

        usort($ressources, function($a, $b) use ($orderby) {
            return ($a[$orderby] > $b[$orderby]);
        });

        return $ressources;
    }


    //****************************************************************************************************
    //** ADMIN
    //****************************************************************************************************

    public function getAdminList() {
        


        if (isset($_POST['submitaction']) && $_POST['submitaction'] == 'save') {
            $this->save();
        }

        $list = $this->getAll();

        foreach ($list as &$ressource) {
            $ressource['level_name'] = $this->getLevelName($ressource['level']);
        }

        $columns = array(
            'Nom' => 'name',
            'Description' => 'description',
            'Niveau' => 'level_name',
            'Mise à jour' => 'date_updated',
        );

        $orderby = 'name';
        $orderdir = 'desc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-ressources'));
        $template .= get_template('ressources_lst', array(
            'list' => $list,
            'columns' => $columns,
            'orderby' => $orderby,
            'orderdir' => $orderdir
        ), 'admin/');

        return render($template);

    }

    public function edit() {

        if (!isset($_POST['submitaction'])) {
            return $this->getAdminList();
        }

        $ressources = $this->getOne($_POST['id']);
        $professions = new professions();
        $professions = $professions->getOrderedList('name');

        $template = get_template('navbar', array('active_menu' => 'admin-ressources'));
        $template .= get_template('ressources_mdf', array(
            'ressources' => $ressources,
            'professions' => $professions
        ), 'admin/');

        return render($template);

    }

    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }

    public function save() {


        $ressources = array(
            'id' => $_POST['id_ressources'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'link' => $_POST['link'],
            'level' => $_POST['level'],
            'credits' => json_encode($_POST['credits']),
        );

        if (is_numeric($ressources['id'])) {
            $this->update($ressources);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de la ressource ont été enregistrés.'
            );

        } else {
            $id = $this->insert($ressources);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> La nouvelle ressource a été enregistré.'
            );

        }

        return;

    }

}