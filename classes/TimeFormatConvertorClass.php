<?php

class TimeFormatConvertor {
    
    public static function format_constant_datetime_input_month($input) {
        /*
         * Format a string by putting positioning the year as the first
         * item in a date formated as Month-Day-Year. 
         * Returns the Date as a string with the year, day, and month 
         * seperated by dashes.
        */
        $input = str_replace("-", " ", $input);
//        $input = str_replace("/", " ", $input);
        $input = explode(" ", $input);
        $year = array_pop($input);
        array_unshift($input, $year);
        return implode("-", $input);
    }
}