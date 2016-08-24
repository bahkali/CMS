<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>Date</th>
            <th>In Response To</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php 
            $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query);

             while($row = mysqli_fetch_assoc($select_comments))
            {
                $comments_id = $row['comments_id'];
                $comments_author = $row['comments_author'];
                $comments_post_id = $row['comments_post_id'];
                $comments_status = $row['comments_status'];
                $comments_email = $row['comments_email'];
                $comments_content = $row['comments_content'];
                $comments_date = $row['comments_date'];


                echo    "<tr>";
                echo    "<td>{$comments_id}</td>";
                echo    "<td>{$comments_author}</td>";
                echo    "<td>{$comments_content}</td>";
                

//                $query2 = "SELECT cat_title FROM categories WHERE cat_id = {$post_cat}";
//                $result = mysqli_query($connection, $query2);
//                while($r = mysqli_fetch_assoc($result)){
//                     $cat_t= $r['cat_title'];
//                    if($cat_t == ""){
//                         echo "<td>&nbsp;</td>";
//                    }else{
//                         echo "<td>{$cat_t}</td>"; 
//                    }
//                 }
                echo    "<td>{$comments_email}</td>"; 
                echo    "<td>{$comments_status}</td>"; 
                echo     "<td>{$comments_date}</td>";
                 
                $sql = "SELECT * FROM post WHERE post_id='$comments_post_id'";
                $result = mysqli_query($connection, $sql);
                 
                while($line = mysqli_fetch_assoc($result)){
                    $post_id = $line['post_id'];    
                    $post_title = $line['post_title'];
                    echo     "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }
                echo     "<td><a href='comments.php?approved={$comments_id}'>Approve</a></td>";
                echo     "<td><a href='comments.php?unapproved={$comments_id}'>Unapprove</a></td>";
                echo     "<td><a href='comments.php?delete={$comments_id}'>Delete</a></td>";
                echo     "</tr>";

            }
        
        ?>
        
        <?php
            //delete comments
              if(isset($_GET['delete'])){
                $comment_id = $_GET['delete'];
                $sql2 = " DELETE FROM comments WHERE comments_id='$comment_id' ";
                $query = mysqli_query($connection, $sql2);
                if(!$query){
                  die("QUERY FAILED " . mysqli_error($connection));  
                }
                header("Location: comments.php");      
             }
        ?>
        
        <?php
            //unapproved comments
              if(isset($_GET['unapproved'])){
                $comment_id = $_GET['unapproved'];
                $sql2 = "UPDATE comments SET comments_status='unapproved' WHERE comments_id='$comment_id' ";
                $query = mysqli_query($connection, $sql2);
                if(!$query){
                  die("QUERY FAILED " . mysqli_error($connection));  
                }
                header("Location: comments.php");      
             }
        ?>
         <?php
            //unapproved comments
              if(isset($_GET['approved'])){
                $comment_id = $_GET['approved'];
                $sql2 = "UPDATE comments SET comments_status='approved' WHERE comments_id='$comment_id' ";
                $query = mysqli_query($connection, $sql2);
                if(!$query){
                  die("QUERY FAILED " . mysqli_error($connection));  
                }
                header("Location: comments.php");      
             }
        ?>
    </tbody>
</table>