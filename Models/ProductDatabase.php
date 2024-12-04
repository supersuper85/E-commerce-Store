<?php
require_once('Validations.php');
class ProductDatabase extends Validations {
    private $Id;
    private $SKU;
    private $Name;
    private $Price;

    private $Attribute;
    
    public function GetId(){
        return $this->Id;
    }
    public function GetSKU(){
        return $this->SKU;
    }
    public function GetName(){
        return $this->Name;
    }
    public function GetPrice(){
        return $this->Price;
    }
    public function GetAttribute(){
        return $this->Attribute;
    }

    public function SetId($id){
        $this->Id = $id;
    }
    public function SetSKU($sku){
        if(parent::ValidateSku($sku)){
            $this->SKU=$sku;
        }
    }
    public function SetName($name){
        if(parent::ValidateName($name)){
            $this->Name=$name;
        }
    }
    public function SetPrice($price){
        if(parent::ValidatePrice($price)){
            $this->Price=$price;
        }
    }
    public function SetAttribute($attribute){
        $this->Attribute=$attribute;     
    }
}

?>