<?php
require_once ("config.php");

if($user->is_loggedin() != "")
{
 $user->Redirect('index.php');
}
if(isset($_POST['login']))
{
   // $username = $_POST['username'];
    $emailid = $_POST['emailid'];
    $password = $_POST['password'];

    if($user->Login($emailid,$password))
    {
        $user->Redirect('index.php');
    }
    else
    {
        echo "Wrong details!";
    }
}

?>