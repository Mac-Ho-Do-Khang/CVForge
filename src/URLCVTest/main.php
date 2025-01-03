<!DOCTYPE html>
<html>
<head>
<!--Start: Bootstrap install stuff-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!--End-->


</head>
 

<body>
  <!--Start: BODY -->
</header>AAAAAAAA</header>
<?php
    include("..\database_interface.php");
    $url_array = explode("/", $_SERVER["REQUEST_URI"]);
    $cv_id = $url_array[count($url_array) - 1];
    echo "<div>" . $cv_id . "</div>";
    echo "<script>console.log(`". $cv_id ."`); </script>";
    $result = select_cv_detail($cv_id);
    print_mysql_result($result[0]);
    print_mysql_result($result[1]);
    print_mysql_result($result[2]);
    print_mysql_result($result[3]);
  
?>
  <!--End: BODY -->
</body>
</html>