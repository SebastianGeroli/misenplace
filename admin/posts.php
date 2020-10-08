<?php include "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php include "includes/admin_navigation.php";?>
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <?php 
                if(isset($_GET['source'])){
                    $source = $_GET['source'];
                    
                }else{
                    $source = '';
                }
                switch($source){
                    case 'add_post':
                        echo "<h1 class='page-header'>Add Post</h1>";
                        include "includes/add_post.php";
                        break;
                    case 'edit_post':
                         echo "<h1 class='page-header'>Edit Post</h1>";
                        include "includes/edit_post.php";
                        break;
                    default:
                          echo "<h1 class='page-header'>View All Posts</h1>";
                        include "includes/view_all_posts.php";
                        break;
                }
                ?>


            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>