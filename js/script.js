
var input = document.querySelector("#inputArea input[type=text]"); // Timestamp and date input
var inputBtn = document.querySelector("#inputArea button");  
var displayTimestampDate = document.getElementById("dates"); // Display area for the timestamp and date.
let badInput = "false";

function validateInput() { 
    /*
     * Check and see if the information that the user is entering in the input box is valid input that the 
     * site can process.
    */
    
    var inputValue = input.value; // Get the current value in the input box.
    
    // If the date is formatted as: (Nov 23 2018) or (October 9 1998).
    const checkDate1 = /[A-Za-z]{3,9}?\s?[0-9]{1,2}\s[0-9]{2,6}/;
    
    // If the date is formatted as: (2/2/2020) or (2005-8-15).
    const checkDate2 = /^[0-9]{1,4}[\s?\-?\/?][0-9]{1,2}[\s?\-?\/?][0-9]{2,4}$/;
    
    const checkTimestamp = /^\d{1,20}$/;
    
    if (inputValue != "") { // If the input box is not empty, check the value within it.
        
        // If the value within the input box does not match any of the provided regular expressions, it is not a valid date or timestamp.
        if (!isNaN(inputValue) && inputValue.match(checkTimestamp)) {
            console.log("Timestamp");
            badInput = "false";
        } else if (inputValue.match(checkDate1) || inputValue.match(checkDate2)) {
            console.log("Date");
            badInput = "false";
        } else {
            badInput = "true";
        }
    }
}

setInterval(validateInput, 500); // ** Check the input box every two seconds to validate the value within it.   
inputBtn.addEventListener('click', () => {
    if (badInput) {
        window.location.href = "../index.php?date=" + input.value;   
    } else {
        alert("Invalid Input");
    }
});