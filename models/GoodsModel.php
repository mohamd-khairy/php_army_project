<?php

class GoodsModel extends basictable {

    static protected $table_name = "goods";
    public $primary_key = "go_id";
    public $fields = array('mon_current', 'go_type', 'go_count', 'go_cost', 'go_date');
    public $go_id;
    public $go_type;
    public $go_count;
    public $go_cost;
    public $go_date;
    public $mon_current;

    static public function get_goods_last_month_by_mon_current() {
        if (!isset($_SESSION['mon_current'])) {
            $last = 0;
        } else {
            $date = explode('-', $_SESSION['mon_current']);
            $d = "0".($date[0] - 1);
            if ($d == 00) {
                $d = 12;
            }
            $last = $d . "-" . $date[1];//
        }
        return DatabaseManager::getInstance()->dbh->query("select to_goods as sum from too where mon_current='{$last}'")->fetchAll(PDO::FETCH_ASSOC);
    }

}
