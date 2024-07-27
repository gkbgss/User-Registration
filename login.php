<?php

session_start();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login by admin  </title>
    <link rel="stylesheet" href="login-style.css">
</head>
<body>
    <div class="center">
       <h1>Login</h1>

    <form action="#" method="POST" autocomplete="off">
       <div class="from">
        <input type = "text" name="Uname" class="textfield" placeholder="Usermail">
        <input type = "password" name="password" class="textfield" placeholder="Password">

        <div class="forgetpass"><a href="#" class="link"   onclick="message()">Forgate Password</a></div>
        <input type="submit" name="login" value="Login" class="btn">
        
        <div class="signup">New Member ?<a href="#" class="link" >SignUp here</a></div>
     </div>

    </form>
<script>
    function  message(){

       alert("know your password"); 
    }
</script>

</body>
</html>

<?php
   include("connection.php");
   if(isset($_POST['login'])){
    $usermail= $_POST['Uname'];
    $pwd  = $_POST['password'];
   
   $query = "SELECT * FROM form4 WHERE email ='$usermail' && password ='$pwd'"; 
    $data = mysqli_query($conn,$query);
    $total  = mysqli_num_rows($data);
    // echo $total; 
    if($total == 1){
        $_SESSION['user_mail'] = $usermail;
        header('location:display.php');
    } 
    else{
        echo "login Failed"; 
    }
   }
?>