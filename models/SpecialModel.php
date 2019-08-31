<?php

class SpecialModel extends basictable {

    static protected $table_name = "fwater_special";
    public $primary_key = "spc_id";
    public $fields = array('mon_current', 'spc_count', 'spc_cost', 'spc_type', 'z_name', 'spc_date');
    public $spc_id;
    public $spc_count;
    public $spc_cost;
    public $spc_type;
    public $z_name;
    public $spc_date;
    public $mon_current;

    static public function get_All_data_by_mon_current_and_date($date) {
        if (!isset($_SESSION['mon_current'])) {
            $_SESSION['mon_current'] = 0;
        }
        return DatabaseManager::getInstance()->dbh->query("select * from fwater_special where mon_current='{$_SESSION['mon_current']}'"
                        . "and spc_date = '$date' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_order_by_spc_mon_sum($mon_current, $val) {

        return DatabaseManager::getInstance()->dbh->query("select  sum(spc_cost) as sum  from fwater_special where mon_current='{$mon_current}' and z_name = '{$val}'")->fetchAll(PDO::FETCH_ASSOC);
    }

}
