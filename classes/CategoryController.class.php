<?php

class CategoryController extends Category {
    
    public function AddNewCateory($cat_name,$cat_unit_id){
        $this->InsertCategory($cat_name,$cat_unit_id);
    }
    public function Delete($cat_id){
        $this->DeleteCategory($cat_id);
    }
    public function Update($cat_id,$cat_name,$cat_unit_id){
      $this->UpdateCategory($cat_id,$cat_name,$cat_unit_id);
    }
}