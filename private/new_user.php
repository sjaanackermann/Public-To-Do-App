<?php


session_start();

require_once ("../public/config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connect_DB = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$connect_DB) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

  $myUser = "";
        // check if username is already taken
  if (isset($_POST['register'])) {
  	$myName = $_POST['name'];
  	$myUser = $_POST['username'];
  	$pwhash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $_SESSION['pwhash'] = $pwhash;

  	$sql_u = "SELECT * FROM users WHERE username='$myUser'";
  	$res_u = mysqli_query($connect_DB, $sql_u);

  	if (mysqli_num_rows($res_u) > 0) {
        $message = 'Sorry, this username is already taken!';

        echo "<SCRIPT> 
                alert('$message')
                window.location.replace('../public/index.php');
            </SCRIPT>"; 	
            // if username not taken - register the user
  	}else{
           $query = "INSERT INTO users (name, username, pwhash) 
      	    	  VALUES ('$myName', '$myUser', '$pwhash')";
           $results = mysqli_query($connect_DB, $query);
           $message = 'Registered Successfully! Please login';

        echo "<SCRIPT> 
                alert('$message')
                window.location.replace('../public/index.php');
            </SCRIPT>"; 
  	}
  }
}

 ?>


