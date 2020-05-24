<?php
// Details of where to connect
try{
define('DB_SERVER', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_NAME', '');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//is connection sucessful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
    throw new Exception("Failed to connect");
}else{
    echo "";
}
}catch(Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>