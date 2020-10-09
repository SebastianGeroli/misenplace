<?php
class ProductView extends Product
{

    public function AllProducts()
    {
        $result = $this->GetAllproducts();
        return $result;
    }
}
