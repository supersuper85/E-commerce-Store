<?php
    require_once('Models/StoreManager.php');
    $error = 0;
    if(isset($_POST['AddFormTrigger'])){
        $manager = new StoreManager();
        $error = $manager->AddProduct($_POST['SKU'],$_POST['Name'],$_POST['Price'],$_POST['size'],$_POST['height'],$_POST['width'],$_POST['length'],$_POST['weight'],$_POST['product']);
        if($error==0){
            header("Location: index.php");
            die();
        } 
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h3>Product Add</h3>
            <button  onclick="document.forms['AddForm'].submit()">Save</button>
            <a href="index.php"><input type="button" value="Cancel"/></a>
        </div>  
        <hr>
    </div>
    <?php

        if(isset($_POST['AddFormTrigger'])){
            echo "<div class='ErrorDesign'>";
            if($error==1){
                echo "<h4>A strange error occurred, please try again later!</h4>";
            }
            else if($error==2){
                echo "<h4>This SKU code already exists in the system! Please enter another SKU!</h4>";
            }
            else if($error==51){
                echo "<h4>The data entered is incorrect or non-existent! Please recheck the information!</h4>";
            }
            else{
                echo "<h4>A strange error occurred, please try again later!</h4>";
            }
            echo "</div>";
        }
        
    ?>

    <div class="FormDiv">
        <form id="product_form" name="AddForm" method="post" action="add-product.php">
            <div class="InputField">
                <p>SKU </p>
                <input type = "text" name = "SKU" id = "sku"/> 
            </div>
            <div class="InputField">
                <p>Name </p>
                <input type = "text" name = "Name" id = "name"/> 
            </div>
            <div class="InputField">
                <p>Price ($) </p>
                <input type = "text" name = "Price" id = "price"/> 
            </div>
            <br><br>
            <div class="SwitcherField">
                <p>Type Switcher </p>
                <select name="product" id="productType" autocomplete = "off">
                    <option value="DVD" id="DVD" selected="selected">DVD</option>
                    <option value="Furniture" id="Furniture">Furniture</option>
                    <option value="Book" id="Book">Book</option>
                </select>
            </div>
            <br><br>
            <div id="DVDDiv">
                <div class="InputField">
                    <p>Size (MB) </p>
                    <input type = "text" name = "size" id = "size"/> 
                </div>
                <p class="ProductDescription">Enter the file size (MB) in the input.</p>
            </div>
            <div id="FurnitureDiv" hidden>
                <div class="InputField">
                    <p>Height (CM) </p>
                    <input type = "text" name = "height" id = "height"/> 
                </div>
                <div class="InputField">
                    <p>Width (CM) </p>
                    <input type = "text" name = "width" id = "width"/> 
                </div>
                <div class="InputField">
                    <p>Length (CM) </p>
                    <input type = "text" name = "length" id = "length"/> 
                </div>
                <p class="ProductDescription">Enter the height, width, and length (CM) of the product into the inputs.</p>
            </div>
            <div id="BookDiv" hidden>
                <div class="InputField">
                    <p>Weight (KG) </p>
                    <input type = "text" name = "weight" id = "weight"/> 
                </div>
                <p class="ProductDescription">Enter the weight of the book (KG) in the input.</p>
            </div>
            <input type="hidden" name="AddFormTrigger"/>
        </form>
    </div>
    <div class="FooterDiv">
        <hr>
        <h3>Scandiweb Test Assignment</h3>
    </div>

    <script>
        $("#productType").change(function() {
            var $option = $(this).find('option:selected');
            var value = $option.val();
            
            if(value=="DVD"){
                $("#DVDDiv").removeAttr("hidden");
                $("#FurnitureDiv").attr("hidden", true);
                $("#BookDiv").attr("hidden", true);
            }
            else if(value=="Furniture"){
                $("#DVDDiv").attr("hidden", true);
                $("#FurnitureDiv").removeAttr("hidden");
                $("#BookDiv").attr("hidden", true);
            }
            else if(value=="Book"){
                $("#DVDDiv").attr("hidden", true);
                $("#FurnitureDiv").attr("hidden", true);
                $("#BookDiv").removeAttr("hidden");
            }
        });

        
        window.onunload = function(){
            $("#productType").val("DVD");
        }
        
    </script>
</body>
</html>