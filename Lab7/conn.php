<?php

class Connection {

    public $servername;
    public $username;
    public $password;
    public $dbname;

    function __construct($username, $servername, $password, $dbname) {
        $this->username = $username;
        $this->password = $password;
        $this->servername = $servername;
        $this->dbname = $dbname;
    }

    public function connectdb() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

}

?>