<?php
    require_once('Models/StoreManager.php');
    if(isset($_POST['DeteleForm'])){
        $manager = new StoreManager();
        $manager->DeleteProducts($_POST['ids']);      
        header("Location: index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>

    <!-- jquery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

    <!-- css -->
    <link rel="stylesheet" href="Styles/style.css" />

    <!-- bootstrap -->
    <link rel="stylesheet" href="Styles/bootstrap.min.css" />
</head>
<body>
    
    <div class="TitleDiv">
        <div class="nav">
            <h3>Product List</h3>
            <a href="add-product.php"><input type="button" value="ADD"/></a>
            <button  onclick=" if (GetIds()==true) document.forms['Delete'].submit()">MASS DELETE</button>
            <form name="Delete" method="post" action="index.php">  
                <input type="hidden" value="MASS DELETE"  name ="ids" id="IdsList" />
                <input type="hidden" name = "DeteleForm"/>
            </form>
        </div>
        <hr>
    </div>


    <div class="ListDiv">
        <div class="row">
            <?php
                $manager = new StoreManager();
                $listProducts = $manager->TakeProducts();
                if($listProducts!=null){
                    foreach ($listProducts as $product) {
                        echo '<div class="col-3 ">';
                        echo '<div class="InfoSquare">';
                        echo '<div class="DetailsSquare">';
                        echo '<p>'.$product->GetSKU().'</p>';
                        echo '<p>'.$product->GetName().'</p>';
                        echo '<p>'.number_format($product->GetPrice(), 2, '.', '').' $</p>';
                        echo '<p>'.$product->GetAttribute().' '.'</p>';
                        echo '<input type="hidden" name="id" value="'.$product->GetId().'"/>';
                        echo '</div>';
                        echo '<input type="checkbox" class="delete-checkbox"/>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>
    
    
    <div class="FooterDiv">
        <hr>
        <h3>Scandiweb Test Assignment</h3>
    </div>


    <script>
        function GetIds(){
            var list ="(";
            var i = 0;
            $(".InfoSquare").each(function() {
                
                if($(this).children('.delete-checkbox').is(':checked')){
                    if(i==0){
                        list +=$(this).children('.DetailsSquare').children('input').val();
                    }
                    else{
                        list +=",";
                        list +=$(this).children('.DetailsSquare').children('input').val();
                    }
                    i++;
                }
                
                
            });
            list +=")";
            console.log(list);
            $("#IdsList").val(list);

            return true;
        }
    </script>


</body>
</html>  
