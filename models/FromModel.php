<?php

class FromModel extends basictable {

    static protected $table_name = "froom";
    public $primary_key = "from_id";
    public $fields = array('mon_current', 'from_goods', 'from_fwater','from_other', 'from_date');
    public $from_id;
    public $from_goods;
    public $from_fwater;
    public $from_other;
    public $from_date;
    public $mon_current;

      static public function get_special_mon_current_sum($mon_current) {

        $n = DatabaseManager::getInstance()->dbh->query("select from_goods,from_fwater,from_other from froom where  mon_current='{$mon_current}'")->fetchAll();
        return $n[0];
    }
}
