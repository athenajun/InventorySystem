<?php 
    include_once("dbconnect.php");
    include_once("pie_data.php");


    $errorMessage ="";
    $formValid = "";
    if(isset($_POST['add-product'])){
        $name = $_POST['name']; 
        $quantity = $_POST['quantity']; 
        $expiry_date = $_POST['expiry_date']; 
        $category = $_POST['category'];
        $expiry_date = str_replace('T', ' ', $expiry_date);


    

        if($category === "null-category"){
            $errorMessage = "Please Choose the valid Category";
        }else{

            $categoryTable = $category;
    
            $queryRestock = "INSERT INTO  `$categoryTable` (name, quantity, expiry_date, category) VALUES ('$name', $quantity, '$expiry_date', '$category')";
            mysqli_query($connection, $queryRestock);

             $formValid = "ADD SUCCESSFULLY";
             
        }
        
    }

    


   



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restock</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex w-full items-center gap-[30%] h-screen">
    <aside class="w-[15%] bg-[#001D22] text-white flex flex-col h-full">
    <div class="w-10 h-10 bg-[#D0D0D0] rounded-full ml-5 mt-5">
            <img src="coffee1.jpg" alt="Coffee Shop Logo" class="w-full h-full rounded-full" />
        </div>
            <div class="flex flex-col justify-between h-full pt-10">
                <nav class="flex flex-col">
                    <a href="index.php" class="font-semibold pl-3 py-2 hover:bg-white hover:text-black  ">Dashboard</a>
                    <a href="view_inventory.php" class="font-semibold   pl-3 py-2 hover:bg-white hover:text-black  ">View inventory</a>
                    <a href="restock.php" class="font-semibold  pl-3 py-2 hover:bg-white hover:text-black  ">Restock</a>
                </nav>

                <a class="m-5 bg-white text-black w-20 text-center p-2 rounded-full font-semibold hover:bg-[#DFDFDF]" href="login.php"><button>Logout</button></a>
            </div>
    </aside>

    <div class="">
        
        
        <form action="" method="post" class="flex flex-col gap-10 py-10 px-[100px] bg-[#001D22] text-white rounded-lg relative">
            <p class="text-center uppercase text-xl tracking-wider font-semibold">Add Product</p>
            <span class="text-red-500  text-center absolute left-[9rem] top-20"><?=$errorMessage?></span>
            <span class="text-green-500 text-center"><?=$formValid?></span>

            <label>Product name: <input class="border-[1px] border-black rounded-lg px-2 text-black w-full" type="text" name="name" required></label>
            <label>Quantity: <input class="border-[1px] border-black rounded-lg px-2 text-black w-full" type="text" name="quantity" required></label>

            <label>Expiry Date:  <input class="border-[1px] border-black rounded-lg px-2 text-black w-full" type="datetime-local" name="expiry_date" id=""> </label>
            <label>Choose Category: <select class="border-[1px] border-black rounded-lg px-2 text-black" name="category">
                        <option value="null-category">Choose Category</option>
                        <?php foreach ($tables as $table) { ?>
                            <option value="<?=$table?>"><?=strtoupper($table)?></option>
                        <?php } ?>
                    </select>
            </label>

                <input class="bg-white text-black p-2 font-semibold hover:bg-[#DFDFDF] rounded-xl" type="submit" value="Add Product" name="add-product">
            
        </form>
    </div>

    



</body>
</html>