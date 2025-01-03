<?php
if (session_status() != PHP_SESSION_ACTIVE) 
	session_start();

	$debug = false;

	$servername = "localhost";
	$db_username = "newuser";
	$db_password = "12345678";
	$db_name = "ProjectDatabase";

	// Create connection
	$conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

	// Check connection
	if (!$conn) {
	  	die("Connection failed: " . mysqli_connect_error());
	} else if ($debug) {
		echo '<script>console.log("Connected successfully!"); </script>';
	}

	function authenticate_user($username, $password){
		global $conn;
		$sql = "SELECT email, id FROM User WHERE username = ? AND password = ?";
		$result = $conn->execute_query($sql, [$username, $password]);
		if ($result) {
			if (mysqli_num_rows($result) > 0){
				session_start();
				$_SESSION['user'] = "jobseeker";
				$row = $result->fetch_row();
				$_SESSION['email'] = $row[0];
				$_SESSION['user_id'] = $row[1];

				echo '<script>console.log("User authenticated successfully!"); </script>';
			} else {
				echo '<script>console.log("User authentication failed!"); </script>';
				return false;
			}
		}
		return true;
	}

	function add_account($username, $email, $password, $role){
		global $conn;
		$sql = "INSERT INTO User(username, email, password) VALUES (?, ?, ?)";
		$result = $conn->execute_query($sql, [$username, $email, $password]);
	}

	function insert_cv($data){
		global $conn, $db_name;
		
		//Insert CV
		$sql = "INSERT INTO CV(title, name, job, email, introduction, other, ref_email, ref_phone, color, password, access_level, owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$result = $conn->execute_query($sql, [$data["title"], $data["name"], $data["job"], $data["email"],
		 $data["introduction"], $data["other"], $data["ref_email"], $data["ref_phone"], $data["color"], $data["password"], $data["access_level"], $_SESSION["user_id"]]);
		 if (!check_sql_result($result,
		"Add new CV successfully!",
		"Error in insert CV: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;
		
		//Add new variable
		$result = $conn->execute_query("SET @NewId = 0");
		$result = $conn->execute_query("SELECT MAX(id) INTO @NewId FROM CV");

		//Insert phone
		$phone = $data["phone"];
		if (insert_cv_component($phone, "phone") == 1) return 1;

		//Insert address
		$address = $data["address"];
		if (insert_cv_component($address, "address") == 1) return 1;
		
		//Insert skill
		$skill = $data["skill"];
		if (insert_cv_component($skill, "skill") == 1) return 1;

		//Insert education
		$education = $data["education"];
		if (insert_cv_component($education, "education") == 1) return 1;

		//Insert Experience
		$experience = $data["experience"];
		if (insert_cv_component($experience, "experience") == 1) return 1;

		//Insert allower if access level = 3 (Specified)
		if ($data["access_level"] == 3){
			$allower = $data["allower"];
			if (count($allower) > 0){
				$allower_para = [];
				$first = true;
				$sql = "INSERT INTO Allow VALUES";
				
				for ($i = 0; $i < count($allower); $i++){
					$ele = $allower[$i];
					$result = $conn->execute_query("SELECT id FROM User WHERE email = ?", [$ele]);
					if ($result){
						if (mysqli_num_rows($result) > 0){
							$row = $result->fetch_row();
							if ($first){
								$sql .= "(?, @NewId)";
								$first = false;
							}else {
								$sql .= ", (?, @NewId)";
							}
							$allower_para = array_merge($allower_para, $row);
						}	
					}
				}
				$result = $conn->execute_query($sql, $allower_para);
				if (!check_sql_result($result,
				"Add all allower's access successfully!",
				"Error in insert llower's access: " . $sql . "<br>" . mysqli_error($conn)))
					return 1;
			}
		}
		return 0;
	}

	function insert_cv_component($data, $table_name){
		global $conn, $db_name;

		if (count($data) > 0){
			//Make base sql query
			$sql = "INSERT INTO ". $table_name . " VALUES ";
			
			//Make sql for VALUES clause
			$subsql = "(@NewId";
			for ($i = 0; $i < count($data[0]); $i++)
				$subsql .= ", ?";
			$subsql .= ")";

			//Construct full query.
			$data_para = [];
			for ($i = 0; $i < count($data); $i++){
				$ele = $data[$i];
				$sql =  $sql . $subsql;
				if ($i != count($data) - 1)
					$sql .= ",";
				$data_para = array_merge($data_para, array_values($ele));
			}

			$result = $conn->execute_query($sql, $data_para);
			if (!check_sql_result($result,
			"Add all ". $table_name ." successfully!",
			"Error in insert ". $table_name. ": " . $sql . "<br>" . mysqli_error($conn)))
				return 1;
		}
		return 0;
	}

	function edit_cv($data){
		global $conn, $db_name;
		
		$cvid = $data["id"];
		//Insert CV
		$sql = "UPDATE CV SET title = ?, name = ?, job = ?, email = ?, introduction = ?, other = ?, ref_email = ?, ref_phone = ?, color = ?, password = ?, access_level = ?, owner = ? WHERE id = ?";
		$result = $conn->execute_query($sql, [$data["title"], $data["name"], $data["job"], $data["email"],
		 $data["introduction"], $data["other"], $data["ref_email"], $data["ref_phone"], $data["color"], $data["password"], $data["access_level"], $_SESSION["user_id"], $cvid]);
		 if (!check_sql_result($result,
		"Edit CV successfully!",
		"Error in Edit CV: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		//Setup variable
		$result = $conn->execute_query("SET @NewId = ?", [$cvid]);
		
		//Edit phone
		$phone = $data["phone"];
		if (edit_cv_component($cvid, $phone, "phone") == 1) return 1;

		//Edit address
		$address = $data["address"];
		if (edit_cv_component($cvid, $address, "address") == 1) return 1;
		
		//Edit skill
		$skill = $data["skill"];
		if (edit_cv_component($cvid, $skill, "skill") == 1) return 1;

		//Edit education
		$education = $data["education"];
		if (edit_cv_component($cvid, $education, "education") == 1) return 1;

		//Edit Experience
		$experience = $data["experience"];
		if (edit_cv_component($cvid, $experience, "experience") == 1) return 1;

		//Edit allower
		if (delete_cv_component($cvid, "allow") == 1) return 1;
		if ($data["access_level"] == 3){
			$allower = $data["allower"];
			if (count($allower) > 0){
				$allower_para = [];
				$first = true;
				$sql = "INSERT INTO Allow VALUES";
				
				for ($i = 0; $i < count($allower); $i++){
					$ele = $allower[$i];
					$result = $conn->execute_query("SELECT id FROM User WHERE email = ?", [$ele]);
					if ($result){
						if (mysqli_num_rows($result) > 0){
							$row = $result->fetch_row();
							if ($first){
								$sql .= "(?, @NewId)";
								$first = false;
							}else {
								$sql .= ", (?, @NewId)";
							}
							$allower_para = array_merge($allower_para, $row);
						}	
					}
				}
				$result = $conn->execute_query($sql, $allower_para);
				if (!check_sql_result($result,
				"Add all allower's access successfully!",
				"Error in insert llower's access: " . $sql . "<br>" . mysqli_error($conn)))
					return 1;
			}
		}
		return 0;
	}

	function edit_cv_component($cvid, $data, $table_name){
		global $conn, $db_name;

		//Delete data from the cv first
		if (delete_cv_component($cvid, $table_name) == 1){
			return 1;
		};
		
		//Insert data
		if (insert_cv_component($data, $table_name) == 1){
			return 1;
		};
	}

	function delete_cv($cvid){
		global $conn, $db_name;

		$sql = "DELETE FROM CV WHERE id = ?";
		$result = $conn->execute_query($sql, [$cvid]);
		if (!check_sql_result($result,
		"Delete CV successfully!",
		"Error in delete CV info from<br>" . mysqli_error($conn)))
			return 1;

		if (delete_cv_component($cvid, "phone") == 1) return 1;

		if (delete_cv_component($cvid, "address") == 1) return 1;

		if (delete_cv_component($cvid, "skill") == 1) return 1;

		if (delete_cv_component($cvid, "education") == 1) return 1;

		if (delete_cv_component($cvid, "experience") == 1) return 1;

		if (delete_cv_component($cvid, "allow") == 1) return 1;
		return 0;
	}

	function delete_cv_component($cvid, $table_name){
		global $conn, $db_name;

		$sql = "DELETE FROM ". $table_name . " WHERE cv_id = ?";
	
		$result = $conn->execute_query($sql, [$cvid]);
		if (!check_sql_result($result,
		"Delete CV info from ". $table_name ." successfully!",
		"Error in delete CV info from". $table_name. ": " . $sql . "<br>" . mysqli_error($conn)))
			return 1;
		return 0;
		
	}

	function select_editor_cv($user_id){
		global $conn;
		
		$sql = "SELECT id
				FROM CV
				WHERE owner = ?";

		$result = $conn->execute_query($sql, [$user_id]);

		if (!check_sql_result($result,
		"Select CV id for user successfully!",
		"Error in select CV id for user: " . $sql . "<br>" . mysqli_error($conn)))
			return 1;

		$result = sql_result_to_array($result);
		return $result;
	}

	function select_cv_detail($cv_id){
		global $conn, $debug;
		
		$sql = "SELECT *
				FROM CV
				WHERE id = ?";

		$result = $conn->execute_query($sql, [$cv_id]);

		if ($result) {
			if (mysqli_num_rows($result) > 0){
				if ($debug) echo '<script>console.log("Select CV for user successfully!"); </script>';
			} else {
				if ($debug) echo '<script>console.log("There is no CV for user"); </script>';
				return 2;
			}
		} else {
			if ($debug) echo "<script>console.log('Error in select CV: " . $sql . "<br>" . mysqli_error($conn) . ";</script>";
			return 1;
		}
		$result = sql_result_to_array($result)[0];

		$phones = sql_result_to_array(select_cv_detail_component($cv_id, "phone"));

		$addresses = sql_result_to_array(select_cv_detail_component($cv_id, "address"));

		$skills = sql_result_to_array(select_cv_detail_component($cv_id, "skill"));

		$educations = sql_result_to_array(select_cv_detail_component($cv_id, "education"));

		$experiences = sql_result_to_array(select_cv_detail_component($cv_id, "experience"));

		$allowers = [];
		if ($result["access_level"] == 3){
			$allower_ids = sql_result_to_array(select_cv_detail_component($cv_id, "allow"));
			for ($i = 0; $i < count($allower_ids); $i++){
				$sql = "SELECT * FROM User WHERE id= ?";
				$allower_result = $conn->execute_query($sql, [$allower_ids[$i]["user_id"]]);
				if ($allower_result->num_rows > 0){
					$row = $allower_result->fetch_assoc();
					array_push($allowers, $row);
				}
			}
		}

		return array_merge($result, ["phone"=>$phones, "address"=>$addresses, "skill"=>$skills, "education"=>$educations, "experience"=>$experiences, "allower"=>$allowers]);
	}
	
	function select_cv_detail_component($cv_id, $table_name){
		global $conn, $db_name;

		$sql = "SELECT * FROM " . $table_name . " WHERE cv_id = ?";
		$result = $conn->execute_query($sql, [$cv_id]);
		if (!check_sql_result($result,
		"Select CV " . $table_name. " successfully!",
		"Error in select CV" . $table_name . ": " . $sql . "<br>" . mysqli_error($conn)))
			return 1;
		return $result;
	}

	function sql_result_to_array($sql_result){
		$result = [];
		if ($sql_result->num_rows > 0){
			while ($row = $sql_result->fetch_assoc()){
				array_push($result, $row);
			}
		}
		return $result;
	}
	

	function check_sql_result($result, $success_message, $error_message){
		global $debug;
		if ($result) {
			if ($debug) 
				print_r($success_message);
		  } else {
			if ($debug) 
				print_r($error_message);
			return false;
		}
		return true;
	}

	function print_mysql_result($input, $label = ""){
		global $debug;
		if ($debug){
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
	}
?>