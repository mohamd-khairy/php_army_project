<?php

class Ms7obatModel extends basictable {

    static protected $table_name = "ms7obat";
    public $primary_key = "ms7_id";
    public $fields = array('z_name', 'ms7_cost', 'ms7_date', 'mon_current');
    public $ms7_id;
    public $z_name;
    public $ms7_cost;
    public $ms7_date;
    public $mon_current;

    static public function get_All_date_by_mon_current() {
        if (!isset($_SESSION['mon_current'])) {
            $_SESSION['mon_current'] = 0;
        }
        return DatabaseManager::getInstance()->dbh->query("select ms7_date from ms7obat where mon_current='{$_SESSION['mon_current']}'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_All_data_by_mon_current_and_date($date, $z) {
        if (!isset($_SESSION['mon_current'])) {
            $_SESSION['mon_current'] = 0;
        }
        return DatabaseManager::getInstance()->dbh->query("select * from ms7obat where mon_current='{$_SESSION['mon_current']}'"
                        . "and ms7_date = '$date' and z_name='$z'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_All_data_by_special_mon_current_and_date($date, $z, $mon_current) {

        return DatabaseManager::getInstance()->dbh->query("select * from ms7obat where mon_current='{$mon_current}'"
                        . "and ms7_date = '$date' and z_name='$z'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_All_date_by_mon_current_and_any_colm($colm, $val) {
        if (!isset($_SESSION['mon_current'])) {
            $_SESSION['mon_current'] = 0;
        }
        return DatabaseManager::getInstance()->dbh->query("select  sum(ms7_cost) as sum , count(ms7_cost) as count from ms7obat where mon_current='{$_SESSION['mon_current']}' and {$colm} = '{$val}'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_All_date_by_special_mon_current_and_any_colm($colm, $val, $mon_current) {

        return DatabaseManager::getInstance()->dbh->query("select  sum(ms7_cost) as sum , count(ms7_cost) as count from ms7obat where mon_current='{$mon_current}' and {$colm} = '{$val}'")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_ms7($date, $z) {

        return $this->dbh->query("delete from ms7obat where ms7_date= '$date' and z_name='$z' ");
    }

}
