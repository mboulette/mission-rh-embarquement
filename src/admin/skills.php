<?php
class skills extends dataObject 
{


	function __construct() {

		parent::__construct('skills');

	}

    public function getRaceList($id) {
        $sql = '
        SELECT *
        FROM '.$this->objectName.'
        WHERE feature_id=?
        ORDER BY `name`
        ';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array;
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

        $list = $this->getAll();

        $races = new races();
        $races = $races->getOrderedList('name');

        foreach ($list as &$skill) {
            $skill['race_name'] = $this->search_array($races, 'id', $skill['feature_id'])['name'];
        }

        $columns = array(
            'Race' => 'race_name',
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


        $template = get_template('navbar', array('active_menu' => 'admin-skills'));
        $template .= get_template('skills_lst', array(
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

        $races = new races();
        $races = $races->getOrderedList('name');

        $skills = $this->getOne($_POST['id']);

        $template = get_template('navbar', array('active_menu' => 'admin-skills'));
        $template .= get_template('skills_mdf', array(
            'skills' => $skills,
            'races' => $races
        ), 'admin/');

        return render($template);

    }

    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }

    public function save() {


        $skills = array(
            'id' => $_POST['id_skills'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'link' => $_POST['link'],
            'script' => $_POST['script'],
            'feature_id' => $_POST['feature_id'],
        );

        if (is_numeric($skills['id'])) {
            $this->update($skills);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de l`habileté ont été enregistrés.'
            );

        } else {
            $id = $this->insert($skills);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> La nouvelle habileté a été enregistré.'
            );

        }

        return;

    }

}