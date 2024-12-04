<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Models/ProductModel.php');
class DVD extends ProductModel{
    protected $Id;
    protected $SKU;
    protected $Name;
    protected $Price;

    protected $Size;

    public function ValidateData(){
        if(parent::ValidateSku($this->SKU) && parent::ValidateName($this->Name) && parent::ValidatePrice($this->Price) && parent::ValidateNumber($this->Size)){
            return true;
        }
        return false;
    }
    public function TransformData(){
        return "Size: ".$this->Size." MB";
    }
    public function SetAttribute($dictionary){
        if(parent::ValidateNumber($dictionary["size"])){
            $this->Size=$dictionary["size"];
        }
    }
}

?>