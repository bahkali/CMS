<?php

    if(isset($_POST['checkBokArray'])){
        
        foreach($_POST['checkBokArray'] as $postValueId){
           $bulk_options = $_POST['bulk_options'];
           
            switch($bulk_options){
                   case 'published':
                        $query = "UPDATE post SET post_status = '{$bulk_options}' WHERE post_id={$postValueId}";
                        $result = mysqli_query($connection, $query );
                        confirm($result);
                    break;
                    case 'draft':
                        $query = "UPDATE post SET post_status = '{$bulk_options}' WHERE post_id={$postValueId}";
                        $result = mysqli_query($connection, $query );
                        confirm($result);
                    break;
                    case 'delete':
                        $query = "DELETE FROM post WHERE post_id={$postValueId}";
                        $result = mysqli_query($connection, $query );
                        confirm($result);
                    break;
            }
        }
        
        
    }
?>
<form action="" method="post">

<table class="table table-bordered table-hover">
  
   <div id="bulkOptionsContainer" class="col-xs-4">
       <select name="bulk_options" id="" class="form-control">
           <option value="">Select option</option>
           <option value="published">Publish</option>
           <option value="draft">Draft</option>
           <option value="delete">Delete</option>
       </select>
   </div>
   <div class="col-xs-4">
       <input type="submit" name="submit" class="btn btn-success" value="Apply">
       <a class="btn btn-primary" href="add_post.php">Add New</a>
   </div>
   <br>
    <thead>
        <tr>
            <th><input type="checkbox" id="selectAll" ></th>
            <th>Post Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php display_table_post(); ?>
        
        <?php
            //delete posts
            delete_post();
        ?>
    </tbody>
</table>
</form>