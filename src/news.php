<?php
class news extends dataObject 
{


    function __construct() {

        parent::__construct('news');

    }


    public function getList() {
        $sql = '
        SELECT *
        FROM '.$this->objectName.'
        WHERE "'.date("Y-m-d H:i:s").'" > date_publication AND "'.date("Y-m-d H:i:s").'" < date_end	
        ORDER BY date_publication DESC
        ';
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array;
    }





    //****************************************************************************************************
    //** ADMIN
    //****************************************************************************************************

    public function getAdminList() {
        
        if (isset($_POST['submitaction']) && $_POST['submitaction'] == 'save') {
            $this->save();
        }

        $list = parent::getAll();

        $columns = array(
            'Titre' => 'title',
            'Publication' => 'date_publication',
            'Fin' => 'date_end',
            'Mise à jour' => 'date_updated',
        );

        $orderby = 'title';
        $orderdir = 'desc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-news'));
        $template .= get_template('news_lst', array(
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

        $news = $this->getOne($_POST['id']);

        if (!is_numeric($news['id'])) {

            $date_publication = new DateTime();
            $date_end = new DateTime();

            $date_end->add(new DateInterval('P1M'));

            $news['date_publication'] = $date_publication->format('Y-m-d 12:00');
            $news['date_end'] = $date_end->format('Y-m-d 12:00');
        }

        $template = get_template('navbar', array('active_menu' => 'admin-news'));
        $template .= get_template('news_mdf', array('news' => $news), 'admin/');

        return render($template);

    }

    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }

    public function save() {


        $news = array(
            'id' => $_POST['id_news'],
            'title' => $_POST['title'],
            'message' => $_POST['message'],
            'link' => $_POST['link'],
            'date_publication' => $_POST['date_publication'],
            'date_end' => $_POST['date_end'],
        );

        if ($_POST['picture_url'] != '') {
            $base64 = explode(',', $_POST['picture_url']);
            $data = base64_decode($base64[1]);

            $filename = $GLOBALS['picture_path_news'].uniqid().'.jpg';

            file_put_contents($filename, $data);
        
            $news['picture_url'] = $GLOBALS['app_url'].'/'.$filename;
        }

        if (is_numeric($news['id'])) {
            $this->update($news);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de la publication ont été enregistrés.'
            );

        } else {
            $id = $this->insert($news);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> La nouvelle publication a été enregistré.'
            );

        }

        return;

    }

}