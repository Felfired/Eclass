<?php

    include 'connect.php';
    //$Professor = $_POST['inputProfessor'];
    $Year = $_POST['inputYear'];
    $Semester = $_POST['inputSemester'];
    $Theory = $_POST['inputTheory'];
    $Lab = $_POST['inputLab'];
    $Theory1 = $_POST['inputTheory1'];
    $Lab1 = $_POST['inputLab1'];
    $course_name = $_POST['course_name'];


        $qcourse_id = "SELECT ID FROM course WHERE Name = '$course_name'";
        $course_id = mysqli_query($conn, $qcourse_id);
        $rcourse_id = mysqli_fetch_assoc($course_id)["ID"];

        $qprofessor_id = "SELECT ID_Professor FROM professor_course WHERE ID_Course = '$rcourse_id'";
        $professor_id = mysqli_query($conn, $qprofessor_id);
        $rprofessor_id = mysqli_fetch_assoc($professor_id)["ID_Professor"];

        $qlesson_name = "SELECT Name FROM course WHERE ID = '$rcourse_id'";
        $lesson_name = mysqli_query($conn, $qlesson_name);
        $rlesson_name = mysqli_fetch_assoc($lesson_name)["Name"];

        $final = "INSERT INTO teaching (ID , Professor , Lesson , Year , Semester , Theory , Lab , TheoryLength , LabLength)
        VALUES ('$rcourse_id', '$rprofessor_id', '$rlesson_name', $Year, $Semester, $Theory, $Lab, $Theory1, $Lab1)";
        mysqli_query($conn, $final);
        header("Location: ../admin_courses.php");
?>