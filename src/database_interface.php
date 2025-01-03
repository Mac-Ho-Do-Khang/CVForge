<?php 
	$servername = "localhost";
	$db_username = "root";
	$db_password = "password";
	$db_name = "ProjectDatabase";

	// Create connection
	$conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	} else {
		echo '<script>console.log("Connected successfully!"); </script>';
	}

	function select_editor_cv($user_id){
		global $conn;
		
		$sql = "SELECT cv_id
				FROM Access
				WHERE user_id = ? AND level = 1";

		$result = $conn->execute_query($sql, [$name, $pass, $lev]);

		if (!check_sql_result($result,
		"Select CV for user successfully!",
		"Error in select CV for user: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		return 0;
	}

	function insert_cv($addresses, $phones, $degrees, $certificates){
		global $conn, $db_name;

		$sql = "INSERT INTO CV VALUES (NULL); \nSET @NewId = 0; \nSELECT MAX(id) INTO @NewId FROM CV;\n";
		{$result = $conn->multi_query($sql);}
		while ($conn -> next_result());

		$sql = "INSERT INTO Address VALUES ";
		for ($i = 0; $i < count($addresses); $i++){
			$sql =  $sql . "(@NewId, ?)";
			if ($i != count($addresses) - 1)
				$sql .= ",";
		}
		$result = $conn->execute_query($sql, $addresses);
		if (!check_sql_result($result,
		"Add all addresses successfully!",
		"Error in insert addresses: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;
		 
		$sql = "INSERT INTO Phone VALUES ";
		for ($i = 0; $i < count($phones); $i++){
			$sql =  $sql . "(@NewId, ?)";
			if ($i != count($phones) - 1)
				$sql .= ",";
		}
		$result = $conn->execute_query($sql, $phones);
		if (!check_sql_result($result,
		"Add all phone numbers successfully!",
		"Error in insert phone numbers: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		$sql = "INSERT INTO Degree VALUES ";
		$degrees_para = [];
		for ($i = 0; $i < count($degrees); $i++){
			$sql =  $sql . "(@NewId, ?, ?)";
			if ($i != count($degrees) - 1)
				$sql .= ",";
			$degrees_para = array_merge($degrees_para, $degrees[$i]);
		}
		$result = $conn->execute_query($sql, $degrees_para);
		if (!check_sql_result($result,
		"Add all degrees successfully!",
		"Error in insert degrees: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		$sql = "INSERT INTO Certificate VALUES";
		$certificates_para = [];
		for ($i = 0; $i < count($certificates); $i++){
			$sql =  $sql . "(@NewId, ?, ?)";
			if ($i != count($certificates) - 1)
				$sql .= ",";
			else
				$sql .= "; ";
			$certificates_para = array_merge($certificates_para, $certificates[$i]);
		}
		$result = $conn->execute_query($sql, $certificates_para);
		if (!check_sql_result($result,
		"Add all certificates successfully!",
		"Error in insert certificates: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		return 0;
	}

	function select_cv_detail($cv_id){
		global $conn;
		
		$sql = "SELECT id
				FROM CV
				WHERE id = ?";

		$result = $conn->execute_query($sql, [$cv_id]);
		if ($result) {
			if (mysqli_num_rows($result) > 0){
				echo '<script>console.log("Select CV for user successfully!"); </script>';
			} else {
				echo '<script>console.log("CV_id does not exist"); </script>';
				return 2;
			}
		} else {
		  	echo "<script>console.log('Error in insert certificates: " . $sql . "<br>" . mysqli_error($conn) . ";</script>";
			return 1;
		}

		$sql = "SELECT * FROM Address WHERE cv_id = ?";
		$addresses = $conn->execute_query($sql, [$cv_id]);
		if (!check_sql_result($addresses,
		"Select CV addresses successfully!",
		"Error in Select CV addresses: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		$sql = "SELECT * FROM Phone WHERE cv_id = ?";
		$phones = $conn->execute_query($sql, [$cv_id]);
		if (!check_sql_result($phones,
		"Select CV phone numbers successfully!",
		"Error in Select CV phone numbers: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		$sql = "SELECT * FROM Degree WHERE cv_id = ?";
		$degrees = $conn->execute_query($sql, [$cv_id]);
		if (!check_sql_result($degrees,
		"Select CV degrees successfully!",
		"Error in Select CV degrees: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		$sql = "SELECT * FROM Certificate WHERE cv_id = ?";
		$certificates = $conn->execute_query($sql, [$cv_id]);
		if (!check_sql_result($certificates,
		"Select CV certificates successfully!",
		"Error in Select CV certificates: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		return [$addresses, $phones, $degrees, $certificates];
	}

	

	function check_sql_result($result, $success_message, $error_message){
		if ($result) {
			echo "<script>console.log(`". $success_message ."`); </script>";
		  } else {
			echo "<script>console.log(`". $error_message . "`);</script>";
			return false;
		}
		return true;
	}

	function print_mysql_result($input, $label = ""){
		if (mysqli_num_rows($input) > 0) {
			// output data of each row
			echo "<script>console.log(`";
			if ($label != "")
				echo $label . ": ";
			while($row = $input->fetch_row()) {
			  echo implode(" - ", $row) . "\n";
			}
			echo "`);</script>";
		  } else {
			echo "<script>console.log(`0 results`);</script>";
		}
	}


?>