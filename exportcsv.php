<?php
    require_once 'includes/connect.php';
    if(isset($_GET['id']))
    {
        $ID_Course = trim($_GET['id']);

        $sql = "SELECT Name FROM course WHERE ID = '$ID_Course'";
        $result = mysqli_query($conn, $sql);
        $Name_Course = mysqli_fetch_assoc($result)['Name'];

        header('Content-Type: text/csv; charset= utf-8');
        header('Content-Disposition: attachment; filename=' . $Name_Course . '.csv');

        $output = fopen('php://output', 'w');

        fputcsv($output, array('ID_Student', 'Lab_Grade', 'Theory_Grade', 'Grade'));

        $sql = "SELECT ID_Student, Lab_Grade, Theory_Grade, Grade FROM student_exams WHERE ID_Course = '$ID_Course'";
        $rows = mysqli_query($conn, $sql);

        while($line = mysqli_fetch_assoc($rows))
        {
            fputcsv($output, $line);
        }
        fclose($output);
    }