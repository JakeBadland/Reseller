<?php

//namespace libs;

class libDb {

    function dbConnect()
    {
        $conn = new mysqli('localhost', 'root', '');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function dbSelect($connection, $dbName)
    {
        return mysqli_select_db($connection, $dbName);
    }

    function dbClose($connection)
    {
        $connection->close();
    }

    function dbQuery($connection, $query)
    {
        return mysqli_query($connection, $query);
    }

    function dbFetchQuery($connection, $query)
    {
        $data = dbQuery($connection, $query);

        $result = [];

        foreach ($data as $row){
            $result[] = $row;
        }

        return $result;
    }

    function dbShowDatabases($connection)
    {
        $sql = 'SHOW DATABASES';
        $result = dbFetchQuery($connection, $sql);

        echo '<b>Current databases:</b> <br/>';
        foreach($result as $row){
            echo ($row['Database'] . '<br/>');
        }

    }


}





