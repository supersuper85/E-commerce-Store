<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Models/ProductModel.php');
class Furniture extends ProductModel{
    protected $Id;
    protected $SKU;
    protected $Name;
    protected $Price;

    protected $Height;
    protected $Width;
    protected $Length;

    public function ValidateData(){
        if(parent::ValidateSku($this->SKU) && parent::ValidateName($this->Name) && parent::ValidatePrice($this->Price) && parent::ValidateNumber($this->Height) && parent::ValidateNumber($this->Width) && parent::ValidateNumber($this->Length)){
            return true;
        }
        return false;
    }
    public function TransformData(){
        return "Dimension: ".$this->Height."x".$this->Width."x".$this->Length;
    }

    public function SetAttribute($dictionary){
        if(parent::ValidateNumber($dictionary["height"]) && parent::ValidateNumber($dictionary["width"]) && parent::ValidateNumber($dictionary["length"])){
            $this->Height=$dictionary["height"];
            $this->Width=$dictionary["width"];
            $this->Length=$dictionary["length"];
        }
    }
}

?>