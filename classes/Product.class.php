<?php
class Product extends Dbh
{

    //GET ONE PRODUCT
    /**
     * Get a user based on ID
     * @param integer $productID
     * @return assocArray with all the info of the user
     */
    protected function getProduct($productID)
    {
        $sql = "SELECT * FROM products WHERE prod_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productID]);
        $result = $stmt->fetch();
        return $result;
    }
    //GET ALL PRODUCTS
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
    protected function InsertNewProduct($prod_name, $prod_cat, $prod_price, $prod_descr,$prod_image,$prod_creation = "now()",$prod_last_mod ="now()")
    {
        $sql = "INSERT INTO products(prod_name,prod_cat,prod_price,prod_description,prod_image,prod_creation,prod_last_modification) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$prod_name,$prod_cat,$prod_price,$prod_descr,$prod_image,$prod_creation,$prod_last_mod]);
    }

    //UPDATE PRODUCT
    /**
     * Update a product information
     * 
     * if password is empty or blank = "" will not be updated 
     * @param string $prod_name name or title
     * @param string $prod_cat category 
     * @param string $prod_price price
     * @param string $prod_descr detailed description
     * @param integer $prod_image path image
     * @param integer $productID id of this product
     */
    protected function UpdateUser($prod_name, $prod_cat, $prod_price, $prod_descr, $prod_image, $productID)
    {
            $sql = "UPDATE products SET 
            prod_name = :prod_name, 
            prod_cat = :prod_cat, 
            prod_price = :prod_price, 
            prod_description = :prod_descr,
            prod_image = :prod_image,
            prod_last_modification = :last_mod
            WHERE prod_id = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['prod_name' => $prod_name, 
            'prod_cat' => $prod_cat, 
            'prod_price' => $prod_price, 
            'prod_descr' => $prod_descr, 
            'prod_image' => $prod_image, 
            'last_mod' => "now()", 
            'id' => $productID]);
    }
}
