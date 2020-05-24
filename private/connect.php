<?php
require_once('config.php');

// class Connect handles DB connection, DB status and retrieves DB data
class Connect
{
    public $conn_DB;
    public $sql_request;
    public $send_sql;
    public $sql_response;
    public $response= array();

    public function connectDB() {
        $this->conn_DB = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->conn_DB) {
            return $this->conn_DB;
        } else {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }

    public function getStatus() {
        global $dbStatusNok;
        global $dbStatusOk;
        session_start();
        if (!$this->connectDB()) {
            echo $dbStatusNok;
        } else {
            echo $dbStatusOk;
            echo "<div>Hello, " . $_SESSION['username'] . "!</div>";

            $this->sql_request = "SELECT id FROM users WHERE username = '$_SESSION[username]' AND pwhash = '$_SESSION[pwhash]'";
            $this->send_sql = $this->connectDB()->query($this->sql_request);
            $this->sql_response = $this->send_sql->fetch_all(MYSQLI_ASSOC);
            foreach ($this->sql_response as $key => $row) {
            $_SESSION['userID'] = $row['id'];
            }
            mysqli_close($this->connectDB());
        }
    }

    public function checkEmpty() {
        session_start();
        if (empty($_SESSION['username'])) {
        header("Location: index.php");
        }
    }

    public function getData() {
        session_start();
        $this->sql_request = "SELECT * FROM todo_list WHERE userID = '$_SESSION[userID]'  ORDER BY task ASC";
        $this->send_sql = $this->connectDB()->query($this->sql_request);
        $this->sql_response = $this->send_sql->fetch_all(MYSQLI_ASSOC);

        $z= 0;

        foreach ($this->sql_response as $key => $row) {
            $response[$z]['id'] = $row['id'];
            $response[$z]['task'] = $row['task'];
            $response[$z]['dueDate'] = $row['dueDate'];
            $z = $z +1;

    }
    mysqli_close($this->connectDB());
    return $response;
    }
}

?>
