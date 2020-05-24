<?php
session_start();
require_once("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['task_name'])) {
    $connect_DB = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$connect_DB) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    try 
    {
        $mytitle = mysqli_real_escape_string($connect_DB, $_REQUEST['task_name']);
        $myDueDate = mysqli_real_escape_string($connect_DB, $_REQUEST['task_date']);
        $myUserID = mysqli_real_escape_string($connect_DB, $_SESSION['userID']);
        
        $stmt = $connect_DB->prepare("INSERT INTO todo_list (task, dueDate, userID) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $mytitle, $myDueDate, $myUserID);
    
        if ($stmt->execute())
        {

        }
        else{
            throw new Exception($stmt->error);
        }
        $connect_DB->close();
        echo $myUserID." ".$mytitle." ".$myDueDate;
    }catch(Exception $e){
        echo $myUserID." ".$mytitle." ".$myDueDate." ".$e->getMessage();
    }
    
}
