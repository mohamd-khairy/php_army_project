<?php

class ZpatModel extends basictable {

    static protected $table_name = "zpat";
    public $primary_key = "z_id";
    public $fields = array('z_name', 'z_degree', 'z_mobile', 'z_address', 'z_date');
    public $z_id;
    public $z_name;
    public $z_degree;
    public $z_mobile;
    public $z_address;
    public $z_date;

    
}
