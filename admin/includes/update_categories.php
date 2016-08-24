<form action="" method="post">
   <div class="form-group">
      <label for="cat_title">Edit Category</label>

      <?php
       if(isset($_GET['edit'])){
           $cat_id = $_GET['edit'];
           $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
           $select_category = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select_category))
           {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

               ?>
          <input type="text" class="form_control"  value="<?php if(isset($cat_title)){ echo $cat_title;} ?>" name="cat_title"> 

       <?php
           }
       }
       ?>

       <?php 
       /////// UPDATE CATEGORY

            if(isset($_POST['Update_Category'])){
                $cat_title = $_POST['cat_title'];
                $sql = " UPDATE categories SET cat_title='{$cat_title}' WHERE cat_id={$cat_id}";
                $query = mysqli_query($connection, $sql);

                if(!$query){
                  die("QUERY FAILED" . mysqli_error($connection));  
                }

            } 
       ?>
   </div>
   <div class="form-group">
       <input class="btn btn-primary" type="submit" name="Update_Category" value="Update Category">
   </div>
</form>
