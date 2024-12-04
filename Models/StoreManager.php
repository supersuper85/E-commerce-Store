<?php
require_once('DatabaseConnection.php');
require_once('ProductDatabase.php');
require_once('Products/DVD.php');
require_once('Products/Furniture.php');
require_once('Products/Book.php');
class StoreManager{
    public function TakeProducts(){
        $database =  new DatabaseConnection();
        $result = $database->SelectProductsQuery();
        $listProducts = [];   
        while($row = mysqli_fetch_array($result)) {
            $product = new ProductDatabase();
            $product->SetId($row["Id"]);
            $product->SetSKU($row["SKU"]);
            $product->SetName($row["Name"]);
            $product->SetPrice($row["Price"]);
            $product->SetAttribute($row["Attribute"]);

            $listProducts[] = $product;
        }
        return $listProducts;
    }
    public function AddProduct($sku, $name, $price, $size, $height, $width, $length, $weight, $typeSwitcher){
        /* AddProduct Status Codes

        return 0 = Success
        return 1 = Strange error
        return 2 = Dublicate error

        return 51 = Validation error
     
        */
        if($typeSwitcher == "DVD" || $typeSwitcher == "Furniture" || $typeSwitcher == "Book")
        {
            $product = new $typeSwitcher();
            $product->SetSKU($sku);
            $product->SetName($name);
            $product->SetPrice($price);
            $AttributeDictionary = array(
                "size" => $size,
                "height" => $height,
                "width" => $width,
                "length" => $length,
                "weight" => $weight,
            );
            $product->SetAttribute($AttributeDictionary);

            $check = $product->ValidateData();
            if($check){
                $attribute = $product->TransformData();
                $database =  new DatabaseConnection();
                $codeResult = $database->AddProductQuery($sku, $name, $price, $attribute);
                return $codeResult;
                
            }
            return 51;
            
        }
        return 1;
    }
    public function DeleteProducts($list){
        $check = true;
        for ($i = 0; $i <= strlen($list)-1; $i++) {
            if($list[$i]!="(" && $list[$i]!=")" && $list[$i]!="," && !is_numeric($list[$i])){
                $check = false;
                break;
            }
        }
        if($list!="()" && $check){
            $database =  new DatabaseConnection();
            $database->DeleteProductsQueryByList($list);
        }
    }
}

?>