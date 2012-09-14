<?php

class Mysql{
    private $host;
    private $user;
    private $password;
    private $database;
    private $link;
    
    function __construct(){
//        $this->host=$h;
//        $this->user=$u;
//        $this->password=$p;
//        $this->database=$d;
//        $this->link=NULL;
    }
    
    function connect(){
        $this->link=mysql_connect($this->host,$this->user,$this->password);
        mysql_select_db($this->database,$this->link);
    }
    
    function getRows($query){
        $result=mysql_query($query,$this->link);
        if(!$result)
            return false;
        if(mysql_num_rows($result)<=0)
            return array();
        $rows=array();
        while($row =  mysql_fetch_assoc($result))
            $rows[]=$row;
        return $rows;
    }
    
    function update($query){
        if(mysql_query($query,$this->link))
            return mysql_affected_rows($this->link);
        return false;
    }
    
    function delete($query){
        if(mysql_query($query,$this->link))
            return mysql_affected_rows($this->link);
        return false;
    }
    
    function insert($query){
        if(mysql_query($query,$this->link))
            return mysql_affected_rows($this->link);
        return false;
    }
    
    function getRow($query){
        $result=mysql_query($query,$this->link);
        if(!$result)
            return false;
        if(mysql_num_rows($result)<=0)
            return array();
        return mysql_fetch_assoc($result);
    }

    function getModel($model_name){
    $model_file=MODEL_PATH.strtolower($model_name).FILE_EXT;
    if(file_exists($model_file)){
        include_once($model_file);
        return new $model_name();
    }
    return NULL;
}
};

?>
