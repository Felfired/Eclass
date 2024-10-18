<?php

    include 'connect.php';
    include 'functions.php';

    //Get user credentials from web page with $_POST method.
    $fname = filter_var($_POST['inputFirstName'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['inputLastName'], FILTER_SANITIZE_STRING);
    $password = $_POST['inputPassword'];
    $repassword = $_POST['inputrePassword'];
    $year = $_POST['inputYear'];

	$Year = "SELECT * FROM nspy_create WHERE Year = '$year' ";
	$result_year = mysqli_query($conn, $Year);
	$checkrows_year = mysqli_num_rows($result_year);

	$idnumber = "";
	if($checkrows_year == 1)
    {	
		$Counter = "SELECT Counter FROM nspy_create WHERE Year = '$year' ";
		$q = mysqli_query($conn, $Counter);
		$counter = mysqli_fetch_assoc($q)["Counter"];
		$counter = intval($counter) + 1;
		$Counter = strval($counter);
		$upd1 = "UPDATE nspy_create SET Counter = '$counter' WHERE Year = '$year'";
		mysqli_query($conn, $upd1);
		if ($counter < 10)
			$Counter =  "00".$Counter;
		elseif ($counter >= 10 && $counter < 100 )
			$Counter =  "0".$Counter;
        $idnumber = "321".strval($year).$Counter;
    }
	else
    {
		$New_Year = "INSERT INTO nspy_create (Year , Counter) 
        VALUES ('$year', 1)";
        mysqli_query($conn, $New_Year);
		$idnumber = "321".strval($year)."001";
	}

    //Select all the information from the line the email is.
    $s = "SELECT * FROM student WHERE id = '$idnumber'";

    //Get results into a variable.
    $result = mysqli_query($conn, $s);

    //Check if result exists by counting the rows.
    $checkrows = mysqli_num_rows($result);

    //If it does exist log in and show appropriate page else display same page.
    if($checkrows == 1 || strlen($idnumber) != 10)
    {
        echo "<script> alert </script>";
    }

    //Else get the credentials and add them to the database.
    else 
    {
        $login = "icsd" . substr($idnumber, -5);
        $password = encryption($password);
        $default_type = 2;
        $set_inactive = 0;

        $stmt = $conn->prepare("INSERT INTO user (Login , Passwd , Type , isActive) 
        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $login, $password, $default_type, $set_inactive);
        $stmt->execute();

        $stmt = $conn->prepare("INSERT INTO student (login, id, name , surname , year) 
        VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $login, $idnumber, $fname, $lname, $year);
        $stmt->execute();

        header('location: ../signup.php');
    }
?>