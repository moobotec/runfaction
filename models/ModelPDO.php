<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: ModelPDO.php
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

abstract class ModelPDO {

    private static $pdo;

    protected static function getPDO() {
        if (!isset(self::$pdo)) {
            self::$pdo = new PDO(
                'mysql:dbname=bdTrackRepair;host=127.0.0.1:8120',
                "root",
                "secret"
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        return self::$pdo;
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

    protected static function getBy($field, $value) {
        $tableName = self::getTableName();
        $fieldName = self::getFieldName($field);
        $bindName = self::getBindName($field);
        $q = "SELECT * FROM {$tableName} ";
        $q .= "WHERE {$fieldName} = {$bindName}";
        $sth = self::getPDO()->prepare($q);
        $sth->bindParam($bindName, $value);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $modelName = self::getModelName();
            return new $modelName($data);
        }
        return null;
    }

    public static function getAll() {
        $tableName = self::getTableName();
        $q = "SELECT * FROM {$tableName} ";
        $sth = self::getPDO()->prepare($q);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            $models = array();
            foreach ($data as $d) {
                $modelName = self::getModelName();
                $models[] = new $modelName($d);
            }
            return $models;
        }
        return null;
    }
    
    protected static function getAllBy($field, $value) {
        $tableName = self::getTableName();
        $fieldName = self::getFieldName($field);
        $bindName = self::getBindName($field);
        $q = "SELECT * FROM {$tableName} ";
        $q .= "WHERE {$fieldName} = {$bindName}";
        $sth = self::getPDO()->prepare($q);
        $sth->bindValue($bindName, $value);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            $models = array();
            foreach ($data as $d) {
                $modelName = self::getModelName();
                $models[] = new $modelName($d);
            }
            return $models;
        }
        return null;
    }

    protected static function serializeResponse($data)
    {
        $messages = array();
        $errors = array();
        $return = array();
        $return["msg"] = null;
        $return["error"] = null;
        $return[self::getNameOne()] = null;        
        if ($data["error"] != null )
        {
            foreach ($data["error"] as &$error) {
                $code = self::getNameNotification()::findByColumn('id',$error);
                if ($code != false)
                {
                    if ($code->type == 'msg') array_push($messages,$code);
                    if ($code->type == 'error') array_push($errors,$code);
                }
            }
        }
        if (sizeof($messages) > 0)
        {
            $return["msg"] = $messages;
        }
        if (sizeof($errors) > 0)
        {
            $return["error"] = $errors;
        }
        if ($data[self::getNameOne()] != null)
        {
            $return[self::getNameOne()] = $data[self::getNameOne()]->serializeData();
        }
        else if ($data[self::getNameList()] != null)
        {
            $return[self::getNameList()] = $data[self::getNameList()]->serializeData();
        }
        return $return;
    }

    private $fields = array();
    private $bannedfields = array();

    public function __construct($schema, $data = false) {
        $this->fields['id'] = array('value' => null, 'type' => PDO::PARAM_INT);
        foreach ($schema as $name => $type) {
            $this->fields[$name] = array('value' => null, 'type' => $type);
        }
        foreach ($bannedSchema as &$field) {
            $this->bannedfields[$field] = true;
        }
        if ($data) {
            foreach ($data as $column => $value) {
                $prop = self::getPropertyName($column);
                $this->fields[$prop]['value'] = $value;
            }
        }
    }

    public function save() {
        $tableName = self::getTableName();
        if ($this->fields['id']['value'] != null) {
            foreach ($this->fields as $field => $f) {
                if ($field != 'id' && $f['value'] != null) {
                    $fieldName = self::getFieldName($field); 
                    $bindName = self::getBindName($field);
                    $fields[] = "{$fieldName} = {$bindName}";
                }
            }
            $fieldName = self::getFieldName('id');
            $bindName = self::getBindName('id');
            $set = implode(', ', $fields);
            $q = "UPDATE {$tableName} ";
            $q .= "SET {$set} ";
            $q .= "WHERE {$fieldName} = {$bindName}";
        } else {
            foreach ($this->fields as $field => $f) {
                if ($field != 'id' && $f['value'] != null) {
                    $cols[] = self::getFieldName($field);
                    $binds[] = self::getBindName($field);
                }
            }
            $columns = implode(', ', $cols);
            $bindings = implode(', ', $binds);
            $q = "INSERT INTO {$tableName} ";
            $q .= "({$columns}) VALUES ({$binds})";
        }
        $sth = ModelPDO::getPDO()->prepare($q);
        foreach ($this->fields as $field => $f) {
            $value = $f['value'];
            if ($f['value'] != null) {
                $sth->bindValue(self::getBindName($field), $f['value'], $f['type']); 
            }
        }
        //echo "{$sth->queryString}\n";
        return $sth->execute();
    }
    
    public function free()
    {
        $field = "iduuid";
        $value = $this->fields['iduuid']['value'];
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