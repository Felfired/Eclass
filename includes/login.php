<?php
    include 'functions.php';
    include 'connect.php';

    session_start();

    $Username = filter_var($_POST['Username'], FILTER_SANITIZE_STRING);
    $Password = filter_var($_POST['Passwd'], FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("SELECT Login FROM user WHERE Login = ?");
    $stmt->bind_param("s", $Username);
    $stmt->execute();
    $result = $stmt->get_result();

    if(mysqli_num_rows($result)==1)
    {
        $stmt = $conn->prepare("SELECT Passwd FROM user WHERE Login = ?");
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashed_password = mysqli_fetch_assoc($result)['Passwd'];
        
        $_SESSION['isLogged'] = false;

        if(password_verify($Password, $hashed_password))
        {
            $get_type = "SELECT Type FROM user WHERE Login = '$Username'";
            $q_type = mysqli_query($conn, $get_type);
            $Type = mysqli_fetch_assoc($q_type)["Type"];

            $get_active = "SELECT isActive FROM user WHERE Login = '$Username'";
            $q_active = mysqli_query($conn, $get_active);
            $Active = mysqli_fetch_assoc($q_active)["isActive"];

            $_SESSION['Type'] = $Type;

            if($_SESSION['Type']==1 && $Active == 1)
            {
                $_SESSION['Username'] = $Username;
                $_SESSION['isLogged'] = true;
                header("location: ../admin.php");
            }
            else if($_SESSION['Type']==2 && $Active == 1)
            {
                $_SESSION['Username'] = $Username;
                $_SESSION['isLogged'] = true;
                header("location: ../student.php");
            }
            else if($_SESSION['Type']==3 && $Active == 1)
            {
                $_SESSION['Username'] = $Username;
                $_SESSION['isLogged'] = true;
                header("location: ../professor.php");
            }
            else
            {
                header("Location: ../index.php");
            }   
        }
        else
        {
            header("Location: ../index.php");
        }
    }
    else
    {
        header("Location: ../index.php");
    }
    
?>