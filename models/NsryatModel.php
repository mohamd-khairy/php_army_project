<?php

class NsryatModel extends basictable {

    static protected $table_name = "nsryat";
    public $primary_key = "nsr_id";
    public $fields = array('mon_current', 'nsr_type', 'nsr_count', 'nsr_cost', 'nsr_date');
    public $nsr_id;
    public $nsr_type;
    public $nsr_count;
    public $nsr_cost;
    public $nsr_date;
    public $mon_current;

}
