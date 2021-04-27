<?php
require_once 'config.php';

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['signup']))
{
   $username = trim($_POST['username']);
   $emailid = trim($_POST['emailid']);
   $password = trim($_POST['password']); 
 
   if($username=="") {
      $error[] = "provide username !"; 
   }
   else if($emailid=="") {
      $error[] = "provide email id !"; 
   }
   else if(!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($password=="") {
      $error[] = "provide password !";
   }
   else if(strlen($password) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT emailid FROM users WHERE emailid=:umail");
         $stmt->execute(array(':umail'=>$emailid));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['emailid']==$emailid) {
            $error[] = "sorry email id already taken !";
         }
         else
         {
            if($user->Register($username,$emailid,$password)) 
            {
                $user->Redirect('signup.php?joined');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>