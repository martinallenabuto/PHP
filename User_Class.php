<?php
class USER
{
    private $conn;

    function __construct($DB_con)
    {
        $this->conn = $DB_con;
    }

    function __deconstruct()
    {

    }
    public function Register($username,$emailid,$password)
    {
        try
        {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO users (username, emailid,password) VALUES (:uname,:umail,:upass)");
            $stmt->bindparam(":uname", $username);
            $stmt->bindparam(":umail", $emailid);
            $stmt->bindparam(":upass", $password_hash);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function Login($emailid, $password)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE emailid = :umail LIMIT 1");
            $stmt->execute(array(':umail'=>$emailid));
            $user_row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0)
            {
                if(password_verify($password, $user_row['password']));
                {
                    $_SESSION['user_session'] = $user_row['emailid'];
                    return TRUE;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage(); 
        }
    }
    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }
    public function Redirect($url)
    {
        header("Location:$url");
    }
    public function Logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
    
}

?>