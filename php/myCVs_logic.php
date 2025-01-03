<?php
    require "database_interface.php";

    //Initializing data;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if ($_GET["action"] == "init"){
            $cv_data = [];
            $cv_id_data = select_editor_cv($_SESSION["user_id"]);
            if (count($cv_id_data)> 0){
                foreach ($cv_id_data as $cv_id){
                    $cv_details_data = select_cv_detail($cv_id['id']);
                    array_push($cv_data, $cv_details_data);
                }
            }
            echo json_encode($cv_data);
        } else if ($_GET["action"] == "delete" && isset($_GET["cvid"])){
            delete_cv($_GET["cvid"]);
            echo "Delete CV successfully";
        }
    }
?>