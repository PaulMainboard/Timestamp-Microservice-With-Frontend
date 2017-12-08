<?php

include "classes/TimeFormatConvertorClass.php";
include "classes/CheckInputClass.php";
include "classes/JSON_ObjClass.php";
include "classes/TimestampDateConvertorClass.php";

class TimestampMicroservice {
    /*
     * Takes a date and fetch the timestamp of that date. It also takes a timestamp and get the date equivalent of that timestamp.
    */
    private $date;
    private $timestamp;

    public function __construct($dateTimestamp = null) {
        if ($dateTimestamp) { // If a timestamp or date was entered as an argument.
            $this->setTimeData($dateTimestamp);
        } else { // No arguments was entered.
            $this->date = null;
            $this->timestamps = null;
        }
    }
    
    public function isTimestamp($dateTimestamp) {
        /*
         * Determine if the parameter is a timestamp;
        */
        if (CheckInput::isDate($dateTimestamp)) { // The parameter is a timestamp
            return true; 
        }
        return false; // The parameter is a date
    }
    
    public function date_has_dashes($date) {
        if ( // If the date format is numerical and has dashes in it. (example: YYYY-M-D or M-D-YYYY)
                CheckInput::include_dashes_year_in_front($date) || 
                CheckInput::include_dashes_year_at_end($date)) {
            return true;   
        }
        return false; // The date does not have any dashes and/or date format is not numerical. 
    } 
    
    public function yearPosition($date) {
        /* 
         * Display the position of the year in a date if
         * the parameter is a numerical date format with dashes.
        */
        
        
        if (CheckInput::include_dashes_year_in_front($date)) {  
            // The date is at the front of the string. (ex: YYYY-MM-DD)
            return "front";
            
        } else if (CheckInput::include_dashes_year_at_end($date)) { 
            // The date is in the front of the string. (ex: MM-DD-YYYY)
            return "end";

        }
        
    }
    
    public function set_time_data_from_timestamp($timestamp) {
        /*Set the timestamp property and convert timestamp to a date formatted string.*/
        
            $this->timestamp = $timestamp;
            $this->date = TimestampDateConvertor::timestamp_to_date($timestamp);
    }
    
    public function set_time_data_from_date($date) {
        /*Set the date property and convert date formatted string into a timestamp.*/
        
        if ($this->date_has_dashes($date)) { 
                $this->date = $date;

        } else { // If the date format is in any other format that does not include dashes.
                    
                    $this->date = CheckInput::does_not_have_dashes($date);     

        }

        // If the date format is M-D-YYYY, bring the year to the front of the string (ex: YYYY-M-D).
        if ($this->yearPosition($date) == "end") { 
                    $this->date = TimeFormatConvertor::format_constant_datetime_input_month($this->date);   
        }

        // Change a string into a DateTime object **
        $this->date =  new DateTime($this->date); 

        // Get the timestamp of the date.
        $this->timestamp = TimestampDateConvertor::date_to_timestamp($this->date);
        $this->date= $this->date->format("m-d-Y"); 

    }
    
    public function setTimeData($dateTimestamp) {
        if ($this->isTimestamp($dateTimestamp)) { //If parameter is a timestamp. 
            $this->set_time_data_from_timestamp($dateTimestamp);
        } else { //If parameter is a date.
            $this->set_time_data_from_date($dateTimestamp);
            
        }
    }
    
    public function get_date() {
        return $this->date;
    }
    
    public function set_date($date) {
        $this->date = $date;
    }
    
    public function get_timestamp() {
        return $this->timestamp;
    }
    
    public function set_timestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
}
