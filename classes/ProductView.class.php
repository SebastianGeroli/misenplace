<?php
class ProductView extends Product
{

    public function AllProducts()
    {
        $result = $this->GetAllproducts();
        return $result;
    }
    public function GetProductByID($prod_ID){
        $result = $this->getProduct($prod_ID);
        return $result;
    }
    public function getValueByColumnAndID($column,$id){
        $result =  $this->getColumnFromProductById($column,$id);
        return $result;
    }
}
