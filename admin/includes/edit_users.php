
<?php 
    
    $p_id = $_GET['p_id'];
    
    $query = "SELECT * FROM users WHERE user_id= {$p_id}";
    $select_post = mysqli_query($connection, $query);
    
     while($row = mysqli_fetch_assoc($select_post))
     {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $username = $row['username'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];
        
     }
?>

<?php 

    if(isset($_POST['edit_user'])){
        
        $first_name = stripslashes(htmlentities($_POST['first_name']));
        $last_name = htmlentities($_POST['last_name']);
        $username = htmlentities($_POST['username']);
        $user_email = htmlentities($_POST['user_email']);
        $user_password = htmlentities($_POST['user_password']);
        $user_role = htmlentities($_POST['user_role']);
            
        $sql  = "UPDATE users SET ";
        $sql .= "first_name='{$first_name}', ";
        $sql .= "last_name='{$last_name}', ";
        $sql .= "username='{$username}', ";
        $sql .= "user_role ='{$user_role}', ";
        $sql .= "user_email='$user_email', ";
        $sql .= "user_password='$user_password' "; 
        $sql .=" WHERE user_id= {$p_id}";
        
        $result = mysqli_query($connection, $sql);

        if(!$result){
              die("QUERY FAILED " . mysqli_error($connection));  
         }
         header("Location: users.php");
    }

?>
<form method="post" enctype="multipart/form-data" >
    <div class="form-group">
        <label >First Name</label>
        <input type="text" value="<?php echo $first_name; ?>"  onclick="value=''" class="form-control" name="first_name" required>
    </div>
    
    <div class="form-group">
        <label >Last Name </label>
        <input type="text" class="form-control" value="<?php echo $last_name; ?>" onclick="value=''" name="last_name" required>
    </div>
    
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control"  value="<?php echo $username; ?>" onclick="value=''" name="username" required>
    </div>
     <div class="form-group">
          <select name="user_role" id="">
             <?php 
              echo "<option value='$user_role'>$user_role</option>"; 
                if($user_role == 'subcriber'){
                   echo "<option value='admin'>Admin</option>";  
                }else{
                   echo "<option value='subcriber'>Subscriber</option>";
                }
              
              ?>
          </select>
     </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" value="<?php echo $user_email; ?>" onclick="value=''" name="user_email" required>
    </div>
    
    
    <div class="form-group">
        <label >Password</label>
        <input type="password"  class="form-control" name="user_password" required>
    </div>   
    
    <input type="submit" name="edit_user"  class="btn btn-primary" value="Submit">
</form>

