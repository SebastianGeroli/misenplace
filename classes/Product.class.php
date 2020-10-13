<?php
class Product extends Dbh
{
    #region CREATE

    //INSERT PRODUCT
    /**
     * Insert a new PRODUCT with prod_name and password
     * @param string $prod_name name or title
     * @param integer $prod_cat wich category is this product of
     * @param decimal(19,4) $prod_price the price
     * @param string $prod_descr detailed description
     * @param string $prod_image path of the image
     * @param date $prod_creation optional date of creation for this product
     * @param date $prod_last_mod optional last modification applied to this product    
     */
    protected function InsertNewProduct($prod_name, $prod_cat, $prod_price, $prod_descr, $prod_image)
    {
        $prod_creation = date("y-m-d");
        $prod_last_mod = date("y-m-d");
        $sql = "INSERT INTO products(prod_name,prod_cat,prod_price,prod_description,prod_image,prod_creation,prod_last_modification) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$prod_name, $prod_cat, $prod_price, $prod_descr, $prod_image, $prod_creation, $prod_last_mod]);
    }
    #endregion
    #region READ

    //GET ONE PRODUCT
    /**
     * Get a product information based on ID
     * @param integer $productID
     * @return assocArray with all the info of the product
     */
    protected function getProduct($productID)
    {
        $sql = "SELECT * FROM products WHERE prod_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productID]);
        $result = $stmt->fetch();
        return $result;
    }

    /** 
     * Get a column info for a product based on ID
     * @param string $columnName name of the column to query
     * @param integer $prod_ID ID of the product to query
     * @return $result  result of the query
     */
    protected function getColumnFromProductById($columnName, $prod_ID)
    {
        $column = "";
        //Switch for security
        switch ($columnName) {
            case 'prod_name';
                $column = 'prod_name';
                break;
            case 'prod_cat';
                $column = 'prod_cat';
                break;
            case 'prod_price';
                $column = 'prod_price';
                break;
            case 'prod_description';
                $column = 'prod_description';
                break;
            case 'prod_image';
                $column = 'prod_image';
                break;
            default:
                $column = 'prod_name';
                break;
        }
        $sql = "SELECT $column FROM products WHERE prod_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$prod_ID]);
        $result = $stmt->fetch();
        return $result;
    }

    //GET ALL PRODUCTS
    /**
     * Gets all info of all products
     * @return array with the result of the query
     * @throws PDOException 
     */
    protected function GetAllproducts()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //GET PRODUCTS WITH FILTER 1
    /**
     * Retrive all info from products with 1 column filter
     * @param string $column filter on this column
     * @param string $cValue filter column with this value
     */
    protected function GetAllProductsWith($column, $cValue)
    {
        $sql = "SELECT * FROM products WHERE $column = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$cValue]);
        $result = $stmt->fetchAll();
        return $result;
    }
    #endregion
    #region UPDATE

    //UPDATE PRODUCT
    /**
     * Update a product information
     * @param string $prod_name name or title
     * @param string $prod_cat category 
     * @param string $prod_price price
     * @param string $prod_descr detailed description
     * @param integer $prod_image path image
     * @param integer $productID id of this product
     */
    protected function UpdateProduct($prod_name, $prod_cat, $prod_price, $prod_descr, $prod_image, $productID)
    {
        $last_mod = date("y-m-d");
        $sql = "UPDATE products SET 
            prod_name = :prod_name, 
            prod_cat = :prod_cat, 
            prod_price = :prod_price, 
            prod_description = :prod_descr,
            prod_image = :prod_image,
            prod_last_modification = :last_mod
            WHERE prod_id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            'prod_name' => $prod_name,
            'prod_cat' => $prod_cat,
            'prod_price' => $prod_price,
            'prod_descr' => $prod_descr,
            'prod_image' => $prod_image,
            'last_mod' => $last_mod,
            'id' => $productID
        ]);
    }
    #endregion
    #region DELETE
    //DELETE PRODUCT
    /**
     * Deletes a products based on ID
     * @param mixed $prod_ID ID of the product to be deleted from DB
     * @throws PDOException 
     */
    protected function DeleteProduct($prod_ID)
    {
        $sql = "DELETE FROM products WHERE prod_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$prod_ID]);
    }
    #endregion 
}
