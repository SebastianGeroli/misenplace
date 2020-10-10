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
                    case 'add_product':
                        echo "<h1 class='page-header'>Añadir Producto</h1>";
                        include "includes/add_product.inc.php";
                        break;
                    case 'edit_product':
                         echo "<h1 class='page-header'>Editar Producto</h1>";
                        include "includes/edit_post.php";
                        break;
                    default:
                          echo "<h1 class='page-header'>Todos los Productos</h1>";
                        include "includes/view_all_products.php";
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