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
<?php
    include("..\database_interface.php");
    insert_cv(["200 WoodBark Street", "534 Random Streey"],["0228889999", "12516247355"],
    [["Phd Science degrees", "0123126184534"], ["Phd Literature degrees", "1361235743574"]],[["Bike certificates", "999999999123"], ["Random Cert", "1523623434"]]);

  function test(){
      global $conn;
      
      $sql_sub = "SET @Var = 'asdqweqw';";
      $sql = "INSERT INTO Address VALUES (1, @Var);";
      
      $sql_stmt = $conn->prepare($sql);
      $sql_stmt0 = $conn->prepare($sql_sub);
      
      $result = $sql_stmt0->execute();
      $result = $sql_stmt->execute();
      if ($result) {
        echo "<script>console.log(`". "Successful" ."`); </script>";
        } else {
        echo "<script>console.log(`". "Failure" . "`);</script>";
        return false;
      }
      return true;
  }
  
?>
  <!--End: BODY -->
</body>
</html>