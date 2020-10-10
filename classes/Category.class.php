<?php

class Category extends Dbh {
    
    protected function GetCategory($cat_id){
        $sql = "SELECT * FROM categories WHERE cat_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$cat_id]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function GetAllCategories()
    {
            $sql = "SELECT * FROM categories";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
    }
    protected function InsertCategory($cat_name,$cat_unit_id){
        $sql = "INSERT INTO categories(cat_name,cat_unit_id) VALUES (?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$cat_name,$cat_unit_id]);
    }
    protected function DeleteCategory($cat_id){
        $sql = "DELETE FROM categories WHERE cat_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$cat_id]);
    }
    protected function UpdateCategory( $cat_id,$cat_name,$cat_unit_id){
        $sql = "UPDATE categories SET 
        cat_name = :cat_name,
        cat_unit_id = :cat_unit_id
        WHERE cat_id = :id ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['cat_name' => $cat_name, 'cat_unit_id' => $cat_unit_id,'id' => $cat_id]);
    }
}