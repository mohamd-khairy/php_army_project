<?php

class DetailsModel extends basictable {

    static protected $table_name = "fwater_details";
    public $primary_key = "det_id";
    public $fields = array('mon_current', 'det_count', 'det_cost', 'det_type','fw_id');
    public $det_id;
    public $det_count;
    public $det_cost;
    public $det_type;
    public $mon_current;
    public $fw_id;
    
    
}
