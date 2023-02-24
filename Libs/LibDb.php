<?php

//namespace libs;

class libDb {

    private $host = '';
    private $user = '';
    private $password = '';

    private $db = '';

    private $connection = null;

    private $select;
    private $from;
    private $where;
    private $limit;

    public function __construct()
    {
        $config = Config::get('database');

        if (!$config) return;

        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];

        $this->dbConnect();

        if (!$this->connection) return;

        if ($this->db_name){
            $this->dbSelect();
        }
    }

    private function dbConnect()
    {
        $conn = new mysqli($this->host, $this->user, $this->password);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $this->connection = $conn;
    }

    private function dbSelect()
    {
        return mysqli_select_db($this->connection, $this->db_name);
    }

    public function dbClose()
    {
        $this->connection->close();
    }

    public function query($query)
    {
        return mysqli_query($this->connection, $query);
    }

    public function fetchQuery($query)
    {
        $data = $this->query($query);

        $result = [];

        foreach ($data as $row){
            $result[] = $row;
        }

        return $result;
    }

    public function dbShowDatabases()
    {
        $sql = 'SHOW DATABASES';
        $result = $this->dbFetchQuery($sql);

        echo '<b>Current databases:</b> <br/>';
        foreach($result as $row){
            echo ($row['Database'] . '<br/>');
        }
    }


}





