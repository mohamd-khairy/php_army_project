<?php

class AsakrModel extends basictable {

    static protected $table_name = "asakr";
    public $primary_key = "a_id";
    public $fields = array('a_name', 'a_degree', 'a_mobile', 'a_address', 'a_date');
    public $a_id;
    public $a_name;
    public $a_degree;
    public $a_mobile;
    public $a_address;
    public $a_date;
    

 

}
