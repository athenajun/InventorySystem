<?php

    require "dbconnect.php";
    require "pie_data.php";
    // Optionally set the time zone
    date_default_timezone_set('Asia/Manila');

    // Get the current date and time
    $currentDateTime = date('Y-m-d H:i:s');

  


    
    $tableCategory= "";
    if (isset($_POST['table-category']) && $_POST['table-category'] !== 'null-category') {
        $selectedCategory = $_POST['table-category'];
        $tableCategory = $selectedCategory;

    }

        if (isset($_POST['getItem-btn'])) {
            $itemId = $_POST['item-id'];
            $quantity = $_POST['quantity-item'];
            $category = $_POST['category'];
            
            if($quantity == 0 || empty($quantity)){

            }else{
                $queryUpdate = "UPDATE $category set quantity = quantity-$quantity WHERE  id = $itemId";
                mysqli_query($connection, $queryUpdate);
    
                $queryRemove = "DELETE FROM $category WHERE quantity <= 0";
                mysqli_query($connection, $queryRemove);
                
            }
            
        }

        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    function showAlert(itemName) {
        alert(itemName + " has low stock!");
    }
</script>

</head>
<body class="flex h-screen ">

    <aside class="w-[15%] bg-[#001D22] text-white flex flex-col ">
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

    <div class="w-full flex flex-col justify-between h-full relative ">
        <div>
            <p class=" w-full p-5 font-semibold tracking-wider">INVENTORY</p>
        </div>

        <div class="h-[500px] overflow-x-auto relative  flex flex-col" >
            <div class="flex items-center justify-between px-5 sticky top-0 bg-white pb-5">
                <div>
                    <?php if ($tableCategory) { ?>
                        <p class="uppercase bg-blue-200 rounded-lg p-2 font-semibold"><?= $tableCategory ?></p>
                    <?php } ?>
                </div>
                <!-- category -->
                <form action="" method="post" id="categoryForm">
                    <select class="bg-[#E9E9E9] p-3 outline-none rounded-lg" name="table-category" id="categorySelect" onchange="submitForm()">
                        <option value="null-category">Choose category</option>
                        <?php foreach ($tables as $table) { ?>
                            <option class="" value="<?=$table?>"><?=strtoupper($table)?></option>
                        <?php } ?>
                    </select>
                </form>
            </div>

            <!-- table -->
                <table>
        
                    <tr class=" rounded-none w-full sticky top-9  px-2 text-left pl-3 w-full border-b-[1px] bg-white border-black text-md">
                        <th>ITEM ID</th>
                        <th>NAME</th>
                        <th>QUANTITY</th>
                        <th>ACQUISITION DATE</th>
                        <th>EXPIRY DATE</th>
                        <th>Take Item</th>
                    </tr>
                
                    <?php
                        // Check if the category is set
                        if (isset($_POST['table-category']) && $_POST['table-category'] !== 'null-category') {
                            $selectedCategory = $_POST['table-category'];

                            $query = "SELECT * FROM  `$selectedCategory`";
                            $fetch = mysqli_query($connection, $query);
    
                            if(!$fetch){
                            echo "failed";
                            }else{
                                while($row = $fetch->fetch_assoc()) {
                                    // Check if the quantity is 300 or below
                                    if ($row['quantity'] <= 300) {
                                        echo "<script>showAlert('" . addslashes($row['name']) . "');</script>";
                                    }
                            ?>
                            <tr class="mx-5">
                                <td class="flex items-center"><?php echo $row['id'];?></td>
                                <td class="flex items-center"><?php echo $row['name'];?></td>
                                <td class="flex items-center"><?php if($row['quantity'] <= 299 ){?> <span class="text-red-500"><?=$row['quantity']?></span><?php } else { ?><span class="text-green-500"><?=$row['quantity']?> <?php } ?></td>
                                <td class="flex items-center"><?php echo $row['acquisition_date'];?></td>
                                <td class="flex items-center"><?php if($currentDateTime >= $row['expiry_date'] ){?> <span class="text-red-500">EXPIRED</span><?php } else { ?><span><?=$row['expiry_date']?> <?php } ?></td>
                                <td class="flex item-center">
                                    <form action="" method="post" class="flex items-center gap-2 ">
                                        <input type="hidden" value="<?=$row['category'];?>" name="category">
                                        <input type="hidden" value="<?=$row['id'];?>" name="item-id">
                                        <input class="border-[1px] border-black rounded-lg text-center w-[5rem]" type="number" name="quantity-item" id="">
                                        <input class="bg-red-300 p-2 rounded-full text-sm font-semibold" type="submit" value="Get item" name="getItem-btn">
                                    </form>
                                </td>
                            </tr>


                    <?php    
                            }
                        } 
                        
                    }


                 if(!isset($_POST['table-category']) || $_POST['table-category'] === 'null-category') {

                    $query = "SELECT * FROM coffee";
                    $fetch = mysqli_query($connection, $query);

                    if(!$fetch){
                    echo "failed";
                    }else{
                    while($row = $fetch->fetch_assoc()){
                    ?>

                    <tr class="mx-5">
                    <td class="flex items-center"><?php echo $row['id'];?></td>
                    <td class="flex items-center"><?php echo $row['name'];?></td>
                    <td class="flex items-center"><?php if($row['quantity'] <= 500 ){?> <span class="text-red-500"><?=$row['quantity']?></span><?php } else { ?><span class="text-green-500"><?=$row['quantity']?> <?php } ?></td>
                    <td class="flex items-center"><?php echo $row['acquisition_date'];?></td>
                    <td class="flex items-center"><?php if($currentDateTime >= $row['expiry_date'] ){?> <span class="text-red-500">EXPIRED</span><?php } else { ?><span><?=$row['expiry_date']?> <?php } ?></td>
                    <td class="flex item-center">
                    <form action="" method="post" class="flex items-center gap-2 ">
                    <input type="hidden" value="<?=$selectedCategory?>" name="category-id">
                    <input type="hidden" value="<?=$row['category'];?>" name="category">
                    <input type="hidden" name="item-id" value="<?=$row['id'];?>">
                    <input class="border-[1px] border-black rounded-lg text-center w-[5rem]" type="number" name="quantity-item" id="">
                    <input class="bg-red-300 p-2 rounded-full text-sm font-semibold" type="submit" value="Remove item" name="getItem-btn">
                    </form></td>
                    </tr>

                    <?php 
                        } 
                    }
                }
                    
                    ?>
                
                </table>
              
            </div>

    </div>

    
</body>

<script>
    function submitForm() {
        // Get the selected value
        var selectedValue = document.getElementById("categorySelect").value;

        // Check if a valid category is selected
        if (selectedValue !== "null-category") {
            document.getElementById("categoryForm").submit(); // Submit the form
        }
    }
</script>

   

<style>
    *{
        margin: 0;
        padding: 0;
        font-family: "Bebas Neue", sans-serif;    
    }

    table{
        width: 100%;
    }

    tr{ 
        display: grid;
        grid-template-columns: repeat(6,1fr);
        margin-bottom: 10px;
        background-color: #ECECEC;
        border-radius: 8px;
    }


    td{
        padding: 15px;
       background-color: transparent;
    }


</style>
</html>