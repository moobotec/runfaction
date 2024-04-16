<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: ModelSqlite3.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: FrontEnd / Backend de suivie des performances pour les sportifs, entraineurs et associations
   =
   =  INTERVENTION:
   =
   =    * 19/12/2023 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */

include_once("common/common.php");  

use Carbon\Carbon;

class MyDB extends SQLite3
{
    function __construct()
    {
        global $param_root;
        global $sizeBdd;
        $sizeBdd = filesize($param_root.'/bdd/'.THEME.'/db'.THEME.'.db3');
        $this->open($param_root.'/bdd/'.THEME.'/db'.THEME.'.db3',SQLITE3_OPEN_READWRITE);
    }

    // Méthode pour fermer explicitement la connexion à la base de données
    public function closeConnection()
    {
        $this->close();
    }

    function __destruct() {
        // destructeur
    }
}   

abstract class ModelSqlite3 {

    private static $sqlite = null;

    protected static function getDb() {
        global $error;
        if (!isset(self::$sqlite)) {
            self::$sqlite = new MyDB;
            if(!self::$sqlite) {
                openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
                syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] opened database - '.self::$sqlite->lastErrorMsg() );
                $error = true;
            }
        }
        return self::$sqlite;
    }

    protected static function getModelName() {
        return strtolower(get_called_class());
    }

    protected static function getTableName() {
        return self::getModelName() . 's';
    }

    protected static function getFieldName($field) {
        return self::getModelName() . '_' . $field;
    }

    protected static function getBindName($field) {
        return ":{$field}";
    }

    protected static function getPropertyName($prop) {
        return substr($prop, strlen(self::getModelName()) + 1);
    }

    public static function get($id) {
        return self::getBy('id', $id);
    }
    
    protected static function getNameOne() {
        return self::getModelName();
    }
    
    protected static function getNameList() {
        return self::getModelName() . 's';
    }
    
    protected static function getNameNotification() {
        return 'Notification'.get_called_class();
    }

    protected static function getBy($field, $value) {
        $tableName = self::getTableName();
        $fieldName = self::getFieldName($field);
        $bindName = self::getBindName($field);
        $query = "SELECT * FROM {$tableName} ";
        $query .= "WHERE {$fieldName} = {$bindName}";
        $sth = self::getDb()->prepare($query);
        $sth->bindParam($bindName, $value);
        $ret = $sth->execute();
        if(!$ret && self::getDb()->lastErrorCode() != 0 ) {
            openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
            syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] '.self::getDb()->lastErrorMsg().' __ '.$query );
            $error = true;
        } else {
            $models = array();
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                if ($row) {
                    $modelName = self::getModelName();
                    $models[] = new $modelName($row);    
                }
            }
            return $models;
        } 
        return null;
    }

    public static function count() {
        $tableName = self::getTableName();
        $query = "SELECT COUNT(*) FROM {$tableName}";
        $sth = self::getDb()->prepare($query);
        $ret = $sth->execute();
        if(!$ret && self::getDb()->lastErrorCode() != 0 ) {
            openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
            syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] '.self::getDb()->lastErrorMsg().' __ '.$query );
            $error = true;
        } 
        else 
        {
            $row = $ret->fetchArray(SQLITE3_ASSOC);
            if ($row)
            {
                return $row['COUNT(*)'];
            }
            return null;
        }
        return null;
    }

    public static function getAll($limit, $orderBy) {
        $tableName = self::getTableName();
        $query = "SELECT * FROM {$tableName}";
        if (isset($orderBy) && $orderBy != '')
        {
            $query .=" ORDER BY {$orderBy}";
        }
        if (isset($limit) && $limit != '' && $limit > 0)
        {
            $query .=" LIMIT {$limit}";
        }
        $sth = self::getDb()->prepare($query);
        $ret = $sth->execute();
        if(!$ret && self::getDb()->lastErrorCode() != 0 ) {
            openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
            syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] '.self::getDb()->lastErrorMsg().' __ '.$query );
            $error = true;
        } else {
            $models = array();
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                if ($row) {
                    $modelName = self::getModelName();
                    $models[] = new $modelName($row);    
                }
            }
            return $models;
        }
        return null;
    }

    protected static function getAllBy($field, $value) {
        $tableName = self::getTableName();
        $fieldName = self::getFieldName($field);
        $bindName = self::getBindName($field);
        $query = "SELECT * FROM {$tableName} ";
        $query .= "WHERE {$fieldName} = {$bindName}";
        $sth = self::getDb()->prepare($query);
        $sth->bindValue($bindName, $value);
        $ret = $sth->execute();
        if(!$ret && self::getDb()->lastErrorCode() != 0 ) {
            openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
            syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] '.self::getDb()->lastErrorMsg().' __ '.$query );
            $error = true;
        } else {
            $models = array();
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                if ($row) {
                    $modelName = self::getModelName();
                    $models[] = new $modelName($row);
                }
            }
            return $models;
        }
        return null;
    }

    /* Exemple
    array ( "value" => array ( 'name' => 'Daumand',
        *       'firstname' => 'David'),
        *     "type" => array ( 'text', 'text'),
        */
    protected static function searchBy($arrayFieldValue,$limit, $orderBy) {
        $tableName = self::getTableName();
        $query = "SELECT * FROM {$tableName} ";
        $querySearch = ""; 
        $coupleFieldValue = $arrayFieldValue["value"];
        $coupleType = $arrayFieldValue["type"];
        $pos = 0;
        $i = 0;
        foreach ( $coupleFieldValue as $field => $value ) 
        { 
            if ($coupleType[$pos] == "text")
            {   
                if ($value != '')
                {
                     if ($i > 0) $querySearch .=  " AND (";
                    else  $querySearch .=  " (";
                    $fieldName = self::getFieldName($field);
                    $querySearch .=  " {$fieldName} LIKE '%{$value}%'";
                    $querySearch .=  " )";
                    $i = $i + 1;
                }
            }
            else if ($coupleType[$pos] == "listinteger")
            {
                if (count($value) > 0)
                {
                    if ($i > 0) $querySearch .=  " AND (";
                    else  $querySearch .=  " (";
                    $v = 0;
                    foreach ( $value as $element )
                    {
                        if ($v > 0) $querySearch .=  " OR";
                        $fieldName = self::getFieldName($field);
                        $querySearch .=  " {$fieldName} = {$element}";
                        $v = $v + 1;
                    }
                    $querySearch .=  " )";
                    $i = $i + 1;
                }
            }
            else if ($coupleType[$pos] == "date")
            {
                if (count($value) > 0 && $value["searchType"] != '' )
                {
                    $fieldName = self::getFieldName($field);
                    switch ($value["searchType"]) {
                        case "-":
                            if ($i > 0) $querySearch .=  " AND (";
                            else  $querySearch .=  " (";
                            $timestampDateStartUTC = Carbon::createFromFormat('m/Y', $value["searchStartDate"], 'Europe/Paris')->setTimezone('UTC')->timestamp ;
                            $timestampDateEndUTC = Carbon::createFromFormat('m/Y', $value["searchEndDate"], 'Europe/Paris')->setTimezone('UTC')->timestamp ;
                            $querySearch .=  " {$fieldName} >= {$timestampDateStartUTC} AND {$fieldName} <= {$timestampDateEndUTC}";
                            $querySearch .=  " )";
                            $i = $i + 1;
                            break;
                        case "<":
                            if ($i > 0) $querySearch .=  " AND (";
                            else  $querySearch .=  " (";
                            $timestampDateStartUTC = Carbon::createFromFormat('m/Y', $value["searchStartDate"], 'Europe/Paris')->setTimezone('UTC')->timestamp ;
                            $querySearch .=  " {$fieldName} <= {$timestampDateStartUTC}";
                            $querySearch .=  " )";
                            $i = $i + 1;
                            break;
                        case ">":
                            if ($i > 0) $querySearch .=  " AND (";
                            else  $querySearch .=  " (";
                            $timestampDateStartUTC = Carbon::createFromFormat('m/Y', $value["searchStartDate"], 'Europe/Paris')->setTimezone('UTC')->timestamp ;
                            $querySearch .=  " {$fieldName} >= {$timestampDateStartUTC}";
                            $querySearch .=  " )";
                            break;
                        case "==":
                            if ($i > 0) $querySearch .=  " AND (";
                            else  $querySearch .=  " (";
                            $timestampDateStartUTC = Carbon::createFromFormat('m/Y', $value["searchStartDate"], 'Europe/Paris')->setTimezone('UTC')->format('m/Y') ;
                            $querySearch .=  " strftime('%m/%Y', datetime({$fieldName}, 'unixepoch', 'utc')) = '{$timestampDateStartUTC}'";
                            $querySearch .=  " )";
                            break;
                        case "!=":
                            if ($i > 0) $querySearch .=  " AND (";
                            else  $querySearch .=  " (";
                            $timestampDateStartUTC = Carbon::createFromFormat('m/Y', $value["searchStartDate"], 'Europe/Paris')->setTimezone('UTC')->format('m/Y') ;
                            $querySearch .=  " strftime('%m/%Y', datetime({$fieldName}, 'unixepoch', 'utc')) != '{$timestampDateStartUTC}'";
                            $querySearch .=  " )";
                            break;
                        default:
                            throw new Exception('Search date not possible.');
                            break;
                    }
                }
            }
            $pos = $pos + 1;
        }
       
        if ($querySearch != '') $query .= "WHERE ".$querySearch; 

        if (isset($orderBy) && $orderBy != '')
        {
            $query .=" ORDER BY {$orderBy}";
        }
        if (isset($limit) && $limit != '' && $limit > 0)
        {
            $query .=" LIMIT {$limit}";
        }

        $sth = self::getDb()->prepare($query);
        $ret = $sth->execute();
        if(!$ret && self::getDb()->lastErrorCode() != 0 ) {
            openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
            syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] '.self::getDb()->lastErrorMsg().' __ '.$query );
            $error = true;
        } else {
            $models = array();
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                if ($row) {
                    $modelName = self::getModelName();
                    $models[] = new $modelName($row);
                }
            }
            return $models;
        }
        return null;
    }

    protected static function serializeResponse($data)
    {
        $messages = array();
        $return = array();
        $return["message"] = null;
        $return["error"] = false;    
        if ($data["error"] != null )
        {
            $return["error"] = true;
            foreach ($data["error"] as $key => $value) {
                $code = self::getNameNotification()::findByColumn('id',$value);
                if ($code != false)
                {
                    if ($code->id == 532) // exception code
                    {
                        if ($data["exceptions"] != null )
                        {
                            array_push($messages,$data["exceptions"]);
                        }
                    }
                    else
                    {
                        array_push($messages,$code);
                    }
                }
            }
            if (sizeof($messages) > 0)
            {
                $return["message"] = $messages;
            }
        }
        if ($data["uri"] != null )
        {
            $return["uri"] = $data["uri"];
        }
        if ($data["command"] != null )
        {
            $return["command"] = $data["command"];
        }
        if ($data["post"] != null )
        {
            $return["post"] = $data["post"];
        }
        return $return;
    }

    private $fields = array();
    private $bannedfields = array();

    public function __construct($schema,$bannedSchema, $data) {
        $this->fields['id'] = array('value' => null, 'type' => SQLITE3_INTEGER);
        foreach ($schema as $name => $type) {
            $this->fields[$name] = array('value' => null, 'type' => $type);
        }
        foreach ($bannedSchema as &$field) {
            $this->bannedfields[$field] = true;
        }
        if ($data != null) {            
            foreach ($data as $column => $value) {
                $prop = self::getPropertyName($column);
                $this->fields[$prop]['value'] = $value;
            }
        }
    }

    public function save() {
        global $error;
        $tableName = self::getTableName();
        if ($this->fields['id']['value'] != null) {
            foreach ($this->fields as $field => $f) {
                if ($field != 'id') {
                    $fieldName = self::getFieldName($field); 
                    $bindName = self::getBindName($field);
                    $fields[] = "{$fieldName} = {$bindName}";
                }
            }
            $fieldName = self::getFieldName('id');
            $bindName = self::getBindName('id');
            $set = implode(', ', $fields);
            $query = "UPDATE {$tableName} ";
            $query .= "SET {$set} ";
            $query .= "WHERE {$fieldName} = {$bindName} ;";
        } else {
            foreach ($this->fields as $field => $f) {
                if ($field != 'id') {
                    $cols[] = self::getFieldName($field);
                    $binds[] = self::getBindName($field);
                }
            }
            $columns = implode(', ', $cols);
            $bindings = implode(', ', $binds);
            $query = "INSERT INTO {$tableName} ";
            $query .= "({$columns}) VALUES ({$bindings})";
        }
        $ret = null;
        $sth = self::getDb()->prepare($query);
        if ($sth != false)
        {
            foreach ($this->fields as $field => $f) 
            {
                $sth->bindValue(self::getBindName($field),$f['value'],$f['type']); 
            }
            $ret = $sth->execute();
        }
        if(!$ret && self::getDb()->lastErrorCode() != 0 ) {
            openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
            syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] '.self::getDb()->lastErrorMsg().' __ '.$query );
            $error = true;
        } 
        return $ret;
    }
    
    public function free()
    {
        global $error;
        if ($this->fields['iduuid'] != null)
        {
            $field = "iduuid";
            $value = $this->fields['iduuid']['value'];
        }
        else
        {
            $field = "id";
            $value = $this->fields['id']['value'];
        }
        $tableName = self::getTableName();
        $fieldName = self::getFieldName($field);
        $bindName = self::getBindName($field);
        $query = "DELETE FROM {$tableName} ";
        $query .= "WHERE {$fieldName} = {$bindName}";
        $sth = self::getDb()->prepare($query);
        $sth->bindValue($bindName, $value);
        $ret = $sth->execute();
        if(!$ret && self::getDb()->lastErrorCode() != 0 ) {
            openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
            syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] '.self::getDb()->lastErrorMsg().' __ '.$query );
            $error = true;
        } 
        return null;
    }
 
    public function __set($name, $value) {
        if (array_key_exists($name, $this->fields)) {
            $this->fields[$name]['value'] = $value;
        }
    }

    public function __get($name) {
        if (array_key_exists($name, $this->fields)) {
            return $this->fields[$name]['value'];
        }
    }
    
    public function serializeData()
    {
        $serialize = array();
        foreach ( $this->fields as $key => $f) {
            if ($this->bannedfields[$key] == null || ($this->bannedfields[$key] != null && $this->bannedfields[$key] == false))
            {
                $serialize[$key] = $f['value'];
            }
        }
        return $serialize;
    }
}
?>