<?php 
    include 'database_interface.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the raw POST data
        $rawData = file_get_contents('php://input');
    
        // Decode JSON data into a PHP array
        $data = json_decode($rawData, true);
        //echo var_dump($rawData);
        // Check if JSON decoding was successful
        if (json_last_error() === JSON_ERROR_NONE) {
            if ($data["id"] == ""){
                // Access the data
                insert_cv($data);
        
                // Respond with the received data
                echo "Successfully add CV to database!";
            } else {
                edit_cv($data);

                echo "Successfully edit CV.";
            }
        } else {
            echo "Invalid JSON received.";
        }
    } else if  ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET["cvid"])){
            $data = select_cv_detail($_GET["cvid"]);
            echo json_encode($data);
        }
    } else {
        echo "No POST request received.";
    }
?>