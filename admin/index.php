<?php include "includes/admin_header.php"; ?>


<!-- Navigation -->
<?php include "includes/admin_navigation.php";?>

<div id="page-wrapper">
    <?php
    $conn = openConnection();
    ?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to admin 
                    <small><?php if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
}  else{
    echo "Admin Not Logged";
}
                        ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->

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
                                $query = "SELECT COUNT(prod_id) FROM products";
                                $products_count_query = mysqli_query($conn,$query);
                                confirmQuery($products_count_query,$conn);
                                $result = mysqli_fetch_array($products_count_query);
                                $total_products = $result[0];
                                
                                ?>
                                <div class='huge'><?php echo $total_products; ?></div>
                                <div>Productos</div>
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
                            <?php 
                            $query = "SELECT COUNT(cat_id) FROM categories";
                            $categories_count_query = mysqli_query($conn,$query);
                            confirmQuery($categories_count_query,$conn);
                            $result = mysqli_fetch_array($categories_count_query);
                            $total_categories = $result[0];

                            ?>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $total_categories; ?></div>
                                <div>Categorias</div>
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
                            <?php 
                            $query = "SELECT COUNT(user_id) FROM users";
                            $users_count_query = mysqli_query($conn,$query);
                            confirmQuery($users_count_query,$conn);
                            $result = mysqli_fetch_array($users_count_query);
                            $total_users = $result[0];

                            ?>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $total_users; ?></div>
                                <div>Usuarios</div>
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
                            <?php 
                            $query = "SELECT COUNT(news_id) FROM news";
                            $news_count_query = mysqli_query($conn,$query);
                            confirmQuery($news_count_query,$conn);
                            $result = mysqli_fetch_array($news_count_query);
                            $total_news = $result[0];

                            ?>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $total_news; ?></div>
                                <div>Novedades</div>
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
        <!-- /.row -->
        <div class="row">
            <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Total'],
                        <?php 
                        $query = "SELECT COUNT(post_id) FROM posts WHERE post_status = 'draft'";
                        $select_draft_post = mysqli_query($connection,$query);
                        $result = mysqli_fetch_array($select_draft_post);
                        $draft_post = $result[0];
                        $query = "SELECT COUNT(post_id) FROM posts WHERE post_status = 'published'";
                        $select_published_post = mysqli_query($connection,$query);
                        $result = mysqli_fetch_array($select_published_post);
                        $published_post = $result[0];
                        $query = "SELECT COUNT(comment_id) FROM comments WHERE comment_status = 'Unapproved'";
                        $select_unapproved_comments = mysqli_query($connection,$query);
                        $result = mysqli_fetch_array($select_unapproved_comments);
                        $unapproved_comments = $result[0];
                        $query = "SELECT COUNT(user_id) FROM users WHERE user_role = 'Subscriber'";
                        $select_subscribers = mysqli_query($connection,$query);
                        $result = mysqli_fetch_array($select_subscribers);
                        $subscribers = $result[0];




                        $element_text = ['Total posts','Published Posts','Draft Posts', 'Total Comments','Pending comments','Users','Subscribers','Categories'];
                        $element_count=[$total_post,$published_post,$draft_post, $total_comments,$unapproved_comments,$total_users,$subscribers, $total_categories];

                        for($i = 0;$i < count($element_text);$i++ ){
                            echo "['{$element_text[$i]}', {$element_count[$i]}],";
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

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>