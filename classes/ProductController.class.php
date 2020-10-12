<?php 
class ProductController extends Product{

    public function AddProductToDB($prod_name,$prod_cat,$prod_price,$prod_description,$prod_image){
        $this->InsertNewProduct($prod_name,$prod_cat,$prod_price,$prod_description,$prod_image);
        //returns Last id Added;
        return $this->connect()->lastInsertId();
    }
    public function UpdateProductByID($prod_name,$prod_cat,$prod_price,$prod_description,$prod_image,$prod_ID){
        $this->UpdateProduct($prod_name,$prod_cat,$prod_price,$prod_description,$prod_image,$prod_ID);
    }
    public function DeleteProductFromDB($prod_ID){
        $this->DeleteProduct($prod_ID);
    }

}