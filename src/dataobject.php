<?php
class dataObject
{

    protected $db;
    protected $objectName;


    function __construct($objectName) {
        $this->db = $GLOBALS['mysql_conn'];
        $this->objectName = $objectName;
    }

    function __destruct() {
        //$this->db->close();
    }


    public function getAll($orderby = null) {
        
        $sql = '
        SELECT *
        FROM '.$this->objectName.'
        ';

        if (!is_null($orderby)) $sql = $sql.' ORDER BY '.$orderby;

        $stmt = $this->db->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array;
    }

    public function getList($conditions, $orderby = null) {
        
        $sql = '
        SELECT *
        FROM '.$this->objectName.'
        WHERE
        ';
        
        $param = array();
        $param[] = & str_pad('', count($conditions), 's');

        foreach ($conditions as $field => $value){
            $sql .= $field.'=? AND ';
            $param[] = & $conditions[$field];
        }
        $sql = substr($sql, 0, -4);

        if (!is_null($orderby)) $sql = $sql.' ORDER BY '.$orderby;

        $stmt = $this->db->prepare($sql);

        call_user_func_array(array($stmt, 'bind_param'), $param);

        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array;

    }


    public function getOne($id) {

        $sql = '
        SELECT *
        FROM '.$this->objectName.'
        WHERE id=?
        ';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array[0];

    }

    public function insert($fields) {

        unset($fields['id']);

        $date = new DateTime('now');
        $fields['date_created'] = $date->format('Y-m-d H:i:s');
        $fields['date_updated'] = $date->format('Y-m-d H:i:s');

        $sql = 'INSERT INTO '.$this->objectName.' SET ';

        $param = array();
        $param[] = & str_pad('', count($fields), 's');

        foreach ($fields as $field => $value){
            $sql .= $field.'=?, ';
            $param[] = & $fields[$field];
        }
        $sql = substr($sql, 0, -2);

        $stmt = $this->db->prepare($sql);

        call_user_func_array(array($stmt, 'bind_param'), $param);

        $stmt->execute();
        $stmt->close();

        return $this->db->insert_id;

    }


    public function update($fields) {

        $id = $fields['id'];
        unset($fields['id']);

        $date = new DateTime('now');
        $fields['date_updated'] = $date->format('Y-m-d H:i:s');

        $sql = 'UPDATE '.$this->objectName.' SET ';
        
        $param = array();
        $param[] = & str_pad('', count($fields), 's');

        foreach ($fields as $field => $value){
            $sql .= $field.'=?, ';
            $param[] = & $fields[$field];
        }
        $sql = substr($sql, 0, -2).' WHERE id='.$id;

        $stmt = $this->db->prepare($sql);

        call_user_func_array(array($stmt, 'bind_param'), $param);

        $stmt->execute();
        $stmt->close();

    }

    public function DeleteOne($id) {

        $sql = '
        DELETE
        FROM '.$this->objectName.'
        WHERE id=?
        ';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);

        $result = $stmt->execute();
        $stmt->close();

        return $result;

    }

    public function getMock() {

        $mock = array();
        $date = new DateTime('now');

        $sql = 'SHOW COLUMNS FROM '.$this->objectName;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            
            if ($row['Default'] == 'CURRENT_TIMESTAMP') $row['Default'] = $date->format('Y-m-d H:i:s');
            if ($row['Default'] == NULL) $row['Default'] = $row['Default'] = '';
            if ($row['Default'] == NULL && substr($row['Type'], 0, 3) == 'var') $row['Default'] = '';
            //if ($row['Default'] == NULL && substr($row['Type'], 0, 3) == 'int') $row['Default'] = 0;

            $mock[$row["Field"]] = $row["Default"];
        }

        $stmt->close();

        return $mock;
    }

}