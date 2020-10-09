<?php include "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php include "includes/admin_navigation.php";?>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Categories Managment
                </h1>
                <div class="col-xs-6">

                    <?php insert_categories(); ?>
                    <form action="" method="post">
                        <label for="cat_title">Add Category</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="cat_title" placeholder="Category Title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                    </form>
                    
                    <?php // UPDATE CATEGORY 
                    include "includes/update_categories.php";?>
                </div>
                <!--Add Category Form-->
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>EDIT</th>
                                <th>DANGER ZONE</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php //SHOW CATEGORIES 
                            find_show_all_categories(); ?>
                            <?php //DELETE CATEGORY
                            delete_category();?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>