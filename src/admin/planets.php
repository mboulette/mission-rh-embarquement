<?php
class planets extends dataObject 
{


	function __construct() {

		parent::__construct('planets');

	}

    function getJSON() {
        header('Content-Type: text/plain');

        $list = $this->getAll();
        foreach ($list as &$planet) {
            $planet['position'] = json_decode($planet['position'], true);
        }

        return base64_encode(json_encode($list));

        /*
        // Le code client est obscurci mais il ressemble à ceci:

        $.get('../inscriptions/planets', function(planets) {
            var planets = JSON.parse(atob(planets));
            loadScene(planets);
        });

        */

    }


    //****************************************************************************************************
    //** ADMIN
    //****************************************************************************************************

    public function getAdminList() {
        
        if (isset($_POST['submitaction']) && $_POST['submitaction'] == 'save') {
            $this->save();
        }

        $list = $this->getAll();

        foreach ($list as &$planet) {
            $planet['position'] = json_decode($planet['position'], true);
        }

        $columns = array(
            'Code' => 'code',
            'Nom' => 'name',
            'Position' => 'position',
            'Taille' => 'size',
            'Rhodium' => 'rhodium',
            'Description' => 'description',
            'Mise à jour' => 'date_updated',
        );

        $orderby = 'name';
        $orderdir = 'desc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-planets'));
        $template .= get_template('planets_lst', array(
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


        $dir = $GLOBALS['planets_textures_path'];
        $textures = array();
        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {

                        $textures[] = array(
                            'name' => 'planet-textures/'.$file,
                            'path' => '/constellations/planet-textures/'.$file,
                        );
                    }
                }
                closedir($dh);
            }
        }

        $dir = '../constellations/planet-bumps/';
        $bumps = array();
        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {

                        $bumps[] = array(
                            'name' => 'planet-bumps/'.$file,
                            'path' => '/constellations/planet-bumps/'.$file,
                        );
                    }
                }
                closedir($dh);
            }
        }


        if (is_numeric($_POST['id'])) {
            $planets = $this->getOne($_POST['id']);
            $planets['position'] = json_decode($planets['position'], true);            
        } else {
            $planets = array(
                "size" => 2,
                "rhodium" => 2,
                "hazard" => 2,
                "position" => array("x" => 0, "y" => 0, "z" => 0),
                "color" => "#FFFFFF"
            );
        }

        $template = get_template('navbar', array('active_menu' => 'admin-planets'));
        $template .= get_template('planets_mdf', array(
            'planets' => $planets,
            'textures' => $textures,
            'bumps' => $bumps
        ), 'admin/');

        return render($template);

    }

    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }

    public function save() {


        $planets = array(
            'id' => $_POST['id_planets'],
            'code' => $_POST['code'],
            'name' => $_POST['name'],
            'size' => $_POST['size'],
            'rhodium' => $_POST['rhodium'],
            'hazard' => $_POST['hazard'],
            'position' => json_encode($_POST['position']),
            'description' => $_POST['description'],
            'texture' => $_POST['texture'],
            'bump' => $_POST['bump'],
            'color' => $_POST['color']
        );

        if (is_numeric($planets['id'])) {
            $this->update($planets);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de la planète ont été enregistrés.'
            );

        } else {
            $id = $this->insert($planets);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Le nouvelle planèete a été enregistrée.'
            );

        }

        return;

    }

}