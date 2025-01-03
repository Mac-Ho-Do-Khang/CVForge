<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page not found</title>
</head>

<body>

    <script>
        alert("<?php
        if (isset($_GET["errMessage"])){
            switch ($_GET["errMessage"]){
                case "noCV":
                    echo "No such CV exist.";
                    break;
                case "accessDeny":
                    echo "Access deny.";
                    break;
                case "pageNotFound":
                    echo "404 - PAGE NOT FOUND";
                    break;
                default:
                    echo "404 - PAGE NOT FOUND";
                    break;
            }
        } else {
            echo "404 - PAGE NOT FOUND";
        }
        ?>");
    </script>
</body>

</html>