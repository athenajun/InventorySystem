<?php include_once('dbconnect.php'); ?> 
<?php include_once('pie_data.php'); 

date_default_timezone_set('Asia/Manila');
$current_datetime_display = date('m/d/Y h:i A');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f5f5dc; /* Light beige background */
        }
        .nav-link {
            transition: background-color 0.3s;
        }
        .nav-link:hover {
            background-color: #c8e0a0; /* Light green hover */
        }
    </style>
</head>
<body class="flex h-screen w-full">

    <aside class="w-[15%] bg-[rgb(0,29,34)] text-white flex flex-col">
        <div class="w-10 h-10 bg-[#D0D0D0] rounded-full ml-5 mt-5">
            <img src="coffee1.jpg" alt="Coffee Shop Logo" class="w-full h-full rounded-full" />
        </div>

        <div class="flex flex-col justify-between h-full pt-10">
            <nav class="flex flex-col">
                <a href="index.php" class="nav-link font-semibold pl-3 py-2">Dashboard</a>
                <a href="view_inventory.php" class="nav-link font-semibold pl-3 py-2">View Inventory</a>
                <a href="restock.php" class="nav-link font-semibold pl-3 py-2">Restock</a>
            </nav>
            <a class="m-5 bg-white text-black w-20 text-center p-2 rounded-full font-semibold hover:bg-[#DFDFDF]" href="login.php">Logout</a>
        </div>
    </aside>

    <figure class="highcharts-figure w-[60rem] relative mx-auto">
        <div class="absolute z-20 top-[166px] -left-1">
            <?php if($totalStock <= 5000) { ?> 
                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
            <?php } else { ?> 
                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
            <?php } ?>
        </div>
        <div id="container" class="w-full h-full"></div>
    </figure>

</body>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: "Inventory Condition - <?=$current_datetime_display?> <br/><br/> <?=$totalStock?> Total Stock",
            align: 'left'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Quantity',
            colorByPoint: true,
            data: [{
                name: "Coffee",
                y: <?=$coffeeTotal?>,
                sliced: true,
                selected: true
            }, {
                name: 'Condiments',
                y: <?=$condimentsTotal?>
            }, {
                name: 'Cooking Oil',
                y: <?=$cookingoilTotal?>
            }, {
                name: 'Herbs',
                y: <?=$herbsTotal?>
            }, {
                name: 'Hungry Joe',
                y: <?=$hungryjoeTotal?>
            }, {
                name: 'Sauces',
                y: <?=$saucesTotal?>
            }]
        }]
    });
</script>

<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 100%;
        margin: 1em auto;
    }
    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>

</html>
