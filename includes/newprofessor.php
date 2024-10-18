<?php

    include 'connect.php';
    include 'functions.php';

    //Get user credentials from web page with $_POST method.
    $fname = filter_var($_POST['inputFirstName'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['inputLastName'], FILTER_SANITIZE_STRING);
    $uname = filter_var($_POST['inputUsername'], FILTER_SANITIZE_STRING);
    $password = $_POST['inputPassword'];
    $repassword = $_POST['inputrePassword'];
    $spec = filter_var($_POST['inputSpec'], FILTER_SANITIZE_STRING);

    //Select all the information from the line the email is.
    $s = "SELECT * FROM professor WHERE login = '$uname'";

    //Get results into a variable.
    $result = mysqli_query($conn, $s);

    //Check if result exists by counting the rows.
    $checkrows = mysqli_num_rows($result);

    if($checkrows == 1)
    {
        echo "<script> alert </script>";
    }
    //Else get the credentials and add them to the database.
    else
    {
        $password = encryption($password);
        $default_type = 3;
        $set_inactive = 0;

        $stmt = $conn->prepare("INSERT INTO user (Login , Passwd , Type , isActive) 
        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $uname, $password, $default_type, $set_inactive);
        $stmt->execute();

        $stmt = $conn->prepare("INSERT INTO professor (login, name , surname , spec) 
        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $uname, $fname, $lname, $spec);
        $stmt->execute();

        header('location: ../signup.php');
    }
?>