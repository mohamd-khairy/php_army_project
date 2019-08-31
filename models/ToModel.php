<?php

class ToModel extends basictable {

    static protected $table_name = "too";
    public $primary_key = "to_id";
    public $fields = array('mon_current','to_special', 'to_goods', 'to_nsryat', 'to_ms7obat','to_other', 'to_date');
    public $to_id;
    public $to_goods;
    public $to_nsryat;
    public $to_ms7obat;
    public $to_special;
    public $to_other;
    public $to_date;
    public $mon_current;

    static public function get_special_mon_current_sum($mon_current) {
        $n = DatabaseManager::getInstance()->dbh->query("select to_goods,to_special,to_nsryat,to_ms7obat,to_other from too where  mon_current='{$mon_current}'")->fetchAll();
        return $n[0];
    }
}
