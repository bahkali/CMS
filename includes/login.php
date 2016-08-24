<?php

include("db.php");
session_start();

if(isset($_POST['login'])){
   $username = $_POST['username'];
   $password = $_POST['password'];
    
   $username = mysqli_real_escape_string($connection, $username);
   $password = mysqli_real_escape_string($connection, $password);
    
    $sql= "SELECT * FROM users WHERE username = '$username'";
    $query = mysqli_query($connection, $sql);
    
    if(!$query){
        die("FAILED QUERY" . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_assoc($query)){
        
        $user_id = $row['user_id'];
        $user_name = $row['username'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
        $randSalt = $row['randSalt'];   
           
    }
    if(($username === $user_name) && ($password === $user_password) ){
        
        $_SESSION['username'] = $user_name;
        $_SESSION['firstname'] = $first_name;
        $_SESSION['lastname'] = $last_name;
        $_SESSION['user_role'] = $user_role;
        
        header("Location: ../admin/index.php");
          
    }else{
         header("Location: ../index.php");
    }
}



?>