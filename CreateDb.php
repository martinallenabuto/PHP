<?php
 class CreateDb
 {
     public $host;
     public $user;
     public $password;
     public $dbname;
     public $tablename;
     public $conn;

    //Class Constructor
    public function __construct($dbname = "Customers",$tablename= "registered_customers",$host = "localhost",$user = "root",$password = "")
        {
        $this->dbname = $dbname;
        $this->tablename=$tablename;
        $this->host=$host;
        $this->user=$user;
        $this->password=$password;

    //   Create Connection
        $this->conn=mysqli_connect($host,$user,$password);

    // Check Connection
        if(!$this->conn)
        {
            die("Connection failed:".mysqli_connect_error());
        }

        // Query for creating the new database
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // Execute Query
        if(mysqli_query($this->conn, $sql))
        {
            $this->conn= mysqli_connect($host,$user,$password,$dbname);

            // Query to create a table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename
             (
              `id` int(11) NOT NULL AUTO_INCREMENT,  
               `username` varchar(30) NOT NULL,  
               `emailid` varchar(30) NOT NULL,  
               `password` varchar(30) NOT NULL,  
                PRIMARY KEY (`id`) 
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;";

            if(!mysqli_query($this->conn, $sql))
            {
                echo "Error Creating Table:".mysqli_error($this->conn);
            }
        }
        else
        {
            return false;
        }
    }
 }



?>