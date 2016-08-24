
<?php include "includes/header.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <?php
                    if(isset($_GET['p_id'])){
                   $p_id = $_GET['p_id'];
                    }
                   $sql = "SELECT * FROM post WHERE post_id ={$p_id}";
                
                   $select_all_posts = mysqli_query($connection, $sql);

                   $row = mysqli_fetch_assoc($select_all_posts);
                        
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
                <?php 
                    
                        if(isset($_SESSION['user_role'])){
                            if(isset($_GET['p_id'])){
                                $p_id = $_GET['p_id'];
                                echo "<p>" ;
                                echo "<a href='admin/posts.php?source=edit_post&p_id={$p_id}'>Edit Post</a>";
                                echo '</p>';
                            }
                        }
                    
                    ?>
                <hr>
                <img class="img-responsive" src="<?php echo './images/'.$post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
               
                <hr>
               
                <!-- Blog Comments -->

               <?php
                
                if(isset($_POST['create_comment'])){
                     $postID = $_GET['p_id'];
                     $author = $_POST['comment_author'];
                     $email = $_POST['comment_email'];
                     $content = $_POST['comment_content'];
                    
                    $sql = "INSERT INTO comments (comments_post_id ,comments_author, comments_email, comments_content, ";
                    $sql .= "comments_status, comments_date )";
                    $sql .= " VALUES('$postID', '$author', '$email', '$content', 'Unapproved', now()) ";
                    $query = mysqli_query($connection, $sql);
                    
                    if(!$query){
                       die("QUERY FAILED " . mysqli_error($connection)); 
                    }
                    $query2 = "UPDATE post SET post_comment_count = post_comment_count + 1 WHERE post_id = '$postID'";
                    $result= mysqli_query($connection, $query2);
                     if(!$result){
                       die("QUERY FAILED " . mysqli_error($connection)); 
                    }
                }
                
                ?>
                 <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="comment_author" placeholder="Name" >
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="comment_email"  placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content" placeholder="Comment..."></textarea>
                        </div>
                        <button type="submit"  name="create_comment" dropzone=""class="btn btn-primary">Submit</button>
                    </form> 
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                 <?php
                    $postID = $_GET['p_id'];
                    $sql = "SELECT * FROM comments WHERE comments_post_id='$postID' ";
                    $sql .= "AND comments_status ='approved' ";
                    $sql .= "ORDER BY comments_id DESC";
                    
                    $query= mysqli_query($connection, $sql);
                    
                    if(!$query){
                       die("QUERY FAILED " . mysqli_error($connection)); 
                    }
                    
                    while($r = mysqli_fetch_assoc($query)){
                        
                        $comments_author = $r['comments_author'];
                        $comments_content = $r['comments_content'];
                        $comments_date = $r['comments_date'];
                      ?>
                    <div class="media">

                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comments_author ; ?>
                                <small><?php echo $comments_date; ?></small>
                            </h4>
                            <?php echo $comments_content; ?>
                        </div>

                    </div>
                  <?php
                    }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
             
            <?php include"includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

         <?php include"includes/footer.php"; ?>