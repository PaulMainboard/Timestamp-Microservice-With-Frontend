
let input = document.querySelector("#inputArea input[type=text]"); // Timestamp and date input
let inputBtn = document.querySelector("#inputArea button");  
let displayTimestampDate = document.getElementById("dates"); // Display area for the timestamp and date.
let dateDisplay = document.getElementById("date");
let timestampDisplay = document.getElementById("timestamp");
let directions = document.getElementById("directions");
let closeDirections = document.querySelector(".close");
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

/* Get requested date and timestamp*/
function getDates() { 
    if (badInput) { // If the user enter a valid date or timestamp.
        // Get date and timestamp results from the program.
        let results;
        let request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                results = JSON.parse(this.responseText);
                dateDisplay.textContent = "Date: " + results['date'];
                timestampDisplay.textContent = "Timestamp: " + results['timestamp'];
            }
        }
        request.open("GET", "TimestampMicroservice.php?date=" + input.value, true);
        request.send();
    } else { // If the entered an invalid date or timestamp.
        alert("Invalid Input");
    }
}

//setInterval(validateInput, 500); // ** Check the input box every two seconds to validate the value within it.

// If the user press the Enter/Return button while focused of the text inputbox.
input.addEventListener('keyup', (e) => { 
    e.preventDefault();
    if (e.keyCode === 13) {
        getDates();
    }
});
inputBtn.addEventListener('click',getDates); // If the enter button is press.

// Display site instructions when direction link is clicked.
function deselect(e) {
    $('.pop').slideFadeToggle(function() {
        try {
            e.removeClass('selected');   
        } catch (error) {
            e.classList.remove('selected');
        }
    });
}

$.fn.slideFadeToggle = function(easing, callback) {
    return this.animate(
        { opacity: 'toggle', height: 'toggle'},
        'fast',
        easing,
        callback
        );
}

directions.addEventListener('click', () => {
    if ($(this).hasClass('selected')) {
        deselect($(this));
    } else {
        $(this).addClass('selected');
        $('.pop').slideFadeToggle();
    }
    return false;
});


closeDirections.addEventListener('click', () => {
    deselect(directions);
    return false;
});

console.log(closeDirections);