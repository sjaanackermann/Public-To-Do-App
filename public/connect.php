<?php
require_once('config.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if($_GET['sort'] == 'DESC'){
        $data = new Connect();
        return $data->getDataByTaskDesc();
    }else{
    $data = new Connect();
    return $data->getData();
}
}

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
        // ----------------------------DISPLAY TODOS----------------------------
    public function getData() {
        session_start();
        $this->sql_request = "SELECT * FROM todo_list WHERE userID = '$_SESSION[userID]'  ORDER BY task ASC";
        $this->send_sql = $this->connectDB()->query($this->sql_request);
        $this->sql_response = $this->send_sql->fetch_all(MYSQLI_ASSOC);

        $z= 0;
        
        echo "<ul id=\"todo_list\" class=\"todo_list\">";

            foreach ($this->sql_response as $key => $row) {
            echo "<li class='todo_list_item'>";
                echo "<form id='edit' class='task_area'";
                echo "<input type='hidden' id='editIdent' name='editIdent' value={$row['id']}>";
                echo "<div>";
                echo "<input class='td_entry_edit' id='editTask-{$row['id']}' name='editTask' type='text' maxlength='60' spellcheck='false' value='";
                echo $row['task'];
                echo "'>";
                echo "<br>";
                echo "Due Date: ";
                echo "<input class='td_entry_edit' id='editDate-{$row['id']}' name='editDate' type='date' maxlength='60' spellcheck='false' value='";
                echo $row['dueDate'];
                echo "'>";
                echo "</div>";
                echo "<button type='submit'name='editid' onclick='edit_todoitem(this)' id='editnote-{$row['id']}'>";
                echo "<span><i class='fas fa-edit'></i></span>";
                echo "</button>";
                echo "</form>";

                echo "<div class='buttons'>";
                echo "<form class='delete_button'>";
                echo "<input type='hidden' name='ident' value={$row['id']}>";
                echo "<button type='submit' name='deleteid' onclick='delete_todoitem(this)' id={$row['id']}>";
                echo "<span><i class='fas fa-trash-alt'></i></span>";
                echo "</button>";
                echo "</form>";
                echo "</div>";
            echo "</li>";
        }
        echo "</ul>";
        mysqli_close($this->connectDB());
    }

        // ----------------------------SORT TO DO----------------------------
    public function getDataByTaskDesc() {
        session_start();
        $this->sql_request = "SELECT * FROM todo_list WHERE userID = '$_SESSION[userID]'  ORDER BY task DESC";
        $this->send_sql = $this->connectDB()->query($this->sql_request);
        $this->sql_response = $this->send_sql->fetch_all(MYSQLI_ASSOC);

        $z= 0;
        
        echo "<ul id=\"todo_list\" class=\"todo_list\">";

            foreach ($this->sql_response as $key => $row) {
                echo "<li class='todo_list_item'>";
                echo "<form id='edit' class='task_area'";
                echo "<input type='hidden' id='editIdent' name='editIdent' value={$row['id']}>";
                echo "<div>";
                echo "<input class='td_entry_edit' id='editTask-{$row['id']}' name='editTask' type='text' maxlength='60' spellcheck='false' value='";
                echo $row['task'];
                echo "'>";
                echo "<br>";
                echo "Due Date: ";
                echo "<input class='td_entry_edit' id='editDate-{$row['id']}' name='editDate' type='date' maxlength='60' spellcheck='false' value='";
                echo $row['dueDate'];
                echo "'>";
                echo "</div>";
                echo "<button type='submit'name='editid' onclick='edit_todoitem(this)' id='editnote-{$row['id']}'>";
                echo "<span><i class='fas fa-edit'></i></span>";
                echo "</button>";
                echo "</form>";

                echo "<div class='buttons'>";
                echo "<form class='delete_button'>";
                echo "<input type='hidden' name='ident' value={$row['id']}>";
                echo "<button type='submit' name='deleteid' onclick='delete_todoitem(this)' id={$row['id']}>";
                echo "<span><i class='fas fa-trash-alt'></i></span>";
                echo "</button>";
                echo "</form>";
                echo "</div>";
            echo "</li>";
        }
        echo "</ul>";
        mysqli_close($this->connectDB());
    }
}
?>
       


