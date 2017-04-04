<?php
class races extends dataObject 
{


	function __construct() {

		parent::__construct('features');

	}


	public function getAll() {

		$conditions['discriminator'] = 'race';
		return parent::getList($conditions);
	}

    public function getOrderedList($orderby) {
        $races = $this->getAll();

        usort($races, function($a, $b) use ($orderby) {
            return ($a[$orderby] > $b[$orderby]);
        });

        return $races;
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
            'Mise à jour' => 'date_updated',
        );

        $orderby = 'name';
        $orderdir = 'desc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-races'));
        $template .= get_template('races_lst', array(
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

        $races = $this->getOne($_POST['id']);

        $template = get_template('navbar', array('active_menu' => 'admin-races'));
        $template .= get_template('races_mdf', array('races' => $races), 'admin/');

        return render($template);

    }

    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }

    public function save() {


        $races = array(
            'id' => $_POST['id_races'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'link' => $_POST['link'],
            'malus' => $_POST['malus'],
            'discriminator' => 'race',

        );

        if ($_POST['picture_url'] != '') {
            $base64 = explode(',', $_POST['picture_url']);
            $data = base64_decode($base64[1]);

            $filename = $GLOBALS['picture_path_features'].uniqid().'.jpg';

            file_put_contents($filename, $data);
        
            $races['picture_url'] = $GLOBALS['app_url'].'/'.$filename;
        }

        if (is_numeric($races['id'])) {
            $this->update($races);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de la race ont été enregistrés.'
            );

        } else {
            $id = $this->insert($races);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> La nouvelle race a été enregistré.'
            );

        }

        return;

    }

}