<?php
    require_once 'includes/connect.php';
    
    if(isset($_GET['filename']) && isset($_GET['ID_Course']))
    {
        $filename = "csv/" . trim($_GET['filename']);
        $ID_Course = trim($_GET['ID_Course']);

        $sql = "SELECT Theory FROM teaching WHERE ID = '$ID_Course'";
        $result = mysqli_query($conn, $sql);
        $theory_percentage = mysqli_fetch_assoc($result)['Theory'];

        $sql = "SELECT Lab FROM teaching WHERE ID = '$ID_Course'";
        $result = mysqli_query($conn, $sql);
        $lab_percentage = mysqli_fetch_assoc($result)['Lab'];

        $file = fopen($filename, "r");
        $skip = fgetcsv($file);
        
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE)
        {
            $ID_Student = filter_var($data['0'], FILTER_SANITIZE_STRING);
            $Lab_Grade = filter_var($data['1'], FILTER_SANITIZE_NUMBER_FLOAT);
            $Theory_Grade = filter_var($data['2'], FILTER_SANITIZE_NUMBER_FLOAT);

            $Grade = intval($Lab_Grade)*$lab_percentage + intval($Theory_Grade)*$theory_percentage;

            $sql = "SELECT ID_Student FROM student_exams WHERE ID_Student = '$ID_Student'";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result)==1)
            {
                $sql = "UPDATE student_exams SET Grade = '$Grade', Lab_Grade = '$Lab_Grade', Theory_Grade = '$Theory_Grade' WHERE ID_Student = '$ID_Student'";
                mysqli_query($conn, $sql);
            }

            else if(mysqli_num_rows($result)==0)
            {
                $sql = "INSERT INTO student_exams (ID_Student, ID_Course, Grade, Lab_Grade, Theory_Grade, isFinal) 
                VALUES ('$ID_Student', '$ID_Course', $Grade, $Lab_Grade, $Theory_Grade, 0)";
                mysqli_query($conn, $sql);
            }

        }
        header("Location: professor_coursegrade.php?id=" . $ID_Course);
    }
    else
    {
        exit;
    }

    
?>