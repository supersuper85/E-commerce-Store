<?php
require_once('Validations.php');
abstract class ProductModel extends Validations {
    protected $Id;
    protected $SKU;
    protected $Name;
    protected $Price;

    public abstract function ValidateData();
    public abstract function TransformData();
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
    public abstract function SetAttribute($dictionary);
}

?>