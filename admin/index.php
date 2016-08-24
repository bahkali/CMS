<?php include("includes/admin_header.php"); ?>

    <div id="wrapper">

       <?php include("includes/admin_nav.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                        <h1 class="page-header">
                            Welcom to Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> 
                                                                            
                        
                        <div class="row">
                           
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php 
                                                
                                                $sql= "SELECT * FROM post";
                                                $result = mysqli_query($connection, $sql);
                                                confirm($result);
                                                
                                                $num_post = mysqli_num_rows($result);
                                                
                                                ?>
                                          <div class='huge'><?php echo $num_post; ?></div>
                                                <div>Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="posts.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php 
                                                
                                                $sql= "SELECT * FROM comments";
                                                $result = mysqli_query($connection, $sql);
                                                confirm($result);
                                                
                                                $num_comments = mysqli_num_rows($result);
                                                
                                                ?>
                                             <div class='huge'><?php echo $num_comments;  ?></div>
                                              <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php 
                                                
                                                $sql= "SELECT * FROM users";
                                                $result = mysqli_query($connection, $sql);
                                                confirm($result);
                                                
                                                $num_users = mysqli_num_rows($result);
                                                
                                                ?>
                                            <div class='huge'><?php echo $num_users;  ?></div>
                                                <div> Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                               <?php 
                                                
                                                $sql= "SELECT * FROM categories";
                                                $result = mysqli_query($connection, $sql);
                                                confirm($result);
                                                
                                                $num_categories = mysqli_num_rows($result);
                                                
                                                ?>
                                                <div class='huge'><?php echo $num_categories; ?></div>
                                                 <div>Categories</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="categories.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.row end widget -->
                        <?php
                            $sql= "SELECT * FROM post WHERE post_status = 'published'";
                            $result = mysqli_query($connection, $sql);
                            confirm($result);
                            $num_post_published = mysqli_num_rows($result);
                        
                            $sql= "SELECT * FROM post WHERE post_status = 'draft'";
                            $result = mysqli_query($connection, $sql);
                            confirm($result);
                            $num_post_draft = mysqli_num_rows($result);
                        
                            $sql= "SELECT * FROM comments WHERE comments_status = 'unapproved'";
                            $result = mysqli_query($connection, $sql);
                            confirm($result);
                            $num_comments_unapproved = mysqli_num_rows($result);
                        
                            $sql= "SELECT * FROM users WHERE user_role = 'subscriber'";
                            $result = mysqli_query($connection, $sql);
                            confirm($result);
                            $num_users_subcriber = mysqli_num_rows($result);
                        ?>
                        <div class="row">
                           <script type="text/javascript">
                              google.charts.load('current', {'packages':['bar']});
                              google.charts.setOnLoadCallback(drawChart);
                              function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                  ['Date', 'Count'],
                                <?php
                                    
                                    $element_text = ['All Posts' ,'Active Posts', 'Draft Post', 'Comments', 'Pending Comments', 'Users', 'Subscriber Account', 'Categories'];
                                    $element_count = [$num_post , $num_post_published , $num_post_draft ,  $num_comments , $num_comments_unapproved ,  $num_users, $num_users_subcriber, $num_categories];
                                    
                                    for($i = 0; $i < 8; $i++){
                                        echo "['{$element_text[$i]}'" . ", " . "{$element_count[$i]} ],";
                                    }
                                ?>
                                    
                                  
                                 
                                ]);

                                var options = {
                                  chart: {
                                    title: '',
                                    subtitle: '',
                                  }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, options);
                              }
                            </script> 
                            
                            <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                        </div>
                        
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