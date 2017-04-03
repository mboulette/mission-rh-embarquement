<?php
class recipes extends dataObject 
{


	function __construct() {

		parent::__construct('recipes');

	}




    //****************************************************************************************************
    //** ADMIN
    //****************************************************************************************************

    public function getAdminList() {
        
        if (isset($_POST['submitaction']) && $_POST['submitaction'] == 'save') {
            $this->save();
        }

        $list = $this->getAll();

        $columns = array(
            'Nom' => 'name',
            'Description' => 'description',
            'Niveau' => 'level',
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

        $recipes = $this->getOne($_POST['id']);

        $template = get_template('navbar', array('active_menu' => 'admin-recipes'));
        $template .= get_template('recipes_mdf', array('recipes' => $recipes), 'admin/');

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
            'recipies' => $_POST['recipies'],
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