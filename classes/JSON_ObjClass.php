<?php
/*
 * Create a object that will be converted into JSON format.
*/
class json_obj {
    public $date;
    public $timestamp;
    
    public function __construct($date=null, $timestamp=null) {
        $this->date = $date;
        $this->timestamp = $timestamp;
    }
    
    public function encode_to_json() {
        /*
         * Encode this object into JSON format.
        */
        return json_encode($this);
    }
}