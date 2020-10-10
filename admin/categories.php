<?php include "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Categories Managment
                </h1>
                <div class="col-xs-6">

                    <?php
                    //ADD NEW CATEGORY 
                    if (isset($_POST['submit'])) {

                        //Get info from post
                        $cat_name = $_POST['cat_name'];
                        $prod_unit_id = $_POST['cat_unit_id'];

                        //Clean White Space
                        $cat_name = rtrim($cat_name);
                        $cat_name = ltrim($cat_name);

                        //Check if everthing is set up
                        if (!empty($cat_name) && !empty($prod_unit_id)) {

                            //Execute
                            $categoryController = new CategoryController();
                            $categoryController->AddNewCateory($cat_name, $prod_unit_id);
                            $success = true;
                        } else {
                            $success = false;
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <?php if (isset($success)) echo ($success) ? "<p class='bg-success'>Categoria Añadida</p>" : "<p class='bg-warning'>La categoria debe tener un nombre</p>"; ?>
                        <label for="cat_name">Agregar Nueva Categoria</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="cat_name" placeholder="Nombre de la Categoria">
                        </div>
                        <div class="form-group">
                            <label for="cat_unit_id">Unidad de Medida</label>
                            <select name="cat_unit_id" id="cat_unit_id">
                                <?php
                                //Get Units for options
                                $unitView = new UnitView();
                                $result = $unitView->getAllUnits();
                                foreach ($result as $row) {
                                    $unit_id = $row['unit_id'];
                                    $unit_name = $row['unit_name'];
                                    echo "<option value='{$unit_id}'>{$unit_name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Agregar Categoria">
                        </div>
                    </form>

                    <?php

                    // Get info to show in update form
                    if (isset($_GET['edit'])) :
                        $cat_id = $_GET['edit'];
                        $categoryView = new CategoryView();
                        $result = $categoryView->GetCategoryData($cat_id);
                        $cat_name = $result['cat_name'];
                        $cat_unit_id = $result['cat_unit_id'];

                        //Update Category Post
                        if (isset($_POST['edit'])) {
                            //Get Info from post
                            $cat_name = $_POST['cat_name'];
                            $cat_unit_id = $_POST['cat_unit_id'];

                            //Clean White Space
                            $cat_name = rtrim($cat_name);
                            $cat_name = ltrim($cat_name);

                            //Check All is Set
                            if (!empty($cat_name) && !empty($cat_unit_id)) {

                                //Execute
                                $categoryController = new CategoryController();
                                $result = $categoryController->Update($cat_id, $cat_name, $cat_unit_id);
                                $success = true;
                            } else {
                                $success = false;
                            }
                        }
                    ?>
                    <!-- FORM UPDATE CATEGORY -->
                        <form action="" method="post">
                            <?php if (isset($success)) echo ($success) ? "<p class='bg-success'>Categoria Editada Correctamente</p>" :  "<p class='bg-warning'>La categoria debe tener un nombre</p>"; ?>
                            <label for="cat_name">Editar Categoria</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="cat_name" value="<?php echo $cat_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="cat_unit_id">Unidad de Medida</label>
                                <select name="cat_unit_id" id="cat_unit_id">
                                    <?php
                                    //Get Units
                                    $unitView = new UnitView();
                                    $result = $unitView->getAllUnits();
                                    foreach ($result as $row) {
                                        $unit_id = $row['unit_id'];
                                        $unit_name = $row['unit_name'];
                                        if ($cat_unit_id == $unit_id) {
                                            echo "<option selected value='{$unit_id}'>{$unit_name}</option>";
                                        } else {
                                            echo "<option value='{$unit_id}'>{$unit_name}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit" value="Editar Categoria">
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
                <!-- CATEGORIES TABLE -->
                <div class="col-xs-6">
                    <?php
                    //Delete category selected
                    if (isset($_GET['delete'])) {
                        $cat_id = $_GET['delete'];
                        $categoryController = new CategoryController();
                        $categoryController->Delete($cat_id);
                    }
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Unidad de Medida</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            //GET ALL CATEGORIES
                            $categoryView = new CategoryView();
                            $result = $categoryView->GetAll();
                            foreach ($result as $row) :
                                $cat_id = $row['cat_id'];
                                $cat_name = $row['cat_name'];
                                $cat_unit_id = $row['cat_unit_id'];
                                $unit_name = $unitView->getUnitName($cat_unit_id);
                            ?>
                                <tr>
                                    <td><?php echo $cat_id; ?></td>
                                    <td><?php echo $cat_name; ?></td>
                                    <td><?php echo $unit_name; ?></td>
                                    <td><a href="categories.php?edit=<?php echo $cat_id ?>">Editar</a></td>
                                    <td><a href="categories.php?delete=<?php echo $cat_id; ?>">Borrar</a></td>
                                </tr>

                            <?php endforeach; ?>
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