<?php

    class CoModel
    {
        protected $db;
        function __construct($db){
            $this->db = $db;
        }
        function field($table){
            return $this->db->query("SHOW COLUMNS FROM $table");
        }
        function count($table){
            return $this->db->query("SELECT COUNT(*) FROM $table");
        }
        function create($table,$paramsArr)
        {
            $key = array_keys($paramsArr);
            $val = array_values($paramsArr);

            $query = "INSERT INTO $table (" . implode(', ', $key) . ") "
                . "VALUES ('" . implode("', '", $val) . "')";

            $row = $this->db->prepare($query);
            return $row ->execute();
        }
        function readAll($table)
        {
            return $this->db->query("SELECT * FROM $table");
        }
        function readWhere($table,$field,$id,$data)
        {//SELECT * FROM `ArticleMn` WHERE ArtcPq BETWEEN 3 AND 4 ORDER BY ArtcPq DESC LIMIT 2, 5
            if(empty($data)){
                $row = $this->db->prepare("SELECT * FROM $table WHERE $field = ?" );
                $row->execute(array($id));
            }else if($data[0] == "limit"){
                $row = $this->db->prepare("SELECT * FROM $table WHERE $field = ? ORDER BY $data[3] DESC LIMIT $data[1], $data[2]");
                $row->execute(array($id));
            }else{
                $row = $this->db->prepare("SELECT * FROM $table WHERE $data[0] BETWEEN $data[1] AND $data[2] AND ($field = ?) ORDER BY $data[3] DESC");
                $row->execute(array($id));
            }
            return $row;
        }
        function readLimit($table,$field,$id,$data)
        {
            $row = $this->db->prepare("SELECT * FROM $table LIMIT $data[1], $data[2] AND ($field = ?)");
            $row->execute(array($id));
            return $row;
        }
        function editWhere($table,$data,$field,$id)
        {
            $setPart = array();
            foreach ($data as $key => $value)
            {
                $setPart[] = $key."=:".$key;
            }
            $sql = "UPDATE $table SET ".implode(', ', $setPart)." WHERE $field = :id";
            $row = $this->db->prepare($sql);
            //Bind our values.
            $row ->bindValue(':id',$id); // where
            foreach($data as $param => $val)
            {
                $row ->bindValue($param, $val);
            }
            return $row ->execute();
        }
        function dropWhere($table,$field,$id)
        {
            $sql = "DELETE FROM $table WHERE $field = ?";
            $row = $this->db->prepare($sql);
            return $row ->execute(array($id));
        }
    }
?>