<?php
class eventOptions extends dataObject 
{


	function __construct() {
		parent::__construct('event_options');

	}


    public function getAdminList() {
        
        if (isset($_POST['submitaction']) && $_POST['submitaction'] == 'save') {
            $this->save();
        }

        $list = $this->getAll();
        $categories = $this->getOptionsCategories();

        foreach ($list as &$option) {
            $option['category_name'] = $categories[$option['id_category']]['name'];
        }


        $columns = array(
            'Categorie' => 'category_name',
            'Nom' => 'name',
            'Prix' => 'price',
            'Désactivé' => 'locked',
            'Mise à jour' => 'date_updated',
        );

        $orderby = 'name';
        $orderdir = 'desc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-options'));
        $template .= get_template('options_lst', array(
            'list' => $list,
            'columns' => $columns,
            'orderby' => $orderby,
            'orderdir' => $orderdir
        ), 'admin/');

        return render($template);

    }

    public function getOptionsCategories() {
        $sql = '
        SELECT * FROM options_categories
        ORDER BY id
        ';

        $stmt = $this->db->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        $categories = array();
        foreach ($array as $category) {
            $categories[$category['id']] = $category;
        }

        return $categories;

    }

    public function edit() {

        if (!isset($_POST['submitaction'])) {
            return $this->getAdminList();
        }

        $options = $this->getOne($_POST['id']);
        $categories = $this->getOptionsCategories();

        $template = get_template('navbar', array('active_menu' => 'admin-options'));
        $template .= get_template('options_mdf', array(
            'options' => $options,
            'categories' => $categories
        ), 'admin/');

        return render($template);

    }


    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }


    public function save() {

        $options = array(
            'id' => $_POST['id_options'],
            'id_category' => $_POST['id_category'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'link' => $_POST['link'],
            'mandatory' => $_POST['mandatory'],
            'locked' => $_POST['locked'],
            'price' => $_POST['price'],
            'options' => $_POST['options'],
        );

        if ($_POST['picture_url'] != '') {
            $base64 = explode(',', $_POST['picture_url']);
            $data = base64_decode($base64[1]);

            $filename = $GLOBALS['picture_path_options'].uniqid().'.jpg';

            file_put_contents($filename, $data);
        
            $options['picture_url'] = $GLOBALS['app_url'].'/'.$filename;
        }


        if (is_numeric($options['id'])) {
            $this->update($options);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de l`option ont été enregistrés.'
            );

        } else {
            $id = $this->insert($options);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> La nouvelle  option a été enregistré.'
            );

        }

        return;

    }


    public function lock() {

        if (isset($_POST['id'])) {

            $current = $this->getOne($_POST['id']);

            $option = array('id' => $_POST['id']);
            $option['locked'] = abs($current['locked']-1);
            
            $this->update($option);

            header('Content-Type: application/json');
            return json_encode($option['locked']);

        }

        return json_encode(false);

    }

}