<?php
    
     if(isset($_POST['create_post'])){
         
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_content = htmlentities($_POST['post_content']);
         
        $post_image =  $_FILES['post_image']['name'];
        $post_image_temp =  $_FILES['post_image']['tmp_name'];
         
        $post_tags = $_POST['post_tags'];
         
        
         
//        $post_comments_count = 4;
         
        $post_date = date('d-m-y');
        
        $moveResult =  move_uploaded_file($post_image_temp, "../images/$post_image");
         
          //insert the value in the database
          $sql = "INSERT INTO post ( post_title, post_author, post_category_id, post_status,  post_content, post_image,  post_tags,  post_date )";
          $sql .= " VALUES('$post_title', '$post_author', '$post_category_id', '$post_status', '$post_content','$post_image', '$post_tags', now())";
         
          $query = mysqli_query($connection, $sql);
         
         if(!$query){
                  die("QUERY FAILED " . mysqli_error($connection));  
         }
        
         header("Location: posts.php?source='add_post'");
       }

?>
<form method="post" enctype="multipart/form-data" >
    <div class="form-group">
        <label >Post Title</label>
        <input type="text" class="form-control" name="post_title" required>
    </div>
    
    <div class="form-group">
        <label >Post Category Id </label>
        <input type="text" class="form-control" name="post_category_id" required>
    </div>
    
    <div class="form-group">
        <label>Post Author</label>
        <input type="text" class="form-control" name="post_author" required>
    </div>
    
    
    <div class="form-group">
        <label >Post status</label>
        <input type="text" class="form-control" name="post_status" required>
    </div>
    
    <div class="form-group">
        <label >Post Image</label>
        <input type="file" name="post_image">    
    </div>
    
    <div class="form-group">
        <label>Post Tags</label>
        <input type="text" class="form-control" name="post_tags" required>
    </div>
    
    <div class="form-group">
        <label>Post Content</label>
        <textarea  class="form-control" name="post_content" required></textarea>
    </div>
    <input type="submit" name="create_post" class="btn btn-primary" value="Submit">
</form>