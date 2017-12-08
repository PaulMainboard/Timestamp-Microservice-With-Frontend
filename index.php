<?php

include "classes/TimestampMicroserviceClass.php";

// Make the date parameter case insensitive.
$dateParameter = array_change_key_case($_GET, CASE_LOWER); 

if (CheckInput::have_parameter($dateParameter, 'date')) { // If date parameter are entered in the URL.    
    $dateTimestamp = new TimestampMicroservice($dateParameter['date']);
} else { // If the URL do not have any parameters.
    $dateTimestamp = new TimestampMicroservice();
}

// Convert date and timestamp into JSON format;
$date_json_obj = new json_obj(/*$date*/ $dateTimestamp->get_date(), /*$timestamp*/ $dateTimestamp->get_timestamp());
$date_json_display = $date_json_obj->encode_to_json(); 

// Print date ** FOR TESTING PURPOSES **
//echo $date_json_display;

$date = $dateTimestamp->get_date();
$timestamp = $dateTimestamp->get_timestamp();
header("Location: http://localhost/Portfolio/Timestamp%20Microservice/Timestamp-Microservice///pages/page.php?date=$date&timestamp=$timestamp");
die();

