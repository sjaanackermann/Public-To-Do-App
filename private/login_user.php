<?php
session_start();
require_once("config.php");

 if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $connect_DB = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if (!$connect_DB) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

 if (isset($_POST['username'])) $myUserName = mysqli_real_escape_string($connect_DB, $_REQUEST['username']);
 if (isset($_POST['password'])) $myPassword = trim(mysqli_real_escape_string($connect_DB, $_REQUEST['password']));

$stmt = $connect_DB->prepare("SELECT id, username, pwhash FROM users WHERE username = ?");
$stmt->bind_param("s", $myUserName);
$stmt->execute();
$result = $stmt->get_result();
$connect_DB->close();

$row = $result->fetch_assoc();

if ($this->sql_response->num_rows > 0) {
    if (password_verify($this->userPassword, $this->sql_row['pwhash'])) {
        $_SESSION['username'] = $this->userName;
        $_SESSION['pwhash'] = $this->sql_row['pwhash'];
        header("Location: ../public/todo.php");
        
    } else {
        $message = 'You might have made a typo? or Sign Up.';

        echo "<SCRIPT> 
                alert('$message')
                window.location.replace('../public/index.php');
            </SCRIPT>";    }
}
}
?>