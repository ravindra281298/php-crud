<?php

    session_start();

    $name = '';
    $email = '';
    $update = false;
    $id = 0;
    $mysqli = new mysqli('localhost', 'root', 'root', 'crud') or die($mysqli);

    if(isset($_POST['save'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $mysqli->query("INSERT INTO data (name, email) VALUES('$name', '$email')") or
            die($mysqli->error);
        
        $_SESSION['message'] = "Record has been saved.";
        $_SESSION['msg_type'] = "success";  
        
        header("location: index.php");
    }

    if(isset($_GET['delete'])) {

        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been deleted";
        $_SESSION['msg_type'] = "danger";

        header("Refresh:2; url=index.php");
        // header("location: index.php");
    }

    if(isset($_GET['edit'])) {

        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);

        if(count($result)==1) {
            $row = $result->fetch_array();
            $name = $row['name'];
            $email = $row['email'];
            $update =true;
        }
    }

    if(isset($_POST['update'])) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $mysqli->query("UPDATE data SET name='$name', email='$email' WHERE id=$id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated.";
        $_SESSION['msg_type'] = "warning";  
        
        header("location: index.php");
    }
?>