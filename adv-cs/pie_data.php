<?php
require "dbconnect.php";

$tables = ['coffee', 'hungryjoe', 'condiments', 'herbs', 'cookingoil', 'sauces'];

$coffeeTotal = 0;
$hungryjoeTotal = 0;
$condimentsTotal = 0;
$herbsTotal = 0;
$cookingoilTotal = 0;
$saucesTotal = 0;

$totalStock = 0;

foreach ($tables as $table) {
    // Prepare the query for each table
    $sql = "SELECT SUM(quantity) AS total_quantity FROM $table";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the total quantity from the result
        $row = $result->fetch_assoc();
        $totalQuantity = intval($row['total_quantity']);

        // Assign the total to the appropriate variable based on the table name
        switch ($table) {
            case 'coffee':
                $coffeeTotal = $totalQuantity;
                $totalStock += $coffeeTotal;
                break;
            case 'hungryjoe':
                $hungryjoeTotal = $totalQuantity;
                $totalStock += $hungryjoeTotal;
                break;
            case 'condiments':
                $condimentsTotal = $totalQuantity;
                $totalStock += $condimentsTotal;
                break;
            case 'herbs':
                $herbsTotal = $totalQuantity;
                $totalStock += $herbsTotal;
                break;
            case 'cookingoil':
                $cookingoilTotal = $totalQuantity;
                $totalStock += $cookingoilTotal;
                break;
            case 'sauces':
                $saucesTotal = $totalQuantity;
                $totalStock += $saucesTotal;
                break;
        }
    } else {
        echo "No data found in table: $table<br>";
    }

 
}


?>
