<?php
if (isset($_POST['checkBoxArray'])) {
    $productController = new ProductController();
    $productView = new ProductView();
    foreach ($_POST['checkBoxArray'] as $prod_id) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'published':
                break;
            case 'draft':
                break;
            case 'clone':
                //Get info from DB
                $result = $productView->GetProductByID($prod_id);

                //Save info
                $prod_name = $result['prod_name'];
                $prod_cat = $result['prod_cat'];
                $prod_price = $result['prod_price'];
                $prod_description = $result['prod_description'];
                $prod_image = $result['prod_image'];
                $prod_creation = $result['prod_creation'];
                $prod_last_modification = $result['prod_last_modification'];

                //Insert info as new product
                $productController->AddProductToDB($prod_name,$prod_cat,$prod_price,$prod_description,$prod_image);
                break;
            case 'delete':
                $productController->DeleteProductFromDB($prod_id);
                break;
            default:
                echo "No Action Selected";
                break;
        }
    }
}

//DELETE SINGLE PRODUCT
if (isset($_GET['delete'])) {
    $prod_ID = $_GET['delete'];
    $productController = new ProductController();
    $productController->DeleteProductFromDB($prod_ID);
}


?>


<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="default" selected hidden>Select Action</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" class="btn btn-success" value="Aplicar accion">
            <a class="btn btn-primary" href="products.php?source=add_product">Añadir Nuevo Producto</a>
        </div>
        <thead>
            <tr>
                <th><input id="SelectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Dscripcion</th>
                <th>Imagen</th>
                <th>Fecha Creacion</th>
                <th>Fecha Ultima Modificacion</th>
                <th>Ver Pagina del Producto</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <?php
        $productView = new ProductView();
        $result = $productView->AllProducts();
        $categoryView = new CategoryView();

        echo "<tbody>";
        foreach ($result as $row) {
            $prod_id = $row['prod_id'];
            $prod_name = $row['prod_name'];
            $prod_cat = $row['prod_cat'];
            $prod_price = $row['prod_price'];
            $prod_description = $row['prod_description'];
            $prod_image = $row['prod_image'];
            $prod_creation = $row['prod_creation'];
            $prod_last_modification = $row['prod_last_modification'];
            $category_name =  $categoryView->GetCategoryData($prod_cat)['cat_name'];

            echo "<tr>";
            echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$prod_id}'></td>";
            echo "<td>{$prod_id}</td>";
            echo "<td>{$prod_name}</td>";
            echo "<td>{$category_name}</td>";
            echo "<td>{$prod_price}</td>";
            echo "<td>{$prod_description}</td>";
            echo "<td><img width='100' src='../img/{$prod_image}' alt='image'></td>";
            echo "<td>{$prod_creation}</td>";
            echo "<td>{$prod_last_modification}</td>";
            echo "<td><a href='../product.php?product_id={$prod_id}'>Ver pagina del producto</a></td>";
            echo "<td><a href='products.php?source=edit_product&product_id={$prod_id}'>Editar</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this product?') \" href='products.php?delete={$prod_id}'>Borrar</a></td>";
            echo "</tr>";
        }
        echo "<tbody>";

        ?>
</form>