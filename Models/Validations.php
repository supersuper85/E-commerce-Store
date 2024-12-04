<?php

class Validations {
    public function ValidateName($string){
        if(empty($string)){
            return false;
        }
        return true;
    }
    public function ValidateSku($string){
        if(!empty($string) && strlen($string) > 0){
            return true;
        }
        return false;    
    }
    public function ValidatePrice($string){
        if(empty($string)){
            return false;
        }
        $Splits = explode(".",$string);

        if(count($Splits) == 1){
            return $this->ValidateNumber($Splits[0]);
        }
        else if(count($Splits) == 2){
            if(strlen($Splits[0])==0 || strlen($Splits[1])==0){
                return false;
            }

            $check1 = true;
            $check2 = true;

            for ($i = 0; $i <= strlen($Splits[0])-1; $i++) {
                if(!is_numeric($Splits[0][$i]))  {
                    $check1 = false;
                    break;
                }
            }
            for ($i = 0; $i <= strlen($Splits[1])-1; $i++) {
                if(!is_numeric($Splits[1][$i]))  {
                    $check2 = false;
                    break;
                }
            }

            if($check1 && $check2){
                return true;
            }
        }
        return false;
        
    }
    public function ValidateNumber($string){
        if(empty($string)){
            return false;
        }
        for ($i = 0; $i <= strlen($string)-1; $i++) {
            if(!is_numeric($string[$i]))  {
                return false;
                break;
            }
        }
        return true;
    }
}

?>