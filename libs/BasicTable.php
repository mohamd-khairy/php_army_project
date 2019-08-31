<?php

class BasicTable {

    static protected $table_name;
    public $primary_key;
    public $fields = array();

    public function __construct() {
        $db = DatabaseManager::getInstance();
        $this->dbh = $db->dbh;
    }

    public function delete($primary_key) {

        return $this->dbh->query("delete from " . static::$table_name . " where {$this->primary_key}=$primary_key");
    }

    protected function getFieldsAsString() {
        $sqlStatment = array();
        foreach ($this->fields as $field) {
            $sqlStatment[] = $field . "='" . $this->$field . "'";
        }
        return implode(',', $sqlStatment);
    }

    public function insert() {

        $this->dbh->exec("insert into " . static::$table_name . " set " . $this->getFieldsAsString());
        return $this->dbh->lastInsertId();
    }

    public function insertCompose() {
        return $this->dbh->exec("insert into " . static::$table_name . " set " . $this->getFieldsAsString());
    }

    public function update($primary_key) {
        return $this->dbh->exec("update " . static::$table_name . " set " . $this->getFieldsAsString() . " where " . $this->primary_key . "=" . $primary_key);
    }

    static public function getAll($offset = 0) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " limit $offset," . PER_PAGE_COUNT)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData() {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDataby_mon_current() {
        if (!isset($_SESSION['mon_current'])) {
            $_SESSION['mon_current'] = 0;
        }
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where mon_current='{$_SESSION['mon_current']}'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDataby_special_mon_current($mon_current) {

        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where mon_current='{$mon_current}'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDataby_mon_current_table_colm_and_id($coulm, $id) {
        if (!isset($_SESSION['mon_current'])) {
            $_SESSION['mon_current'] = 0;
        }
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where  mon_current='{$_SESSION['mon_current']}' and " . "$coulm" . "=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getAllDataby_id( $colm,$id) {
       
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where " . "$colm" . "=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData_by_order($coulm, $type) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " ORDER BY {$coulm} {$type} ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id($id) {
        $m = $this->dbh->query("select * from " . static::$table_name . " where $this->primary_key =$id")->fetchAll(PDO::FETCH_CLASS, get_called_class());
        return $m[0];
    }

    static public function getCount() {
        if (!isset($_SESSION['mon_current'])) {
            $_SESSION['mon_current'] = 0;
        }
        $n = DatabaseManager::getInstance()->dbh->query("select count(*) as count from " . static::$table_name . " where  mon_current='{$_SESSION['mon_current']}'")->fetchAll();
        return $n[0];
    }

    static public function get_order_sum($order) {
        if (!isset($_SESSION['mon_current'])) {
            $_SESSION['mon_current'] = 0;
        }
        $n = DatabaseManager::getInstance()->dbh->query("select sum($order) as sum from " . static::$table_name . " where  mon_current='{$_SESSION['mon_current']}'")->fetchAll();
        return $n[0];
    }
    
     

    

    static public function search($key, $value) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where $key like '%$value%'")->fetchAll(PDO::FETCH_ASSOC);
    }

}
