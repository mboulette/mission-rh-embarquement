<?php
class recipes extends dataObject 
{


	function __construct() {

		parent::__construct('recipes');

	}

    public function getOne($id) {
        $tmp = parent::getOne($id);
        $tmp['recipies'] = json_decode($tmp['recipies'], true);
        if (is_null($tmp['recipies'])) $tmp['recipies'] = array();
        $tmp['level_name'] = $this->getLevelName($tmp['level']);

        return $tmp;
    }

    public function getLevelName($level) {
        $level_name = array(
            1 => 'Mineure',
            2 => 'Majeure',
        );

        return $level_name[$level];
    }


    //****************************************************************************************************
    //** ADMIN
    //****************************************************************************************************
    public function search_array($array, $colomn, $value) {

        $results = array_search($value, array_column($array, $colomn));
        return $array[$results];
    }

    public function getAdminList() {
        
        if (isset($_POST['submitaction']) && $_POST['submitaction'] == 'save') {
            $this->save();
        }

        $professions = new professions();
        $professions = $professions->getOrderedList('name');

        $list = $this->getAll();

        foreach ($list as &$recipe) {
            $recipe['level_name'] = $this->getLevelName($recipe['level']);
            $recipe['profession_name'] = $this->search_array($professions, 'id', $recipe['feature_id'])['name'];
        }

        $columns = array(
            'Profession' => 'profession_name',
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


        $template = get_template('navbar', array('active_menu' => 'admin-recipes'));
        $template .= get_template('recipes_lst', array(
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

        $professions = new professions();
        $professions = $professions->getOrderedList('name');

        $ressources = new ressources();
        $ressources = $ressources->getOrderedList('name');


        $recipes = $this->getOne($_POST['id']);

        $template = get_template('navbar', array('active_menu' => 'admin-recipes'));
        $template .= get_template('recipes_mdf', array(
            'recipes' => $recipes,
            'professions' => $professions,
            'ressources' => $ressources
        ), 'admin/');

        return render($template);

    }

    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }

    public function save() {


        $recipes = array(
            'id' => $_POST['id_recipes'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'link' => $_POST['link'],
            'level' => $_POST['level'],
            'recipies' => json_encode($_POST['recipies']),
            'method' => $_POST['method'],
            'effect' => $_POST['effect'],
            'bilan' => $_POST['bilan'],
            'feature_id' => $_POST['feature_id'],
        );

        if (is_numeric($recipes['id'])) {
            $this->update($recipes);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de la recette ont été enregistrés.'
            );

        } else {
            $id = $this->insert($recipes);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> La nouvelle recette a été enregistré.'
            );

        }

        return;

    }

}