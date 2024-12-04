<?php

class DatabaseConnection{

    public function SelectProductsQuery(){
        $mysqli=null;
        try{
            $mysqli = new MySQLi("sql11.freesqldatabase.com","sql11460802", "cxy64u9fKQ", "sql11460802");
            $query = "Select * From Products;";
            $result = mysqli_query($mysqli, $query); 
        

            return $result;
        }
        finally{
            $mysqli->close();
        }
         
    }
    public function DeleteProductsQueryByList($list){
        $mysqli=null;
        try{
            $mysqli = new MySQLi("sql11.freesqldatabase.com","sql11460802", "cxy64u9fKQ", "sql11460802");
            $query = "Delete From Products Where Id In ".$list.";";
            mysqli_query($mysqli, $query);
        }
        finally{
            $mysqli->close();
        }
        
    }
    public function AddProductQuery($sku, $name, $price, $attribute){
        /* AddProduct Status Codes

        return 0 = Success
        return 1 = Strange error
        return 2 = Dublicate error
     
        */
        $mysqli=null;
        try {
            $mysqli = new MySQLi("sql11.freesqldatabase.com","sql11460802", "cxy64u9fKQ", "sql11460802");
        } 
        catch (Exception $e) {
            return 1;
        }

        
        $query ="Insert Into Products( `SKU`, `Name`, `Price`, `Attribute`) VALUES ('".$sku."','".$name."',".$price.",'".$attribute."');";
        $result = mysqli_query($mysqli, $query);
        
        
        if(!$result){
            if(mysqli_errno($mysqli) == "1062"){
                return 2;
            }
            return 1;
        }
        
        $mysqli->close();
        return 0;

    }
    
}

?>