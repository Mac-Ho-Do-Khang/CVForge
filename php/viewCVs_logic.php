<?php 
    require "database_interface.php";

    //Initializing data;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if ($_GET["action"] == "accessCheck" && isset($_GET["cvid"])){
            $cv_details_data = select_cv_detail($_GET["cvid"]);
            if ($cv_details_data != "2"){
                $cv_id = $_GET["cvid"];
                $user_id = $_SESSION["user_id"];
                $access_level = $cv_details_data["access_level"];
                if ($cv_details_data["owner"] != $user_id){
                    switch ($access_level){
                        case 1:
                            echo "AccessDeny";
                            break;
                        case 2:
                            echo true;
                            break;
                        case 3:
                            $allower = $cv_details_data["allower"];
                            $result = array_filter($allower, function ($ele){global $user_id; return $ele["id"] == $user_id;});
                            echo (count($result) > 0) ? true : "AccessDeny";
                            break;
                    }
                } else {
                    echo true;
                }
            } else {
                echo "NoCV";
            }
        }
        else if ($_GET["action"] == "init" && isset($_GET["cvid"])){
            $cv_details_data = select_cv_detail($_GET["cvid"]);
            echo json_encode($cv_details_data);
        }
    }
?>