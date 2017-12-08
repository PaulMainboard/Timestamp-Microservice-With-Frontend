<?php

class TimestampDateConvertor {
    /*
     * Handle the convertion between a date and a timestamp. 
    */
    
    public static function timestamp_to_date($timestamp, $format='m-d-Y') {
        /*
         * Convert a timestamp into a date object. 
         * The format parameter of this method is 
         * used to give the option of formatting 
         * the returned date object if needed.
        */
        return date($format, $timestamp);
    }   
    
    public static function date_to_timestamp($date) {
        /*
         * Convert a date object into a timestamp.
        */
        return $date->getTimestamp();
    }
}