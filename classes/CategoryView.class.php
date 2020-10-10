<?php

class CategoryView extends Category {
    
    public function GetAll(){
       $result = $this->GetAllCategories();
        return $result;
    }

    public function GetCategoryData($cat_id){
        $result = $this-> GetCategory($cat_id);
        return $result;
    }
}