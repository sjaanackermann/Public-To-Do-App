<?php
  session_start();
  require_once("config.php");

  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['ident'])) {
        $connect_DB = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$connect_DB) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
      }
  try 
  {
    $id = mysqli_real_escape_string($connect_DB, $_REQUEST['ident']);
    $mytitle = mysqli_real_escape_string($connect_DB, $_REQUEST['editTask']);
    $myDueDate = mysqli_real_escape_string($connect_DB, $_REQUEST['editDate']);


    $stmt = $connect_DB->prepare("UPDATE todo_list SET task = ?, dueDate = ?  WHERE id = ?");
    $stmt->bind_param("sss", $mytitle, $myDueDate, $id);

    if ($stmt->execute())
    {

    }
    else{
      throw new Exception($stmt->error);
    }
    echo "success";
    $connect_DB->close();
  }catch(Exception $e){
    echo $id." ".$mytitle." ".$myDueDate." ".$e->getMessage();
  }
}
?>
