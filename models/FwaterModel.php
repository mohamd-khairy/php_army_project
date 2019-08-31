<?php

class FwaterModel extends basictable {

    static protected $table_name = "fwater";
    public $primary_key = "fw_id";
    public $fields = array('mon_current', 'fw_askry', 'fw_date');
    public $fw_id;
    public $fw_askry;
    public $fw_date;
    public $mon_current;

}
