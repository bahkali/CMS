<?php include "includes/header.php";?>
<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
           <?php 
                if(isset($_POST['submit'])){
                 $search = $_POST['search'];  
                 $sql= "SELECT * FROM post WHERE post_tags LIKE '%$search%'";
                 
                 $search_query = mysqli_query($connection, $sql);
                    //error handling
                    if(!$search_query){
                       die("Query FAILED" . mysqli_error($connection)); 
                    }
                    //check if get result from DB 
                    $count = mysqli_num_rows($search_query);
                    if($count == 0){
                        
                        echo "<h1> NO RESULT </h1>";
                    } else {
                        //Display the result post
                     while($row = mysqli_fetch_assoc($search_query)){
                           $post_title = $row['post_title'];
                           $post_author = $row['post_author'];
                           $post_date = $row['post_date'];
                           $post_image = $row['post_image'];
                           $post_content = $row['post_content'];
                           $post_tags = $row['post_tags'];
                           $post_comment_count = $row['post_comment_count'];
                           $post_status = $row['post_status'];
            ?>
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>

            <p class="lead">
                by <a href="index.php"><?php echo $post_author; ?></a>
            </p>

            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="http://placehold.it/900x300" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>

                   <?php }
                        
                    } 
                    
                }?>



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include"includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

   <?php include"includes/footer.php"; ?>