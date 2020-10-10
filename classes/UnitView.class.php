<?php

class UnitView extends Unit{
    
    public function getUnitName($unitID){
        try{
            $result = $this->getUnit($unitID);
            return $result['unit_name'];
        }catch(Exception $e){
            echo "Exception: ". $e->getMessage();
        }
    }

    public function getAllUnits(){
        $result = $this->getAllFromUnits();
        return $result;
    }

}