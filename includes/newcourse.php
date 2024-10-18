<?php

    include 'connect.php';

    $Name = $_POST['inputLessonName'];
    $ID = $_POST['inputID'];
    $Description = $_POST['inputDescription'];
    if(isset($_POST["inputReq"])){ 
        foreach ($_POST['inputReq'] as $inputReq)  {
            $q = "SELECT ID FROM course WHERE Name = '$inputReq'";
            $r = mysqli_query($conn, $q);
            $req = mysqli_fetch_assoc($r)["ID"];
            $new = "INSERT INTO course_req ( ID_Course , ID_Req ) 
            VALUES ('$ID', '$req')";
            mysqli_query($conn, $new);
        }
    }

    $select_id = "SELECT * FROM course WHERE ID = '$ID' ";
    $result_ID = mysqli_query($conn, $select_id);
    $Checkrows_ID = mysqli_num_rows($result_ID);

    if($Checkrows_ID == 1)
    {
        echo "<script> alert </script>";
    }
    else
    {
        $reg = "INSERT INTO course (Name , Description  , ID) 
        VALUES ('$Name', '$Description','$ID')";
        mysqli_query($conn, $reg);
        //$reg1 = "SELECT Login FROM professor WHERE Name = '$Professor' ";
        //$result_reg1 = mysqli_query($conn, $reg1);
        //$Professor_ID = mysqli_fetch_assoc($result_reg1)["Login"];
        //$reg1 = "INSERT INTO teaching (ID , Professor , Lesson , Year , Semester , Theory , Lab , Theory1 , Lab1)
        //VALUES ('$ID','$Professor_ID','$Name',$Year,$Semester,$Theory,$Lab,$Theory1,$Lab1)";
        //mysqli_query($conn,$reg1);
        header("Location: ../admin_courses.php");
    }


?>