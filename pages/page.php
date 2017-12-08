<?php
    include "../classes/CheckInputClass.php";
if (CheckInput::have_parameter($_GET, 'date') && CheckInput::have_parameter($_GET, 'timestamp')) {
    $date = $_GET['date']; 
    $timestamp = $_GET['timestamp']; 
} else {
    $date = ""; 
    $timestamp = "";
}

?>

<html>
    <head>
        <title>Timestamp-Microservice</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div id="container">
            <header>
                <h1>Timestamp Microservice</h1>
                <div id="directions"><a href="#">Click Here For Directions</a></div>
            </header>
            <div id="content">
                <div id="inputArea">
                    <input type="text">
                    <button>Enter</button>
                </div>
                <div id="dates">
                    <p><?php echo "Timestamp: " . $timestamp;?></p>
                    <p><?php echo "Date: " . $date ; ?></p>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>