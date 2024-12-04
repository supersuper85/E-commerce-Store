<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Models/ProductModel.php');
class Book extends ProductModel{
    protected $Id;
    protected $SKU;
    protected $Name;
    protected $Price;

    protected $Weight;

    public function ValidateData(){
        if(parent::ValidateSku($this->SKU) && parent::ValidateName($this->Name) && parent::ValidatePrice($this->Price) && parent::ValidateNumber($this->Weight) ){
            return true;
        }
        return false;
    }
    public function TransformData(){
        return "Weight: ".$this->Weight." KG";
    }
    public function SetAttribute($dictionary){
        if(parent::ValidateNumber($dictionary["weight"])){
            $this->Weight=$dictionary["weight"];
        }
    }
}

?>