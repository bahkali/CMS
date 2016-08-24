<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>UserName</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
<!--            <th>Image</th>-->
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

        <?php 
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);

             while($row = mysqli_fetch_assoc($select_users))
            {
                $user_id = $row['user_id'];
                $user_name = $row['username'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
//                $user_image = $row['user_image'];
                $randSalt = $row['randSalt'];

                echo    "<tr>";
                echo    "<td>{$user_id}</td>";
                echo    "<td>{$user_name}</td>";
                echo    "<td>{$first_name}</td>";
                echo    "<td>{$last_name}</td>"; 
                echo    "<td>{$user_email}</td>"; 
                echo     "<td>{$user_role}</td>";
                echo     "<td><a href='users.php?change_admin={$user_id}'>Admin</a></td>";
                echo     "<td><a href='users.php?change_sub={$user_id}'>Subscriber</a></td>";
                echo     "<td><a href='users.php?source=edit_users&p_id={$user_id}'>Edit</a></td>";
                echo     "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                echo     "</tr>";

            }
        
        ?>
        
        
        <?php
        //delete user
        if(isset($_GET['delete'])){
            $user_id = $_GET['delete'];
            $sql = "DELETE FROM users WHERE user_id = '$user_id'";
            $result = mysqli_query($connection, $sql);
            
            if(!$result){
                  die("QUERY FAILED " . mysqli_error($connection));  
             }
             header("Location: users.php");
        }
        
        //update role of user
        if(isset($_GET['change_admin'])){
            $user_id = $_GET['change_admin'];
            
            $sql = "UPDATE users SET user_role='admin' WHERE user_id = '$user_id'";
            $result = mysqli_query($connection, $sql);
            
            if(!$result){
                  die("QUERY FAILED " . mysqli_error($connection));  
             }
             header("Location: users.php");
            
        }
            
        if(isset($_GET['change_sub'])){
            
            $user_id = $_GET['change_sub'];
            
            $sql = "UPDATE users SET user_role='subscriber' WHERE user_id = '$user_id'";
            $result = mysqli_query($connection, $sql);
            
            if(!$result){
                  die("QUERY FAILED " . mysqli_error($connection));  
             }
             header("Location: users.php");
        }
        
        ?>
    </tbody>
</table>