<?php
class professions extends dataObject 
{


	function __construct() {

		parent::__construct('features');

	}


	public function getAll() {

		$conditions['discriminator'] = 'profession';
		return parent::getList($conditions);
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


        $template = get_template('navbar', array('active_menu' => 'admin-professions'));
        $template .= get_template('professions_lst', array(
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

        $professions = $this->getOne($_POST['id']);

        $template = get_template('navbar', array('active_menu' => 'admin-professions'));
        $template .= get_template('professions_mdf', array('professions' => $professions), 'admin/');

        return render($template);

    }

    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }

    public function save() {


        $professions = array(
            'id' => $_POST['id_professions'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'link' => $_POST['link'],
            'discriminator' => 'profession',
        );

        if ($_POST['picture_url'] != '') {
            $base64 = explode(',', $_POST['picture_url']);
            $data = base64_decode($base64[1]);

            $filename = $GLOBALS['picture_path_features'].uniqid().'.jpg';

            file_put_contents($filename, $data);
        
            $professions['picture_url'] = $GLOBALS['app_url'].'/'.$filename;
        }

        if (is_numeric($professions['id'])) {
            $this->update($professions);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de la profession ont été enregistrés.'
            );

        } else {
            $id = $this->insert($professions);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> La nouvelle profession a été enregistré.'
            );

        }

        return;

    }

}