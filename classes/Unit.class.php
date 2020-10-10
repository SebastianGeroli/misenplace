<?php

class Unit extends Dbh{

    protected function getUnit($unitID){
        $sql = "SELECT * FROM units WHERE unit_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$unitID]);
        $result = $stmt->fetch();
        return $result;
    }
    protected function getAllFromUnits(){
        $sql = "SELECT * FROM units";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function addUnit(){
        
    }
}