
<?php 

function clean($n){
    return htmlentities($n);
}

function confirm($r){
    global $connection;
    if(!$r){
        die("FAILED QUERY" . mysqli_error($connection));
    }
}

function insert_categories(){
//handling the input
    global $connection;
     if(isset($_POST['submit'])){

         $category = clean($_POST['cat_title']);


         if($category == "" || empty($category)){
             echo "<div class='bg-danger'>This should not be empty </div>";
         }else{
             //insert the value in the database
          $sql = "INSERT INTO categories (cat_title)";
          $sql .= " VALUES('$category')";
          $query = mysqli_query($connection, $sql);

         }
     }
}

function display_categories(){
    
    global $connection;
    
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    
     while($row = mysqli_fetch_assoc($select_categories))
    {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "
        <tr>
        <td>{$cat_id}</td>
        <td>{$cat_title}</td>
        <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
        <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
        </tr>";
    }
}

function delete_categories(){
    
     global $connection;
    
     if(isset($_GET['delete'])){                                 
        $catId = $_GET['delete'];
        $sql2 = " DELETE FROM categories WHERE cat_id={$catId} ";
        $query = mysqli_query($connection, $sql2);
        header("Location: categories.php");
    } 
}

function display_table_post(){
    global $connection;
    
    $query = "SELECT * FROM post";
    $select_posts = mysqli_query($connection, $query);
    
     while($row = mysqli_fetch_assoc($select_posts))
    {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_cat = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_date = $row['post_date'];

         
        echo    "<tr>";
        echo    "<td><input class='checkBoxes' type='checkbox' name='checkBokArray[]' value='{$post_id}'></td>";
        echo    "<td>{$post_id}</td>";
        echo    "<td>{$post_author}</td>";
        echo    "<td>{$post_title}</td>";
         
        $query2 = "SELECT cat_title FROM categories WHERE cat_id = {$post_cat}";
        $result = mysqli_query($connection, $query2);
        while($r = mysqli_fetch_assoc($result)){
             $cat_t= $r['cat_title'];
            if($cat_t == ""){
                 echo "<td>&nbsp;</td>";
            }else{
                 echo "<td>{$cat_t}</td>"; 
            }
         }
        if(empty($post_status) ){      
         echo    "<td>&nbsp;</td>";
        }else{
         echo    "<td>{$post_status}</td>"; 
        }
        echo     "<td><img width=100 src='./images/{$post_image}'></td>";
        echo     "<td>{$post_tags}</td>";
        echo     "<td>{$post_comments}</td>";
        echo     "<td>{$post_date}</td>";
        echo     "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo     "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo     "</tr>";
         
    }
}

function insert_post(){
    
     global $connection;
    
     if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image =  $_FILES['post_image']['name'];
        $post_image_temp =  $_FILES['post_image']['tmp_name'];
         
        $post_tags = $_POST['post_tags'];
         
        $post_content = $_POST['post_content'];
         
        $post_comments_count = 4;
        $post_date = date('d-m-y');
        
        $moveResult =  move_uploaded_file($post_image_temp, "../images/$post_image");
         
          //insert the value in the database
          $sql = "INSERT INTO post ( post_title, post_author, post_category_id, post_status, post_image, post_content,  post_tags, post_comment_count, post_date )";
          $sql .= " VALUES('$post_title', '$post_author', '$post_category_id', '$post_status', '$post_image',  '$post_content',  '$post_tags', '$post_comments_count', now())";
         
          $query = mysqli_query($connection, $sql);
         
         if(!$query){
                  die("QUERY FAILED " . mysqli_error($connection));  
         }
        
          header("Location: posts.php?source=add_post");
     }
}

function delete_post(){
    global $connection;
    
    if(isset($_GET['delete'])){
        $post_id = $_GET['delete'];
        $sql = " DELETE FROM post WHERE post_id='$post_id' ";
        $query = mysqli_query($connection, $sql);
       if(!$query){
          die("QUERY FAILED " . mysqli_error($connection));  
        }
        header("Location: posts.php");      
     }
}

function update_post(){
    global $connection;
    
    if(isset($_POST['update_post'])){
      
        $p_id = $_GET['p_id'];

        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_cat = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image =  $_FILES['post_image']['name'];
        $post_image_temp =  $_FILES['post_image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        
        $moveResult = move_uploaded_file($post_image_temp, "../images/$post_image");
      
        if(empty($post_image)){
            $query = "SELECT * FROM post WHERE post_id= '$p_id'";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($result)){
                $post_image = $row['post_image'];
            }
            
        }
      
        $sql  = "UPDATE post SET ";
        $sql .= "post_title='{$post_title}', ";
        $sql .= "post_author='{$post_author}', ";
        $sql .= "post_category_id='{$post_cat}', ";
        $sql .= "post_status ='{$post_status}', ";
        $sql .= "post_content='$post_content', ";
        $sql .= "post_image='$post_image', ";
        $sql .= "post_tags='{$post_tags}', ";
        $sql .= "post_date = now() "; 
        $sql .=" WHERE post_id='$p_id' ";

        $query = mysqli_query($connection, $sql);
        if(!$query){
          die("QUERY FAILED " . mysqli_error($connection));  
        }
        echo "<div class='bg-success'>Post Updated. <a href='../post.php?p_id={$p_id}'>View the Post</a> / <a href='posts.php'>Edit More Post</a></div>";
         
    }
        
}
?> 