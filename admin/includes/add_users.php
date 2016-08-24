<?php
    
     if(isset($_POST['create_user'])){
         
        $first_name = htmlentities($_POST['first_name']);
        $last_name = htmlentities($_POST['last_name']);
        $username = htmlentities($_POST['username']);
        $user_email = htmlentities($_POST['user_email']);
        $user_password = htmlentities($_POST['user_password']);
        $user_role = htmlentities($_POST['user_role']);
         
//        $post_image =  $_FILES['post_image']['name'];
//        $post_image_temp =  $_FILES['post_image']['tmp_name'];
//        $moveResult =  move_uploaded_file($post_image_temp, "../images/$post_image");
         
         
          //insert the value in the database
          $sql = "INSERT INTO users ( first_name, last_name, username, user_email, user_password, user_role )";
          $sql .= " VALUES('$first_name', '$last_name', '$username' , '$user_email', '$user_password', '$user_role')";
         
          $query = mysqli_query($connection, $sql);
         
         if(!$query){
                  die("QUERY FAILED " . mysqli_error($connection));  
         }
        
         echo "<div class='bg-success'>User Created: <a href='users.php'>View Users</a></div>";
         
       }

?>
<form method="post" enctype="multipart/form-data" >
    <div class="form-group">
        <label >First Name</label>
        <input type="text" class="form-control" name="first_name" required>
    </div>
    
    <div class="form-group">
        <label >Last Name </label>
        <input type="text" class="form-control" name="last_name" required>
    </div>
    
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>
     <div class="form-group">
          <select name="user_role" id="">
              <option value="subcriber">Select option</option>
              <option value="admin">Admin</option>
              <option value="subscriber">Subscriber</option>
          </select>
     </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="user_email" required>
    </div>
    
    
    <div class="form-group">
        <label >Password</label>
        <input type="password" class="form-control" name="user_password" required>
    </div>   
    
    <input type="submit" name="create_user" class="btn btn-primary" value="Submit">
</form>