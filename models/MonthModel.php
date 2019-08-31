<?php

class MonthModel extends basictable {

    static protected $table_name = "month";
    public $primary_key = "mon_id";
    public $fields = array('mon_current', 'mon_date', 'mon_askry', 'mon_zapt', 'mon_role');
    public $mon_id;
    public $mon_role;
    public $mon_zapt;
    public $mon_askry;
    public $mon_date;
    public $mon_current;

}
