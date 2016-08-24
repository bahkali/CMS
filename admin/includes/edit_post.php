
<?php 
    
    $p_id = $_GET['p_id'];
    
    $query = "SELECT * FROM post WHERE post_id= {$p_id}";
    $select_post = mysqli_query($connection, $query);
    
     while($row = mysqli_fetch_assoc($select_post))
     {
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_cat = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
     }
?>

<?php update_post(); ?>
<form method="post" enctype="multipart/form-data" >
    <div class="form-group">
        <label for="cat_title">Post Title</label>
        <input type="text" class="form-control" value="<?php echo $post_title; ?>" name="post_title" required>
    </div>
    
    <div class="form-group">
        <select name="post_category" id="">
            <?php 
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);

                 while($row = mysqli_fetch_assoc($select_categories))
                {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}<option>";
                }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_title">Post Author</label>
        <input type="text" class="form-control" value="<?php echo $post_author; ?>" name="post_author" required>
    </div>
    
    <div class="form-group">
        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
                if($post_status == 'draft'){
                    echo "<option value='published'>Published</option>";
                }else{
                    echo "<option value='draft'>Draft</option>";
                }
            ?>
        </select>
    </div>
    

    
    <div class="form-group">
        <label for="post_title">Post Image</label>
        <input type="file"  name="post_image">
        
    </div>
    
    <div class="form-group">
        <label for="post_title">Post Tags</label>
        <input type="text" class="form-control" value="<?php echo $post_tags;?>" name="post_tags" required>
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea  class="form-control" name="post_content" id="" cols="30" rows="10" required><?php echo $post_content;?></textarea>
    </div>
    <input type="submit" name="update_post" class="btn btn-primary" value="Edit">
</form>


