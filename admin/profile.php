<!--catch all preceding commande-->


<?php include("includes/admin_header.php"); ?>
<?php
                    
      if(isset($_SESSION['username'])){
          $username = $_SESSION['username'];
      }

        $query = "SELECT * FROM users WHERE username ='{$username}'";
        $select = mysqli_query($connection, $query);

         while($row = mysqli_fetch_assoc($select))
         {
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $user_name = $row['username'];
            $user_role = $row['user_role'];
            $user_email = $row['user_email'];

         }


        
    if(isset($_POST['edit_user'])){
        
        $firstname = stripslashes(htmlentities($_POST['first_name']));
        $lastname = htmlentities($_POST['last_name']);
        $usernam = htmlentities($_POST['username']);
        $useremail = htmlentities($_POST['user_email']);
        $userpassword = htmlentities($_POST['user_password']);
        $userrole = htmlentities($_POST['user_role']);
            
        $sql  = "UPDATE users SET ";
        $sql .= "first_name='{$firstname}', ";
        $sql .= "last_name='{$lastname}', ";
        $sql .= "username='{$usernam}', ";
        $sql .= "user_role ='{$userrole}', ";
        $sql .= "user_email='$useremail', ";
        $sql .= "user_password='$userpassword' "; 
        $sql .=" WHERE username = '{$username}'";
        
        $result = mysqli_query($connection, $sql);

        if(!$result){
              die("QUERY FAILED " . mysqli_error($connection));  
         }
    }
 ?>
<div id="wrapper">

   <?php include("includes/admin_nav.php"); ?>


    <div id="page-wrapper">
  
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcom to Admin
                            <small>Author</small>
                    </h1>
                    
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
                        <input type="text" class="form-control"  value="<?php echo $user_name; ?>" onclick="value=''" name="username" required>
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

                    <input type="submit" name="edit_user"  class="btn btn-primary" value="Update User">
                </form>
                </div>
            </div>
            <!-- /.row -->


 </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include("includes/admin_footer.php"); ?>